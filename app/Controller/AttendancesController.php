<?php
App::uses('AppController', 'Controller');
/**
 * Units Controller
 *
 * @property Unit $Unit
 */
class AttendancesController extends AppController {


    public function index(){


    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->Attendance->exists($id)) {
            throw new NotFoundException(__('Invalid Attendance'));
        }

        $attendance = $this->Attendance->read(null, $id);
        $this->Attendance->id = $id;

        $this->request->allowMethod('post', 'delete');
        $redirect = $this->request->query['redirect'];
        if ($this->Attendance->delete()) {
            $this->Attendance->Stock->id = $attendance['Attendance']['stock_id'];
            $this->Attendance->Stock->saveField('current_count', (int)$this->Attendance->Stock->field('current_count') + $attendance['Attendance']['count']);
            $this->Attendance->Stock->saveField('holder_id', null);

                $this->Session->setFlash(__('The Attendance has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The Attendance could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }

        if($redirect){
            return $this->redirect($redirect);
        }else{
            return $this->redirect(array('action' => 'index'));
        }

    }


    public function ajax_list(){
//        configure::write('debug',2);
//        debug($this->request->query);exit();
        $this->autoRender = false;
        $output = array();

        $options = array();

        $input =& $_GET;

// Number of columns being displayed (useful for getting individual column search info)
        $iColumns = $input['iColumns'];

// Get mDataProp values assigned for each table column
        $dataProps = array();
        for ($i = 0; $i < $iColumns; $i++) {
            $var = 'mDataProp_'.$i;
            if (!empty($input[$var]) && $input[$var] != 'null') {
                $dataProps[$i] = $input[$var];
//                $options['fields'][] = $input[$var];
            }
        }
        // Type = Attendance
        // Name = AM/PM/NT
        // Value = 留宿/渡假/入院/外出活動

//		$options['fields'] = $dataProps;
//		array_push($options['fields'], 'Shippingitem.tracking');

        $this->Attendance->Behaviors->load('Containable');
        $options['contain'] = array(
            'Stock.Unit',
            'User'
        );
        /**
         * Ordering
         */
        if ( isset($input['iSortCol_0']) ) {
            $sort_fields = array();
            for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
                if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
                    $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];

                    $order = ( $input['sSortDir_'.$i]=='desc' ? "DESC" : "ASC" );
                    if($field == "name") {
                        $options['order']["Member.e_name"] = $order;
                        $options['order']["Member.c_name"] = $order;
                    }else{
                        break;
                    }
                }
            }
        }

