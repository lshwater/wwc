<?php
App::uses('AppController', 'Controller');

class VouchersController extends AppController {

    public function index(){

        if($this->request->query){
            $this->set('query', $this->request->query);
        }

    }

    public function add(){
        if ($this->request->is('post')) {

            if($this->request->data['Voucher']['stock_id']){
                $stock_id = $this->request->data['Voucher']['stock_id'];
                unset($this->request->data['Voucher']['stock_id']);
            }
            $this->Voucher->create();
            if ($this->Voucher->save($this->request->data)) {
                if($stock_id){
                    $this->Voucher->Stock->id = $stock_id;
                    $this->Voucher->Stock->saveField('voucher_id', $this->Voucher->getLastInsertID());
                }
                $this->Session->setFlash(__('The voucher has been saved.'), 'default', array('class' => 'alert alert-success'));
            }else{
                $this->Session->setFlash(__('The voucher could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));

            }

            return $this->redirect(array('controller'=>'stocks','action' => 'index'));

        }

        $units = $this->Voucher->Unit->find('list', array('conditions'=>array('Unit.id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));
        $this->set('units', $units);

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Voucher->exists($id)) {
            throw new NotFoundException(__('Invalid Voucher'));
        }

        if ($this->request->is(array('post', 'put'))) {

            if($this->Voucher->save($this->request->data)){
                $this->Session->setFlash(__('The voucher has been saved.'), 'default', array('class' => 'alert alert-success'));
            }else{
                $this->Session->setFlash(__('The voucher could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }

            return $this->redirect(array('controller'=>'stocks','action'=>'index', '?'=>array('voucher'=>$this->request->data['Voucher']['id'])));
        } else {
            $options = array('conditions' => array('Voucher.' . $this->Voucher->primaryKey => $id));
            $this->request->data = $this->Voucher->find('first', $options);

        }

        $units = $this->Voucher->Unit->find('list', array('conditions'=>array('Unit.id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));

        $this->set(compact('units'));

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
        $this->Voucher->id = $id;
        if (!$this->Voucher->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->request->allowMethod('post', 'delete');
        $check = $this->Voucher->Stock->find('count',array(
            'conditions'=>array(
                'Stock.voucher_id'=>$id
            )
        ));

        if(empty($check)){
            if ($this->Voucher->delete()) {
                $this->Session->setFlash(__('The Voucher has been deleted.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller'=>'Stocks','action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Voucher could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }else{
            $this->Session->setFlash(__('The Voucher could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('controller'=>'Stocks','action' => 'index','?'=>array('voucher'=>$id)));


    }

    public function ajax_select2_list(){
        $this->autoRender = FALSE;

        $name = trim(empty($this->request->query['term'])?"":$this->request->query['term']);

        $option = array();
        if(!empty($name)){
            $option['AND']['OR'][] = array(
                'Voucher.code LIKE'=> '%' .$name
            );
            $option['AND']['OR'][] = array(
                'Voucher.code LIKE'=> $name. "%"
            );
            $option['AND']['OR'][] = array(
                'Voucher.code LIKE'=> "%". $name. "%"
            );
        }

        $option['Voucher.unit_id'] = $this->Auth->user('viewunits');

        $schools = $this->Voucher->find('list',
            array(
                'conditions' => $option,
                'limit'=>10,
                'fields'=>array(
                    'id','code'
                )
            )
        );

        if(empty($schools)){
            $data = array();
            $data['id'] = $name;
            $data['text'] = '新單據：'.$name;
            $list[] = $data;
            echo json_encode($list);
//            echo json_encode(array('empty'=>true));
        }
        else{
            $list = array();
            foreach($schools as $k=>$school){
                $data = array();
                $data['id'] = $k;
                $data['text'] = $school;
                $list[] = $data;
            }
            echo json_encode($list);
        }
        exit();
    }


    public function ajax_list(){
//        configure::writE('debug',2);
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


//		$options['fields'] = $dataProps;
//		array_push($options['fields'], 'Shippingitem.tracking');

        $this->Voucher->Behaviors->load('Containable');

        $options['contain'] = array(
            'Unit',
            'Holder',
            'Stocktype'
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
                        $options['order'][] = array("Voucher.code" => $order);
                    }else{
                        break;
                    }
                }
            }
        }

        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['limit'] = $input['iDisplayLength'];
            $options['offset'] = $input['iDisplayStart'];
        }

        //Filter
        if(!empty($input['voucher_id'])){
            $options['conditions']["Voucher.id"] = $input['voucher_id'];
        }



        $this->Voucher->Behaviors->load('Containable');
        $result = $this->Voucher->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Voucher->find('count',$options);
        $all_count = $this->Voucher->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        App::import('Helper','Form');
        $form = new FormHelper(new View());

        App::import('Helper', 'Html');
        $html = new HtmlHelper(new View());


        foreach ( $result as $doc ) {


            $doc['Voucher']['code'] = h($doc['Voucher']['code']);
            $doc['Voucher']['voucher_date'] = h($doc['Voucher']['voucher_date']);
            $doc['Voucher']['invoice_no'] = h($doc['Voucher']['invoice_no']);
            $doc['Voucher']['invoice_date'] = h($doc['Voucher']['invoice_date']);
            $doc['Voucher']['source_of_fund'] = h($doc['Voucher']['source_of_fund']);
            $doc['Voucher']['acquired_from'] = h($doc['Voucher']['acquired_from']);

            $doc['Voucher']['action'] = "";

            $stock_count = $this->Voucher->Stock->find('count', array(
                'conditions'=>array(
                    'Stock.voucher_id'=>$doc['Voucher']['id']
                )
            ));


            if($this->Auth->user('allow_action.voucher.edit')) {
                $doc['Voucher']['action'] .= $html->link('修改', array('action' => 'edit', $doc['Voucher']['id'],'ajax'=>true), array('class' => 'modalbtn btn-warning btn', 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#modal'))." ";

            }

            if($this->Auth->user('allow_action.voucher.delete')) {
                if (empty($stock_count)) {
                    $doc['Voucher']['action'] .= $form->postLink('刪除', array('action' => 'delete', $doc['Voucher']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('確定刪除嗎?')) . " ";
                }
            }

            $output['aaData'][] = $doc['Voucher'];

        }

        echo json_encode( $output );
    }

    public function beforeFilter(){


//        if($this->request['action'] == 'ajax_school_list'){
//            $this->Security->validatePost = false;
//            $this->Security->csrfCheck = false;
//        }

        parent::beforeFilter();
//        $this->response->header('Access-Control-Allow-Origin', 'http://september1.info');

    }
}
