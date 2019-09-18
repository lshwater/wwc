<?php
App::uses('AppController', 'Controller');

class ApprovalrecordsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
        */

    public function pending(){

    }
    public function pending2(){

    }


    public function test(){
        configure::write('debug',2);
        $this->Approvalrecord->new_approval_request('Eventproposal', 20, 'valid', 0, 1, 2, array(1,2,3), "test");
        exit();
    }

    public function test2(){
        configure::write('debug',2);

        $this->loadModel('User');
        $this->User->Behaviors->load('Containable');
        $list = $this->User->find('first',array(
            'conditions'=>array(
                'User.id'=>$this->Auth->user('id')
            ),
            'contain'=>array(
                'Approvalrecord'=>array(
                    'limit'=>2,
                    'offset'=>0
                )
            )
        ));

        debug($list);
        exit();
    }


    public function my_approval_list(){
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


        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];

//            $options['conditions']['OR']["Member.c_name LIKE"] = '%' . $input['sSearch'] . '%';
//            $options['conditions']['OR']["Member.e_name LIKE"] = '%' . $input['sSearch'] . '%';
//            $options['conditions']['OR']["Member.code LIKE"] = '%' . $input['sSearch'] . '%';
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

//
//                    if($field == "code_type"){
//                        $options['order'][] = array('Member.membertype_id'=>$order);
//                        $options['order'][] = array('Member.code'=>$order);
//                    }else if($field == "c_name"){
//                        $options['order'][] = array('Member.c_name'=>$order);
//                    }else if($field == "membershipdate"){
//                        $options['order'][] = array('Member.membershipdate'=>$order);
//                    }else if($field == "modified"){
//                        $options['order'][] = array('Member.modified'=>$order);
//                    }else if($field == "status"){
//                        $options['order'][] = array('Member.valid'=>$order);
//                        $options['order'][] = array('Member.active'=>$order);
//                    }
                }
            }
        }



        //Filter
//        if(!empty($input['status'])){
//            if($input['status'] == 1){
//                $options['conditions']['Member.valid'] = 0;
//            }else if($input['status'] == 2){
//                $options['conditions']['Member.valid'] = 1;
//                $options['conditions']['Member.active'] = 0;
//            }else{
//                $options['conditions']['Member.valid'] = 1;
//                $options['conditions']['Member.active'] = 1;
//            }
//        }

        $options['conditions']['Reviewer.id'] = $this->Auth->user('id');

//        if(!empty($input['membertype'])){
//            $options['conditions']['Member.membertype_id'] = $input['membertype'];
//        }

        $this->Approvalrecord->Reviewer->Behaviors->load('Containable');
//        $list = $this->User->find('first',array(
////            'conditions'=>array(
////                'User.id'=>$this->Auth->user('id')
////            ),
////            'contain'=>array(
////                'Approvalrecord'=>array(
////                    'limit'=>2,
////                    'offset'=>0
////                )
////            )
////        ));
        $options['contain'] = array(
            "Approvalrecord.Approvalrecordstatus",
            "Approvalrecord.Requester",
        );

        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['contain']['Approvalrecord']['limit'] = $input['iDisplayLength'];
            $options['contain']['Approvalrecord']['offset'] = $input['iDisplayStart'];
        }


        $result = $this->Approvalrecord->Reviewer->find('first',$options);
//        unset($options['limit']);
//        unset($options['offset']);
//        $result_count = $this->Approvalrecord->find('count',$options);
//        $all_count = $this->Approvalrecord->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
//            "iTotalRecords" => $all_count,
//            "iTotalDisplayRecords" => $result_count,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => array(),
        );

        $this->loadModel('Dbfield');
        $this->loadModel('Dbmodel');

        App::import('Helper', 'Html');
        $html = new HtmlHelper(new View());

        foreach ( $result['Approvalrecord'] as $doc ) {
            $rst = array();

            $model = $this->Dbmodel->find('first',array('conditions'=>array('Dbmodel.name'=>$doc['model']),'recursive'=>-1));
            $rst['model'] = $model['Dbmodel']['oname'];
            $this->loadModel($doc['model']);
            $rst['model_id_name'] =  $this->{$doc['model']}->field($model['Dbmodel']['model_ref'],array($doc['model'].'.id'=>$doc['model_id']));

            $rst['field'] = $this->Dbfield->field('oname', array('Dbfield.model_id'=>$model['Dbmodel']['id'], 'Dbfield.db_field'=>$doc['db_field']));
            $rst['from'] = ($doc['update_from_text'])?$doc['update_from_text']:$doc['update_from'];
            $rst['to'] = ($doc['update_to_text'])?$doc['update_to_text']:$doc['update_to'];
            $rst['change'] = "<span class='label label-success'>".$rst['from']."</span>"." <i class='fa fa-caret-right'></i> "."<span class='label label-warning'>".$rst['to']."</span>";
            $rst['status'] = "<span class='label ".$doc['Approvalrecordstatus']['labelclass']."'>".$doc['Approvalrecordstatus']['name']."</span>";
            $rst['requester'] = $doc['Requester']['name'];
            $rst['created'] = $doc['created'];

            $rst['action'] = "";

//            $doc['Memberoutput']['action'] = $html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-eye"></i></button>', array('action' => 'view', $doc['Member']['id'], 'ajax' => true), array('class' => ' modalbtn', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#modal'));


            $output['aaData'][] = $rst;
        }

        echo json_encode( $output );

    }

    public function ajax_list(){

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


        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];

