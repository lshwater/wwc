<?php
App::uses('AppModel', 'Model');


class ActivitiesVolunteerAttendant extends AppModel {

    public $validate = array(
        'activitysession_id' => array(
            'rule' => array('isUniqueMulti', array('activitysession_id', 'activities_volunteer_id')),
            'message' => '已點名',
        ),
    );

    public $belongsTo = array(
        'ActivitiesVolunteer' => array(
            'className' => 'ActivitiesVolunteer',
            'foreignKey' => 'activities_volunteer_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Attendant" => array(
            'className' => 'Attendant',
            'foreignKey' => 'attendant_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Activitysession" => array(
            'className' => 'Activitysession',
            'foreignKey' => 'activitysession_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $actsAs = array('Containable', 'Linkable.Linkable');

    //pre: user_id, session start date(YYYY-MM-DD), session end date(YYYY-MM-DD), activity group id, user's unit id, session id, attendant id, activity id
    //post: session count with matched search criteria
    public function volunteer_count($user_id = null, $start_date = null, $end_date = null, $attendant_id=null, $activitygroup_id = null, $unit_id = null, $session_id=null, $activity_id=null, $is_publish=null) {
        $conditions = array();

//        $conditions['AND'][$this->alias . ".attendant_id"] = "2";
        if(!empty($user_id)){
            $conditions['AND'][$this->Activitysession->alias.".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->Activitysession->alias.".date >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->Activitysession->alias.".date <="] = $end_date;
        }
        if(!empty($session_id)){
            $conditions['AND'][$this->Activitysession->alias.".id"] = $session_id;
        }
        if(!empty($activity_id)){
            $conditions['AND'][$this->Activitysession->Activity->alias.".id"] = $activity_id;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND'][$this->Activitysession->Activity->alias.".activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($unit_id)){
            $conditions['AND'][$this->Activitysession->Activity->Unit->alias.".id"] = $unit_id;
        }
        if(!empty($attendant_id)){
            $conditions['AND'][$this->alias . ".attendant_id"] = $attendant_id;
        }

        if(isset($is_publish)){
            if($is_publish === 0){
                $conditions['AND'][$this->Activitysession->Activity->alias.".publish"] = 0;
            }else if($is_publish === 1){
                $conditions['AND'][$this->Activitysession->Activity->alias.".publish"] = 1;
            }
        }

        $options = array(
            'link' => array(
                'Activitysession'=>array(
                    'link'=>array(
                        'Activity'=>array(
                            'link'=>array(
                                'Activitygroup',
                                'Unit'
                            )
                        ),
                        'Countuser'
                    ),
                    'fields'=>array(
                        "sum(Activitysession.session) AS total_count",
                    )
                ),
            ),
            "conditions"=>$conditions
        );

        $tmp = $this->find('all',$options);

        if(!$tmp){
            return "0";
        }else{
            return ($tmp[0][0]['total_count']==null)?"0":$tmp[0][0]['total_count'];
        }
    }

    public function count_attendance_volunteer($is_registered = null, $attendant_id = null, $user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null, $session_id=null, $activity_id=null, $is_publish=null){

        $conditions = [];

        if(isset($is_registered)){
            if($is_registered === 0){
                $conditions['AND'][$this->ActivitiesVolunteer->alias . ".volunteer_id"] = null;
            }else if($is_registered === 1){
                $conditions['AND']['not'][$this->ActivitiesVolunteer->alias . ".volunteer_id"] = null;
            }
        }
        if(!empty($attendant_id)){
            $conditions['AND'][$this->alias . ".attendant_id"] = $attendant_id;
        }
        if(!empty($user_id)){
            $conditions['AND'][$this->Activitysession->alias.".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->Activitysession->alias.".date >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->Activitysession->alias.".date <="] = $end_date;
        }
        if(!empty($session_id)){
            $conditions['AND'][$this->Activitysession->alias.".id"] = $session_id;
        }
        if(!empty($activity_id)){
            $conditions['AND'][$this->Activitysession->Activity->alias.".id"] = $activity_id;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND'][$this->Activitysession->Activity->alias.".activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($unit_id)){
            $conditions['AND'][$this->Activitysession->Activity->Unit->alias.".id"] = $unit_id;
        }

        if(isset($is_publish)){
            if($is_publish === 0){
                $conditions['AND'][$this->Activitysession->Activity->alias.".publish"] = 0;
            }else if($is_publish === 1){
                $conditions['AND'][$this->Activitysession->Activity->alias.".publish"] = 1;
            }
        }

        $options = array(
            'fields'=>array(
                'sum(Activitysession.session) AS total_session_count'
            ),
            'link' => array(
                'ActivitiesVolunteer',
                'Activitysession'=>array(
                    'link'=>array(
                        'Activity'=>array(
                            'link'=>array(
                                'Activitygroup',
                                'Unit'
                            )
                        )
                    )
                )
            ),
            'conditions'=>$conditions,
            'order'=>array(
                'total_session_count DESC'
            ),
            'group'=>array(
                'ActivitiesVolunteer.id'
            )
        );

        return $this->find('all',$options);
    }

}
