<?php
App::uses('AppModel', 'Model');


class ActivitiesVolunteer extends AppModel {

    public $validate = array(
        'volunteer_id' => array(
            'rule' => array('isUniqueMulti', array('volunteer_id', 'activity_id')),
            'message' => '已報名',
        ),
        'servicehour_count' => array(
            'rule' => 'naturalNumber',
            'message' => '必須是正數'
        )
    );

    public $belongsTo = array(
        'Activity' => array(
            'className' => 'Activity',
            'foreignKey' => 'activity_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Volunteer' => array(
            'className' => 'Volunteer',
            'foreignKey' => 'volunteer_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Volunteerunit' => array(
            'className' => 'Volunteerunit',
            'foreignKey' => 'volunteerunit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'ActivitiesVolunteerAttendant' => array(
            'className' => 'ActivitiesVolunteerAttendant',
            'foreignKey' => 'activities_volunteer_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

    function applicationcheck($volunteer_id = null, $activity_id = null, &$msg = null){

        if(!empty($volunteer_id)){
            //double application check
            $this->Volunteer->recursive = 0;
            $volunteer = $this->Volunteer->findById($volunteer_id);
            $doublecheck = $this->find("first", array(
                "conditions"=>array(
                    "ActivitiesVolunteer.volunteer_id"=>$volunteer_id,
                    'ActivitiesVolunteer.activity_id'=>$activity_id
                ),
                "recursive"=>0
            ));
            if(!empty($doublecheck) && $doublecheck['ActivitiesVolunteer']['valid'] == 1){
                $msg =  "義工 (".h($volunteer['Volunteer']['code']).") 已經報名！";
                return false;
            }
            if(!empty($doublecheck) && $doublecheck['ActivitiesVolunteer']['valid'] == 0){
                $msg =  "義工 (".h($volunteer['Volunteer']['code']).") 曾經報名並已經退出，不能重覆報名";
                return false;
            }
        }

        return true;
    }
}
