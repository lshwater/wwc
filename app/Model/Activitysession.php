<?php
App::uses('AppModel', 'Model');


class Activitysession extends AppModel {

    public $validate = array(
        'date' => "date"
    );

    public $belongsTo = array(
        'Activity' => array(
            'className' => 'Activity',
            'foreignKey' => 'activity_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Countuser' => array(
            'className' => 'Countuser',
            'foreignKey' => 'countuser_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'Activityattendant' => array(
            'className' => 'Activityattendant',
            'foreignKey' => 'activitysession_id',
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
        'ActivitiesVolunteerAttendant' => array(
            'className' => 'ActivitiesVolunteerAttendant',
            'foreignKey' => 'activitysession_id',
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
    public $actsAs = array('Containable', 'Linkable.Linkable');

    //pre: user_id, session start date(YYYY-MM-DD), session end date(YYYY-MM-DD), activity group id, user's unit id
    //post: session count with matched search criteria
    public function session_count($user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null, $is_publish = null) {
        $conditions = array();

        $conditions['AND']['not'] = array('Activity.id'=>null);

        if(!empty($user_id)){
            $conditions['AND'][$this->alias . ".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias . ".date >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias . ".date <="] = $end_date;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND']["Activity.activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($unit_id)){
            $conditions['AND'][$this->Activity->Unit->alias.".id"] = $unit_id;
        }

        if(isset($is_publish)){
            if($is_publish === 0){
                $conditions['AND']["Activity.publish"] = 0;
            }else if($is_publish === 1){
                $conditions['AND']["Activity.publish"] = 1;
            }
        }


        $options = array(
            'fields' => array(
                "sum(Activitysession.session) AS total_count",
            ),
            'link' => array(
                'Activity'=>array(
                    'link'=>array(
                        'Activitytype',
                        'Unit'
                    )
                ),
                'Countuser',

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

    //pre: user_id, session start date(YYYY-MM-DD), session end date(YYYY-MM-DD), activity group id, user's unit id, activity id
    //post: list of sessions with matched search criteria
    public function session_list($user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null, $activity_id=null, $is_publish=null) {
        $conditions = array();
        $link['Activitygroup'] = array(
            'fields'=>array(
                'Activitygroup.name'
            )
        );

        if(!empty($user_id)){
            $conditions['AND'][$this->alias . ".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias . ".date >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias . ".date <="] = $end_date;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND']["Activity.activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($activity_id)){
            $conditions['AND']["Activity.id"] = $activity_id;
        }
        if(!empty($unit_id)){
            $conditions['AND']["Unit.id"] = $unit_id;
            $link['Unit'] = array(
                'fields'=>array(
                    'Unit.name'
                )
            );
        }

        if(isset($is_publish)){
            if($is_publish === 0){
                $conditions['AND']["Activity.publish"] = 0;
            }else if($is_publish === 1){
                $conditions['AND']["Activity.publish"] = 1;
            }
        }

        $options = array(
            'fields' => array(
                'Activitysession.id',
                "Activitysession.date",
                "Activitysession.starttime",
                "Activitysession.endtime",
                "Activitysession.session",
                "(Activitysession.extra_attendant * Activitysession.session) as total_extra_attendant"
            ),
            'link' => array(
                'Activity'=>array(
                    'fields'=>array(
                        'Activity.id',
                        "Activity.name",
                        "Activity.activity_code"
                    ),
                    'link'=>$link
                ),
                'Countuser'=>array(
                    'fields'=>array(
                        'Countuser.name'
                    )
                ),

            ),
            "conditions"=>$conditions,
            "order"=>"Activitysession.date DESC"
        );

        return $this->find('all',$options);
    }

    //pre: user_id, session start date(YYYY-MM-DD), session end date(YYYY-MM-DD), activity group id, user's unit id, activity id
    //post: list of sessions with matched search criteria
    public function session_count_by_activity($user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null, $activity_id=null, $is_publish=null) {
        $conditions = array();
        $link['Activitygroup'] = array(
            'fields'=>array(
                'Activitygroup.name'
            )
        );

        if(!empty($user_id)){
            $conditions['AND'][$this->alias . ".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias . ".date >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias . ".date <="] = $end_date;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND']["Activity.activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($activity_id)){
            $conditions['AND']["Activity.id"] = $activity_id;
        }
        if(!empty($unit_id)){
            $conditions['AND']["Unit.id"] = $unit_id;
            $link['Unit'] = array(
                'fields'=>array(
                    'Unit.name'
                )
            );
        }

        if(isset($is_publish)){
            if($is_publish === 0){
                $conditions['AND']["Activity.publish"] = 0;
            }else if($is_publish === 1){
                $conditions['AND']["Activity.publish"] = 1;
            }
        }

        $options = array(
            'fields' => array(
                "sum(Activitysession.session) as total_session_count",
                "sum(Activitysession.session * Activitysession.extra_attendant) as total_extra_attendant"
            ),
            'link' => array(
                'Activity'=>array(
                    'fields'=>array(
                        'Activity.id',
                        "Activity.name",
                        "Activity.activity_code",
                        "Activity.startdate",
                        "Activity.enddate",
                    ),
                    'link'=>$link
                ),
                'Countuser'=>array(
                    'fields'=>array(
                        'Countuser.name'
                    )
                ),

            ),
            "conditions"=>$conditions,
            "group"=>array("Activity.id")
        );

        return $this->find('all',$options);
    }
}
