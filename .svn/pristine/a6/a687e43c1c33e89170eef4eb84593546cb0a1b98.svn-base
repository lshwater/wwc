<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Updatelogs Controller
 *
 * @property Updatelog $Updatelog
 * @property PaginatorComponent $Paginator
 */
class UpdatelogsController extends AppController
{
    /**
     * index method
     *
     * @return void
     */
    public function index()
    {

    }

    public function form1(){
        configure::Write('debug',2);

    }

    public function form2(){
        configure::Write('debug',2);

    }

    public function form3(){
//        configure::Write('debug',2);

    }

    public function ajax_list(){
//        configure::write('debug',2);
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
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

        /**
         * Ordering
         */
        if ( isset($input['iSortCol_0']) ) {
            $sort_fields = array();
            for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
                if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
                    $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];

                    $order = ( $input['sSortDir_'.$i]=='desc' ? "DESC" : "ASC" );
                    if($field == "created"){
                        $options['order'][] = array('Updatelog.created'=>$order);
                    }else if($field == "by"){
                        $options['order'][] = array('Updatelog.user_id'=>$order);
//                    }else if($field == "Updatelogshipdate"){
//                        $options['order'][] = array('Updatelog.Updatelogshipdate'=>$order);
//                    }else if($field == "modified"){
//                        $options['order'][] = array('Updatelog.modified'=>$order);
//                    }else if($field == "status"){
//                        $options['order'][] = array('Updatelog.valid'=>$order);
//                        $options['order'][] = array('Updatelog.active'=>$order);
                    }

                    if(empty($options['order'])){
                        $options['order'][] = array('Updatelog.created'=>'DESC');
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
        if(!empty($input['item_model'])){
            $options['conditions']['Updatelog.item_model'] = $input['item_model'];
        }

        if(!empty($input['item_id'])){
            $options['conditions']['Updatelog.item_id'] = $input['item_id'];
        }

        if(!empty($input['type'])){
            $options['conditions']['Updatelog.type'] = $input['type'];
        }

        if(!empty($input['user_id'])){
            $options['conditions']['Updatelog.user_id'] = $input['user_id'];
        }

        //Searching
        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];
            $options['conditions']['OR']["Updatelog.before LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Updatelog.after LIKE"] = '%' . $input['sSearch'] . '%';
        }



        $this->Updatelog->Behaviors->load('Containable');
        $options['contain'] = array(
            'User'
        );


        $result = $this->Updatelog->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Updatelog->find('count',$options);
        $all_count = $this->Updatelog->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        $this->loadModel('Dbfield');
        $this->loadModel('Dbmodel');

        App::import('Helper', 'Html');
        $html = new HtmlHelper(new View());

        foreach ( $result as $doc ) {
            $rst = array();
            $model = $this->Dbmodel->find('first',array('conditions'=>array('Dbmodel.name'=>$doc['Updatelog']['item_model'])));
            $rst['item_model'] =$model['Dbmodel']['oname'];
            $this->loadModel($doc['Updatelog']['item_model']);
            $name = $this->{$doc['Updatelog']['item_model']}->field($model['Dbmodel']['model_ref'],array($doc['Updatelog']['item_model'].'.id'=>$doc['Updatelog']['item_id']));
            $rst['item_id'] = $html->link($name, array('controller'=>$model['Dbmodel']['db_table'], 'action' => $model['Dbmodel']['default_view'], $doc['Updatelog']['item_id']), array('escape' => false));
            $rst['type'] = $doc['Updatelog']['type'];
            $rst['field'] = $this->Dbfield->field('oname',array('Dbfield.model_id'=>$model['Dbmodel']['id'], 'Dbfield.db_field'=>$doc['Updatelog']['field']));
            $rst['before'] = h($doc['Updatelog']['before']);
            $rst['after'] = h($doc['Updatelog']['after']);
            $rst['change'] = "<span class='label label-success'>".$doc['Updatelog']['before']."</span>"." <i class='fa fa-caret-right'></i> "."<span class='label label-warning'>".$doc['Updatelog']['after']."</span>";

            $rst['user_id'] = $doc['User']['name'];
            $rst['created'] = $doc['Updatelog']['created'];

            $output['aaData'][] = $rst;
        }

        echo json_encode( $output );
    }

    public function beforeFilter()
    {
        if ($this->request['action'] == 'sendconfirmmail' || $this->request['action'] == 'sendresetpwdmail') {
            $this->allowtoken();
            $this->Security->unlockedActions[] = 'sendresetpwdmail';
            $this->Security->unlockedActions[] = 'sendconfirmmail';
        }
        if ($this->request['action'] == 'ajax_checkinfo') {
            $this->Security->csrfUseOnce = false;
        }
        if ($this->request['action'] == 'ajax_matching') {
            $this->Security->csrfUseOnce = false;
        }
        if ($this->request['action'] == 'newUpdatelogfamily') {
            $this->Security->unlockedFields = array('ExistingUpdatelog');
        }
        if ($this->request['action'] == 'extendindividual') {
            $this->Security->unlockedFields = array('Updatelog.Updatelog' ,"Updatelog.Updatelogshipdate");
        }
        if ($this->request['action'] == 'extendfamily') {
            $this->Security->unlockedFields = array('Updatelog.Updatelog' ,"Updatelog.Updatelogshipdate" ,"ParentUpdatelog", "Updatelogship");
        }
        if ($this->request['action'] == 'edit') {
            $this->Security->unlockedFields = array('ParentUpdatelog');
        }
        $this->Security->unlockedActions[] = 'export';
        $this->Security->unlockedActions[] = 'exportaddrlabel';
        $this->Security->unlockedActions[] = 'checkinfo_extend';
        $this->Security->unlockedActions[] = 'ajax_checkidentity';
        $this->Security->unlockedActions[] = 'changeactive';
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }

}