//            $options['conditions']['OR']["Member.c_name LIKE"] = '%' . $input['sSearch'] . '%';
//            $options['conditions']['OR']["Member.e_name LIKE"] = '%' . $input['sSearch'] . '%';
//            $options['conditions']['OR']["Member.code LIKE"] = '%' . $input['sSearch'] . '%';
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


                    if($field == "code_type"){
                        $options['order'][] = array('Member.membertype_id'=>$order);
                        $options['order'][] = array('Member.code'=>$order);
                    }else if($field == "c_name"){
                        $options['order'][] = array('Member.c_name'=>$order);
                    }else if($field == "membershipdate"){
                        $options['order'][] = array('Member.membershipdate'=>$order);
                    }else if($field == "modified"){
                        $options['order'][] = array('Member.modified'=>$order);
                    }else if($field == "status"){
                        $options['order'][] = array('Member.valid'=>$order);
                        $options['order'][] = array('Member.active'=>$order);
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
//        if(!empty($input['status'])){
//            if($input['status'] == 1){
//                $options['conditions']['Member.valid'] = 0;
//            }else if($input['status'] == 2){
//                $options['conditions']['Member.valid'] = 1;
//                $options['conditions']['Member.active'] = 0;
//            }else{
//                $options['conditions']['Member.valid'] = 1;
//                $options['conditions']['Member.active'] = 1;
//            }
//        }

//        if(!empty($input['membertype'])){
//            $options['conditions']['Member.membertype_id'] = $input['membertype'];
//        }


        $options['contain'] = array(
            "Membertype",
            'MemberCustomField.Memberinputfield',
            'MemberCustomField.Memberinputfield.Inputtype',
            "User"
        );


        $result = $this->Member->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Member->find('count',$options);
        $all_count = $this->Member->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        foreach ( $result as $doc ) {
            $doc['Memberoutput'] = array();
            $doc['Memberoutput']['id'] = $doc['Member']['id'];
            $doc['Memberoutput']['code_type'] = $doc['Member']['code']."<br>".$doc['Membertype']['name'];
            $doc['Memberoutput']['c_name'] = $doc['Member']['c_name'];
            $doc['Memberoutput']['e_name'] = $doc['Member']['e_name'];

            if (strtotime($doc['Member']['membershipdate']) < strtotime(date("Y-m-d"))) {
                $membershipdatewarning = '<span class="text-warning"> <i class="fa fa-exclamation-triangle"></i></span>';
            } else {
                $membershipdatewarning = "";
            }

            $doc['Memberoutput']['membershipdate'] = $doc['Member']['membershipdate']." ".$membershipdatewarning;

            $doc['Memberoutput']['status'] = "";

            if (!$doc['Member']['valid']) {
                $doc['Memberoutput']['status'] = "已退會";
            } else {
                if ($doc['Member']['active']) {
                    $doc['Memberoutput']['status'] = "有效";
                } else {
                    $doc['Memberoutput']['status'] = "無效";
                }
            }
            $doc['Memberoutput']['modified'] = $doc['Member']['modified']."<br>".$doc['User']['name'];

            $doc['Memberoutput']['action'] = "";

            App::import('Helper', 'Html');
            $html = new HtmlHelper(new View());
            App::import('Helper','Form');
            $form = new FormHelper(new View());

            $doc['Memberoutput']['action'] = $html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-eye"></i></button>', array('action' => 'view', $doc['Member']['id'], 'ajax' => true), array('class' => ' modalbtn', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#modal'));

            $doc['Memberoutput']['action'] .= " ".$html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $doc['Member']['id']), array('class' => '', 'escape' => false));

            $doc['Memberoutput']['action'] .= " ".$html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $doc['Member']['id']), array('class' => 'btn btn-sm btn-warning', 'escape' => false));

            $doc['Memberoutput']['action'] .= " ".$html->link('<button class="btn btn-sm btn-success" style="width: 32px;"><i class="fa fa-wifi"></i></button>', array('action' => 'reissuecard', $doc['Member']['id']), array("class" => 'openasnew', 'escape' => false));

            if ($doc['Member']['valid'] && $doc['Member']['active']) {
                $doc['Memberoutput']['action'] .= " ".$form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-dot-circle-o"></i></button>', array('action' => 'changeinvalid', $doc['Member']['id']), array('escape' => false), __('確定要退會嗎?'));
            }

            $output['aaData'][] = $doc['Memberoutput'];
        }

        echo json_encode( $output );
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

}
