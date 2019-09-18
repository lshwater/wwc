œ<?php
App::uses('AppController', 'Controller');


class ActivitiesVolunteerAttendantsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function takeatt($session_id = null, $activity_id = null, $vtype_id = null){


        $this->layout = "withoutmenu";

        if(empty($activity_id) || empty($session_id) || empty($vtype_id) || !$this->ActivitiesVolunteerAttendant->Activitysession->exists($session_id)){
            throw new NotFoundException(__('Invalid'));
        }

        $this->ActivitiesVolunteerAttendant->Activitysession->Behaviors->load('Containable');
        $activitysession = $this->ActivitiesVolunteerAttendant->Activitysession->find("first",array(
            'conditions'=>array(
                'Activitysession.id'=>$session_id
            ),
            'contain' => array(
                'Activity'
            )
        ));

        //check CutOff Date
        $cutoffdatemsg = '';
        if($this->Cutoffdate->canchange($activitysession['Activitysession']['date'], $cutoffdatemsg)){
            $this->set('cutoffdatemsg', $cutoffdatemsg);
        }else{
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("cutoffdate_msg_title"));
            $this->set('errormsg', __("cutoff_time"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        //點名權限
        if(!$this->ActivitiesVolunteerAttendant->Activitysession->Activity->Eventproposal->isAuth($activitysession['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

//
        if ($this->request->is(array('post', 'put'))) {
            $this->Session->setFlash(__('存儲失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00040".')', 'default', array('class'=>'alert alert-danger'));
            $this->ActivitiesVolunteerAttendant->begin();
            if($this->ActivitiesVolunteerAttendant->saveAll($this->request->data)) {
                    $this->ActivitiesVolunteerAttendant->commit();
                    $this->Session->setFlash(__('已存儲'), 'default', array('class'=>'alert alert-success'));
            }
        }
        $volunteertype = $this->ActivitiesVolunteerAttendant->ActivitiesVolunteer->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->ActivitiesVolunteerAttendant->ActivitiesVolunteer->Volunteer->Volunteertype->alias.".id"=>$vtype_id
            ),
            "recursive"=>-1
        ));

        $this->ActivitiesVolunteerAttendant->ActivitiesVolunteer->Behaviors->load('Containable');
        $attendees = $this->ActivitiesVolunteerAttendant->ActivitiesVolunteer->find("all",array(
            'conditions'=>array(
                'ActivitiesVolunteer.activity_id'=>$activity_id,
                //'ActivitiesVolunteer.valid'=>1,
            ),
            "order"=>array(
                "ActivitiesVolunteer.valid DESC"
            ),
            'contain' => array(
                'Volunteer',
            )
        ));

//        //get atts taken
        $this->ActivitiesVolunteerAttendant->Behaviors->load('Containable');
        $atts = $this->ActivitiesVolunteerAttendant->find('all', array(
            "conditions"=>array(
                "ActivitiesVolunteerAttendant.activitysession_id"=>$session_id
            ),
            "fields"=>array(
                'activities_volunteer_id', 'attendant_id' ,"id"
            )
        ));

        $sorted_atts = array();
        if(!empty($atts)){
            foreach($atts as $val){
                $sorted_atts[$val['ActivitiesVolunteerAttendant']['activities_volunteer_id']] = $val['ActivitiesVolunteerAttendant'];
            }
        }

        $attendantchoices = $this->ActivitiesVolunteerAttendant->Attendant->find('list');
        $this->set('activitysession', $activitysession);
        $this->set('volunteertype', $volunteertype);
        $this->set('attendees', $attendees);
        $this->set('atts', $sorted_atts);
        $this->set("attendantchoices", $attendantchoices);
    }


    public function beforeFilter()
    {
        parent::beforeFilter();
    }

}