        if(empty($options['order'])){
            $options['order']['Attendance.created'] = "DESC";
        }
        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['limit'] = $input['iDisplayLength'];
            $options['offset'] = $input['iDisplayStart'];
        }

        //Filter

        if(!empty($input['user_id'])){
            $options['conditions']["Attendance.user_id"] = $input['user_id'];
        }

        if(!empty($input['stock_id'])){
            $options['conditions']["Attendance.stock_id"] = $input['stock_id'];
        }

        if(!empty($input['created_after'])){
            $options['conditions']["Attendance.created >"] = date('Y-m-d H:i:s',$input['created_after']);
        }

        if(!empty($input['name'])){
            $options['conditions']['AND']['OR']["Stock.c_name LIKE "] = '%' . $input['name'] . '%';
        }

        if(!empty($input['unit'])){
            $options['conditions']["Stock.unit_id"] = $input['unit'];
        }

        if(!empty($input['user_id'])){
            $options['conditions']["Attendance.user_id"] = $input['user_id'];
        }else{

            $this->loadModel('UsersUnit');
            $list = $this->UsersUnit->find('list',array('conditions'=>array('unit_id'=>$this->Auth->user('viewunits')),'fields'=>array('user_id','user_id')));

            $options['conditions']["Attendance.user_id"] = array_values($list);
        }

        if(!empty($input['date'])){
            $options['conditions']['Attendance.created >='] = $input['date']." 00:00:00";
            $options['conditions']['Attendance.created <='] = $input['date']." 23:59:59";
        }

        if(!empty($input['status'])){
            if($input['status'] == 1){
                $options['conditions']['NOT']['Attendance.in_time'] = null;

            }else if($input['status'] == 2){
                $options['conditions']['Attendance.in_time'] = null;
                $options['conditions']['Attendance.expected_return_time <'] = date('Y-m-d')." 23:59:59";
            }

        }


        if($input['checkin']){
            $options['order']['Attendance.modified'] = 'DESC';
            $options['conditions']['NOT']['Attendance.in_time'] = null;

        }

        if($input['checkout'] || $input['reload']){
            $options['conditions']['Attendance.in_time'] = null;
        }


        $limit = $options['limit'];
        $offset = $options['offset'];

        $result = $this->Attendance->find('all',$options);

        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Attendance->find('count',$options);
        $all_count = $this->Attendance->find('count');


        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => intval($result_count),
            "aaData" => array(),
        );


        foreach ( $result as $doc ) {

            $doc['Attendance']['user_name'] = h($doc['User']['name']);
            $doc['Attendance']['item_name'] = h($doc['Stock']['name']);
            $doc['Attendance']['fix_asset_no'] = h($doc['Stock']['fix_asset_no']);
            $doc['Attendance']['unit'] = $doc['Stock']['Unit']['name'];
            $doc['Attendance']['code'] = $doc['Stock']['code'];

            if(!$doc['Attendance']['in_time']){
                $doc['Attendance']['in_time'] = "沒有記錄";

                if(!$doc['Attendance']['expected_return_time']){
                    $doc['Attendance']['expected_return_time'] = "沒有記錄";
                }else{
                    $expected_return_time = $doc['Attendance']['expected_return_time'];
                    $doc['Attendance']['expected_return_time'] = date('Y-m-d',strtotime($doc['Attendance']['expected_return_time']));


                    $period = date_diff(date_create($expected_return_time), date_create(date('Y-m-d')." 23:59:59"));
                    $doc['Attendance']['expected_return_time'] .="<br>";
                    if(date('Y-m-d')." 23:59:59" < $expected_return_time){
                        $doc['Attendance']['expected_return_time'] .= " (".$period->d."日後到期)";
                    }else{
                        $doc['Attendance']['expected_return_time'] .= " <strong class='text-danger'>(已過期".$period->d."日) </strong>";
                    }
                }


            }else{
                $doc['Attendance']['expected_return_time'] = "已歸還";
            }

            if(!$doc['Attendance']['out_time']){
                $doc['Attendance']['out_time'] = "沒有記錄";
            }

            App::import('Helper','Time');
            $time = new TimeHelper(new View());



            $doc['Attendance']['action'] = "";

            App::import('Helper','Form');
            $form = new FormHelper(new View());

            App::import('Helper', 'Html');
            $html = new HtmlHelper(new View());

            if($doc['Stock']['image_path']){
                $doc['Attendance']['image'] = "<img src='".$html->url('/img/stock_img/'. $doc['Stock']['image_path'])."' alt='images' height='100'>";
            }else{
                $doc['Attendance']['image'] = "<img src='".$html->url('/img/dummy-avatar.png')."' alt='images' height='100'>";

            }

            if($input['checkout']){
                $redirect = $html->url(array('controller'=>'stocks','action'=>'checkout', $doc['User']['membercard']));
            }else if($input['checkin']){
                $redirect = $html->url(array('controller'=>'stocks','action'=>'checkin'));
            }else if($input['reload']){
                $redirect = $html->url(array('controller'=>'stocks','action'=>'reload'));
            }else{
                $redirect = $html->url(array('controller'=>'attendances','action'=>'index'));
            }

            if($this->Auth->user('allow_action.attendance.delete')) {
                //            $doc['Attendance']['action'] = $html->link('<i class="fa fa-redo"></i>', array('action' => 'reload',$doc['Attendance']['id'], 'ajax'=>true), array('class' => 'modalbtn btn-danger btn-sm btn', 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#modal'))." ";
                if($doc['Attendance']['created'] >= date('Y-m-d H:i:s', strtotime(" - 1 day"))){
                    $doc['Attendance']['action'] .= $form->postLink('<i class="fa fa-remove"></i>', array('action' => 'delete', $doc['Attendance']['id'], '?'=>array('redirect'=>$redirect)), array('class' => 'btn btn-danger btn-sm', 'escape' => false), __('確定刪除嗎?'))." ";
                }
            }

            $output['aaData'][] = $doc['Attendance'];
        }

        echo json_encode( $output );
    }

    public function beforeFilter()
    {

        $this->Auth->allow('ajax_list');

        parent::beforeFilter();
    }


}
