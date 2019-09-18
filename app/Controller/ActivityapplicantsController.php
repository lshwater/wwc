<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ActivityapplicantsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function view($id = null){
        if(!$this->Activityapplicant->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activityapplicant->Behaviors->load('Containable');
        $activityapplicant = $this->Activityapplicant->find('first', array(
            'conditions'=>array('Activityapplicant.id'=>$id),
            "contain"=>array(
                "Member.Membertype"
            )
        ));
        $this->set('activityapplicant', $activityapplicant);
    }

    public function edit($id = null){
        if (!$this->Activityapplicant->exists($id)) {
            throw new NotFoundException(__('Invalid Activityapplicant'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Activityapplicant->save($this->request->data)) {
                $this->Session->setFlash("資料已成功更新", 'default', array('class'=>'alert alert-success'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash(__('資料更新失敗'), 'default', array('class'=>'alert alert-danger'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            }
        } else {
            $options = array('conditions' => array('Activityapplicant.' . $this->Activityapplicant->primaryKey => $id));
            $this->request->data = $this->Activityapplicant->find('first', $options);
        }
    }

    public function changevalid($id = null, $valid = null){
        if (!$this->Activityapplicant->exists($id) || $valid === null) {
            throw new NotFoundException(__('Invalid Activityapplicant'));
        }
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Activityapplicant->id = $id;
            if($valid == 0){
                if($this->Activityapplicant->saveField('valid', 0)){
                    $this->Session->setFlash("已成功取消", 'default', array('class'=>'alert alert-success'));
                }else{
                    $this->Session->setFlash("取消失敗", 'default', array('class'=>'alert alert-danger'));
                }
            }
            else if($valid == 1){
                $app = $this->Activityapplicant->findById($id);
                $quota = $this->Activityapplicant->Activity->getquota($app['Activityapplicant']['activity_id']);
                if($quota > 0){
                    if($this->Activityapplicant->saveField('valid', 1)){
                        $this->Session->setFlash("已成功加入", 'default', array('class'=>'alert alert-success'));
                    }else{
                        $this->Session->setFlash("加入失敗", 'default', array('class'=>'alert alert-danger'));
                    }
                }else{
                    $this->Session->setFlash("名額已滿。", 'default', array('class'=>'alert alert-danger'));
                }

            }


            if ($this->request->params['named']['redirect']) {
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            } else {
                $redirecturl = array('action' => 'index');
            }
            return $this->redirect($redirecturl);
        }
    }

    //2016-11-01 Watermelon
    public function management($activity_id = null){
        if(!$this->Activityapplicant->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->Activityapplicant->Activity->Behaviors->load('Containable');
        $activity = $this->Activityapplicant->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id),
            "contain"=>array(
                "Activityfee.Membertype",
                "Activityapplicant.Member.Membertype",
                "Activityapplicant.Member.MemberCustomField"=>array(
                    'conditions'=>array(
                        'memberinputfield_id'=>'16'
                    )
                )
            )
        ));
//        Configure::write('debug', 2);
//        debug($activity);exit();
        $this->set("quota", $this->Activityapplicant->Activity->getquota($activity_id));
        $this->set('activity', $activity);
    }

    public function exportattendentsheet($activity_id = null){
//        Configure::write('debug', 2);
        if(!$this->Activityapplicant->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activityapplicant->Behaviors->load('Containable');
        $activityapplicants = $this->Activityapplicant->find('all', array(
            'conditions'=>array(
                'Activityapplicant.activity_id'=>$activity_id,
                'Activityapplicant.valid'=>1
            ),
            "contain"=>array(
                "Member",
                'Activityapplication'
            )
        ));

        if(empty($activityapplicants)){
            $this->Session->setFlash(__('沒有參加者'), 'default', array('class'=>'alert alert-warning'));
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            if(!empty($redirecturl)){
                $this->redirect($redirecturl);
            }else{
                $this->redirect(array('action'=>'management', $activity_id));
            }
        }

        $this->Activityapplicant->Activity->Behaviors->load('Containable');
        $activity = $this->Activityapplicant->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id),
            "contain"=>array(
                "Activitysession"=>array(
                    'order' => 'Activitysession.date ASC'
                )
            )
        ));
//        Configure::write('debug', 2);
//        debug($activityapplicants);exit();
        $dir = new Folder();
        $dir_path = "/tmp/".uniqid();
        while(!$dir->create($dir_path)){
            $dir_path = "/tmp/".uniqid();
        }

        $this->set('dir_path', $dir_path);
        $this->set('activityapplicants', $activityapplicants);
        $this->set('activity', $activity);
    }

    public function viewallattendant($activity_id = null){
        if(!$this->Activityapplicant->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->Activityapplicant->Behaviors->load('Containable');
        $activityapplicants = $this->Activityapplicant->find('all', array(
            'conditions'=>array(
                'Activityapplicant.activity_id'=>$activity_id
            ),
            "contain"=>array(
                "Member",
                'Activityattendant.Attendant'
            )
        ));

        if(!empty($activityapplicants)){
            foreach($activityapplicants as $key=>$app){
                if(!empty($app['Activityattendant'])){
                    $tmp = array();
                    foreach($app['Activityattendant'] as $appatt){
                        $tmp[$appatt['activitysession_id']] = $appatt;
                    }
                    $activityapplicants[$key]['Activityattendant'] = $tmp;
                }
            }
        }
        $this->Activityapplicant->Activity->Behaviors->load('Containable');
        $activity = $this->Activityapplicant->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id),
            "contain"=>array(
                "Activitysession"=>array(
                    'order' => 'Activitysession.date ASC'
                )
            )
        ));
