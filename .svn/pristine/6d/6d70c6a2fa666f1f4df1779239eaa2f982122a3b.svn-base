<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ActivitiesVolunteersController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function view($id = null){
        if(!$this->ActivitiesVolunteer->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->ActivitiesVolunteer->Behaviors->load('Containable');
        $activityapplicant = $this->ActivitiesVolunteer->find('first', array(
            'conditions'=>array('ActivitiesVolunteer.id'=>$id),
            "contain"=>array(
                "Volunteer",
                "Volunteerunit"
            )
        ));
        $this->set('activityapplicant', $activityapplicant);
    }

    public function edit($id = null){
        if (!$this->ActivitiesVolunteer->exists($id)) {
            throw new NotFoundException(__('Invalid Activityapplicant'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ActivitiesVolunteer->save($this->request->data)) {
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
            $options = array('conditions' => array('ActivitiesVolunteer.' . $this->ActivitiesVolunteer->primaryKey => $id));
            $this->request->data = $this->ActivitiesVolunteer->find('first', $options);
        }
    }

//default voluntertype = 1 義工
    public function management($activity_id = null, $voluntertype = 1){
        if(!$this->ActivitiesVolunteer->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->ActivitiesVolunteer->Activity->Behaviors->load('Containable');
        $activity = $this->ActivitiesVolunteer->Activity->find('first', array(
            'conditions'=>array(
                'Activity.id'=>$activity_id
            ),
            "contain"=>array(
                "ActivitiesVolunteer"=>array(
                    "Volunteer",
                    "Volunteerunit",
                    "conditions"=>array(
                        'ActivitiesVolunteer.volunteertype_id'=>$voluntertype
                    )
                )
            )
        ));

        $enroled = 0;
        if(!empty($activity['ActivitiesVolunteer'])){
            foreach($activity['ActivitiesVolunteer'] as $vo){
                if($vo['valid']){
                    $enroled++;
                }
            }
        }
        $volunteertype = $this->ActivitiesVolunteer->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->ActivitiesVolunteer->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $this->set('volunteertype', $volunteertype);
        $this->set('enroled', $enroled);
        $this->set('activity', $activity);
    }

//default voluntertype = 1 義工
    public function exportattendentsheet($activity_id = null, $voluntertype = 1){
        if(!$this->ActivitiesVolunteer->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }

        $this->ActivitiesVolunteer->Activity->Behaviors->load('Containable');
        $activity = $this->ActivitiesVolunteer->Activity->find('first', array(
            'conditions'=>array(
                'Activity.id'=>$activity_id
            ),
            "contain"=>array(
                "ActivitiesVolunteer"=>array(
                    "Volunteer",
                    "conditions"=>array(
                        'ActivitiesVolunteer.volunteertype_id'=>$voluntertype,
                        'ActivitiesVolunteer.valid'=>1
                    )
                )
            )
        ));

        if(empty($activity['ActivitiesVolunteer'])){
            $this->Session->setFlash(__('沒有參加者'), 'default', array('class'=>'alert alert-warning'));
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            if(!empty($redirecturl)){
                $this->redirect($redirecturl);
            }else{
                $this->redirect(array('action'=>'management', $activity_id, $voluntertype));
            }
        }

        $volunteertype = $this->ActivitiesVolunteer->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->ActivitiesVolunteer->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $dir = new Folder();
        $dir_path = "/tmp/".uniqid();
        while(!$dir->create($dir_path)){
            $dir_path = "/tmp/".uniqid();
        }

//        debug($activity);exit();
        $this->set('dir_path', $dir_path);
        $this->set('volunteertype', $volunteertype);
        $this->set('activity', $activity);
}

//default voluntertype = 1 義工
    public function enrol($activity_id = null, $voluntertype = 1){
//        Configure::write('debug', 2);

        $this->layout = "withoutmenu";
        if(!$this->ActivitiesVolunteer->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }

        $activity = $this->ActivitiesVolunteer->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id)
        ));

        $volunteertype = $this->ActivitiesVolunteer->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->ActivitiesVolunteer->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $volunteerunits = $this->ActivitiesVolunteer->Volunteerunit->find("list");

        $enrolstatuscheckmsg = "";
        $enrolstatuscheck = $this->ActivitiesVolunteer->Activity->enrolstatuscheck($activity_id, $enrolstatuscheckmsg);

        $this->set('enrolstatuscheck', $enrolstatuscheck);
        $this->set('volunteertype', $volunteertype);
        $this->set('enrolstatuscheckmsg', $enrolstatuscheckmsg);
        $this->set('activity', $activity);
        $this->set("volunteerunits", $volunteerunits);

    }

    public function viewallattendant($activity_id = null, $voluntertype = 1){
        if(!$this->ActivitiesVolunteer->Activity->exists($activity_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->ActivitiesVolunteer->Behaviors->load('Containable');
        $activitiesVolunteers = $this->ActivitiesVolunteer->find('all', array(
            'conditions'=>array(
                'ActivitiesVolunteer.activity_id'=>$activity_id,
                'ActivitiesVolunteer.volunteertype_id'=>$voluntertype,
            ),
            "contain"=>array(
                "Volunteer",
                'ActivitiesVolunteerAttendant.Attendant'
            )
        ));

        if(!empty($activitiesVolunteers)){
            foreach($activitiesVolunteers as $key=>$app){
                if(!empty($app['ActivitiesVolunteerAttendant'])){
                    $tmp = array();
                    foreach($app['ActivitiesVolunteerAttendant'] as $appatt){
                        $tmp[$appatt['activitysession_id']] = $appatt;
                    }
                    $activitiesVolunteers[$key]['ActivitiesVolunteerAttendant'] = $tmp;
                }
            }
        }

        $this->ActivitiesVolunteer->Activity->Behaviors->load('Containable');
        $activity = $this->ActivitiesVolunteer->Activity->find('first', array(
            'conditions'=>array('Activity.id'=>$activity_id),
            "contain"=>array(
                "Activitysession"=>array(
                    'order' => 'Activitysession.date ASC'
                )
            )
        ));


        $volunteertype = $this->ActivitiesVolunteer->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->ActivitiesVolunteer->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));
//        Configure::write('debug', 2);
//        debug($activitiesVolunteer);

        $this->set('activity', $activity);
        $this->set('activitiesVolunteers', $activitiesVolunteers);
        $this->set('volunteertype', $volunteertype);
    }

    public function ajax_validation($activity_id = null, $volunteer_id=null){
//        Configure::write('debug', 2);
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg = "";

        if($this->ActivitiesVolunteer->Volunteer->exists($volunteer_id)){
            //check join already?
            $check = $this->ActivitiesVolunteer->applicationcheck($volunteer_id, $activity_id, $errormsg);

            if(!$check){

            }else{
                $volunteer = $this->ActivitiesVolunteer->Volunteer->findById($volunteer_id);
                $result = array(
                    "Volunteer"=>array(
                        'id'=>$volunteer['Volunteer']['id'],
                        'code'=>h($volunteer['Volunteer']['code']),
                        'volunteerunit_id'=>h($volunteer['Volunteer']['volunteerunit_id']),
                        'c_name'=>h($volunteer['Volunteer']['c_name']),
                        'e_name'=>h($volunteer['Volunteer']['e_name']),
                        'phone_main'=>h($volunteer['Volunteer']['phone_main']),
                        'email'=>h($volunteer['Volunteer']['email']),
                    )
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

    public function changevalid($id = null, $valid = null){
        if (!$this->ActivitiesVolunteer->exists($id) || $valid === null) {
            throw new NotFoundException(__('Invalid Activityapplicant'));
        }
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->ActivitiesVolunteer->id = $id;
            if($valid == 0){
                if($this->ActivitiesVolunteer->saveField('valid', 0)){
                    $this->Session->setFlash("已成功取消", 'default', array('class'=>'alert alert-success'));
                }else{
                    $this->Session->setFlash("取消失敗", 'default', array('class'=>'alert alert-danger'));
                }
            }
            else if($valid == 1){
                if($this->ActivitiesVolunteer->saveField('valid', 1)){
                    $this->Session->setFlash("已成功加入", 'default', array('class'=>'alert alert-success'));
                }else{
                    $this->Session->setFlash("加入失敗", 'default', array('class'=>'alert alert-danger'));
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

    public function ajax_apply(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg = "";

        $enrolstatuscheckmsg = "";
        $enrolstatuscheck = $this->ActivitiesVolunteer->Activity->enrolstatuscheck($this->request->data['ActivitiesVolunteer'][0]['activity_id'], $enrolstatuscheckmsg);

        if ($this->request->is('post') || $this->request->is('put')) {
            $error = false;
            $this->ActivitiesVolunteer->begin();
            if(!empty($this->request->data['ActivitiesVolunteer'])){
                foreach($this->request->data['ActivitiesVolunteer'] as $key=>$applicant){
                    if(!$this->ActivitiesVolunteer->applicationcheck($applicant['volunteer_id'], $applicant['activity_id'], $errormsg)){
                        $error = true;
                        break;
                    }
                    $this->request->data['ActivitiesVolunteer'][$key]['systemlog'] = $enrolstatuscheckmsg;
                    $this->ActivitiesVolunteer->create();
                    if(!$error && $this->ActivitiesVolunteer->save($this->request->data['ActivitiesVolunteer'][$key])){
                        $result = array("id"=>$this->ActivitiesVolunteer->id);
                    }
                }
            }

            if(!$error){
                $this->ActivitiesVolunteer->commit();
            }
            else{
                $this->ActivitiesVolunteer->rollback();
            }
        }
        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );
    }

    public function receipt(){
        $this->layout = "withoutmenu";
    }

    public function ajax_updateremarks(){
        $this->autoRender = false;
        $remarks = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->ActivitiesVolunteer->id = $pk;
            $this->ActivitiesVolunteer->saveField(
                "remarks",
                $remarks
            );
            echo "OK";
        }
    }

    public function ajax_setservicehour(){
        $this->autoRender = false;
        $servicehour_count = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->ActivitiesVolunteer->id = $pk;
            $this->ActivitiesVolunteer->saveField(
                "servicehour_count",
                $servicehour_count
            );
            echo "OK";
        }
    }


    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "ajax_validation";
        $this->Security->unlockedActions[] = "ajax_updateremarks";
        $this->Security->unlockedActions[] = "ajax_setservicehour";

        if($this->request['action'] == 'ajax_apply'){
            $this->Security->csrfUseOnce = false;
            $this->Security->validatePost = false;
        }

        if($this->request['action'] == 'exportattendentsheet'){
            $this->Security->csrfUseOnce = false;
        }

        parent::beforeFilter();
    }

}