//        Configure::write('debug', 2);
//        debug($activityapplicants);
        $this->set('activityapplicants', $activityapplicants);
        $this->set('activity', $activity);
    }

    public function enrol($activity_id = null){
//        Configure::write('debug', 2);
//        $this->cutoffdatecheck();
        $this->layout = "withoutmenu";
        if(!$this->Activityapplicant->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }

        $this->Activityapplicant->Activity->Behaviors->load('Containable');
        $activity = $this->Activityapplicant->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id),
            "contain"=>array(
                "Activityfee.Membertype",
                "Eventproposal"
            )
        ));

        $this->set("quota", $this->Activityapplicant->Activity->getquota($activity_id));
//        debug($activity);
        $enrolstatuscheckmsg = "";
        $enrolstatuscheck = $this->Activityapplicant->Activity->enrolstatuscheck($activity_id, $enrolstatuscheckmsg);

        $this->set('enrolstatuscheck', $enrolstatuscheck);
        $this->set('enrolstatuscheckmsg', $enrolstatuscheckmsg);
        $this->set('activity', $activity);
    }

    public function getactivityfee_member($activity_id = null, $member_id=null){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $tel = "";
        $errormsg = "";

        if($this->Activityapplicant->Member->exists($member_id)){
            //check join already?
            $check = $this->Activityapplicant->applicationcheck($member_id, $activity_id, $errormsg);

            if(!$check){

            }else{
                $this->Activityapplicant->Member->Behaviors->load('Containable');
                $member = $this->Activityapplicant->Member->find("first",
                    array(
                        "conditions"=>array(
                            $this->Activityapplicant->Member->alias.".id"=>$member_id
                        ),
                        "contain"=>array(
                            "MemberCustomField",
                            "Membertype"
                        )
                    )
                );
                $fee_result = $this->Activityapplicant->Activity->Activityfee->find("first", array(
                    "conditions"=>array(
                        "Activityfee.membertype_id"=>$member['Member']['membertype_id'],
                        'Activityfee.activity_id'=>$activity_id
                    )
                ));
                if(!empty($fee_result)){
                    $fee = $fee_result['Activityfee']['fee'];
                }else{
                    $fee_default = $this->Activityapplicant->Activity->Activityfee->find("first", array(
                        "conditions"=>array(
                            "Activityfee.membertype_id"=>1,
                            'Activityfee.activity_id'=>$activity_id
                        )
                    ));
                    $fee = $fee_default['Activityfee']['fee'];
                }

                if(!empty($member['MemberCustomField'])){
                    foreach($member['MemberCustomField'] as $field){
                        switch($field['memberinputfield_id']){
                            case configure::read("Memberinputfield.phone_main_index"):
                                $tel = $field['value'];
                        }
                    }
                }

                $result = array(
                    "Member"=>array(
                        'id'=>$member['Member']['id'],
                        'membertype'=>$member['Membertype']['name'],
                        'code'=>$member['Member']['code'],
                        'c_name'=>$member['Member']['c_name'],
                        'e_name'=>$member['Member']['e_name'],
                        'tel'=>$tel,
                    ),
                    "fee"=>$fee,
                );
            }
        }
        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );
    }

    public function ajax_apply(){
        //Configure::write('debug', 2);
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg = "";

        $enrolstatuscheckmsg = "";
        $enrolstatuscheck = $this->Activityapplicant->Activity->enrolstatuscheck($this->request->data['Activityapplication']['activity_id'], $enrolstatuscheckmsg);

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Activityapplicant->begin();
            $error = false;
            if(!empty($this->request->data['Activityapplicant'])){

                //check quota
                $quota = $this->Activityapplicant->Activity->getquota($this->request->data['Activityapplication']['activity_id']);

                if($quota < sizeof($this->request->data['Activityapplicant'])){
                    $error = true;
                    $errormsg = "名額不足，只餘下".$quota."人";
                }
                else{
                    foreach($this->request->data['Activityapplicant'] as $key=>$applicant){
                        if(!$this->Activityapplicant->applicationcheck($applicant['member_id'], $applicant['activity_id'], $errormsg)){
                            $error = true;
                            break;
                        }
                        $this->request->data['Activityapplicant'][$key]['systemlog'] = $enrolstatuscheckmsg;

                        $act = $this->Activityapplicant->Activity->read(null,$this->request->data['Activityapplication']['activity_id'] );
                        if($this->Activityapplicant->Member->checkreportrange($applicant['member_id'], $act['Activity']['startdate'], $act['Activity']['enddate'])){
                            $this->request->data['Activityapplicant'][$key]['count_as_swd'] = 1;
                        }else{
                            $this->request->data['Activityapplicant'][$key]['count_as_swd'] = 0;
                        }
                    }
                    if(!$error){
                        $this->request->data['Activityapplication']['code'] = $this->Activityapplicant->Activityapplication->getcode();
                        if(!$enrolstatuscheck){
                            $this->request->data['Activityapplication']['systemlog'] = $enrolstatuscheckmsg;
                        }
                    }
                    if(!$error && $this->Activityapplicant->Activityapplication->saveAssociated($this->request->data, array('deep'=>true))){
                        $result = array("id"=>$this->Activityapplicant->Activityapplication->id);
                        $this->Activityapplicant->commit();
                    }

                }

                if($error){
                    $this->Activityapplicant->rollback();
                }
            }
        }
        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );
    }

    public function ajax_updateremarks(){
        $this->autoRender = false;
        $remarks = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->Activityapplicant->id = $pk;
            $this->Activityapplicant->saveField(
                "remarks",
                $remarks
            );
            echo "OK";
        }
    }

    public function ajax_histories()
    {
        //Configure::write('debug',2);
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

        $options['contain'] = array(
            "Activity",
            "Activityapplication",
            "Member"
            //"Activityapplication.Receipt"
        );


        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];
            $options['conditions']['OR']["Member.code LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Activityapplicant.c_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Activityapplicant.e_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Activityapplication.payment_code LIKE"] = '%' . $input['sSearch'] . '%';

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


                    if($field == "Activityapplication.date"){
                        $options['order'][] = array('Activityapplication.date'=>$order, 'Activityapplication.id'=>$order);

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

        $this->Activityapplicant->Behaviors->load('Containable');


        //print_r($options);

        $result = $this->Activityapplicant->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Activityapplicant->find('count',$options);
        $all_count = $this->Activityapplicant->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        foreach ( $result as $doc ) {


            //$doc['Activityapplicant']['id'] = $doc['Activityapplicant']['id'];
            $doc['Activityapplicant']['name'] = $doc['Activityapplicant']['c_name']."<br>".$doc['Activityapplicant']['e_name'];
            $doc['Activityapplicant']['membercode'] = "";
            if($doc['Member']['code']){
                $doc['Activityapplicant']['membercode'] = $doc['Member']['code'];
            }


            //$doc['Activityapplicant']['created'] = $doc['Activityapplicant']['created'];
            //print_R($doc);

            $output['aaData'][] = $doc;
        }

        echo json_encode( $output );


    }

    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "getactivityfee_member";
        $this->Security->unlockedActions[] = "ajax_updateremarks";
        $this->Security->unlockedActions[] = "ajax_histories";

        if($this->request['action'] == 'exportattendentsheet'){
            $this->Security->csrfUseOnce = false;
        }

        if($this->request['action'] == 'ajax_apply'){
            $this->Security->csrfUseOnce = false;
            $this->Security->unlockedFields = array('Activityapplicant');
        }
        parent::beforeFilter();
    }

}
