<?php
App::uses('AppModel', 'Model');
/**
 * Agency Model
 *
 * @property Unit $Unit
 */
class Activity extends AppModel {

    public $validate = array(
        'activity_code' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Value already exist',
            )
        ),
        'publish' => array(
            'myCheckbox' => array(
                'rule'    => array('boolean'),
                'message' => 'Incorrect value'
            )
        ),
        'countstat' => array(
            'myCheckbox' => array(
                'rule'    => array('boolean'),
                'message' => 'Incorrect value'
            )
        ),
        'startdate' => "date",
        'enddate' => "date"
    );

    public $belongsTo = array(
        "Countuser"=> array(
            'className' => 'Countuser',
            'foreignKey' => 'countuser_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Eventproposal' => array(
            'className' => 'Eventproposal',
            'foreignKey' => 'eventproposal_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Activitygroup",
        "Closereason"=> array(
            'className' => 'Closereason',
            'foreignKey' => 'closereason_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Activitytype"
    );

    public $hasMany = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'conditions' => array('model'=>'Activity'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Activityapplicant' => array(
            'className' => 'Activityapplicant',
            'foreignKey' => 'activity_id',
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
        'ActivitiesVolunteer' => array(
            'className' => 'ActivitiesVolunteer',
            'foreignKey' => 'activity_id',
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
        "Activitysession"=> array(
            'className' => 'Activitysession',
            'foreignKey' => 'activity_id',
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
        'Activityfee'=> array(
            'className' => 'Activityfee',
            'foreignKey' => 'activity_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $hasAndBelongsToMany = array(
        'Unit' => array(
            'className' => 'Unit',
            'joinTable' => 'activities_units',
            'foreignKey' => 'activity_id',
            'associationForeignKey' => 'unit_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public $actsAs = array('Containable', 'Linkable.Linkable');

    public function gencode($id = null){
//        Configure::write('debug',2);
        if(!$this->exists($id)){
            return false;
        }
        $this->Behaviors->load('Containable');
        $rs = $this->find("first", array(
            "contain"=>array(
                "Eventproposal.Activity"=>array(
                    "conditions"=>array(
                        "Activity.publish"=>1
                    )
                )
            ),
            "conditions" =>array(
                $this->alias.".id"=>$id
            )
        ));

//        debug($rs);exit();
        $code = $rs['Eventproposal']['event_code']."-".str_pad(count($rs['Eventproposal']['Activity']), 2, 0, STR_PAD_LEFT);
        $this->id = $id;
        $this->saveField("activity_code", $code);

    }

    public function getquota($id = null){
        if(!$this->exists($id)){
            return false;
        }
        $this->Behaviors->load('Containable');
        $rs = $this->find("first", array(
            "conditions" =>array(
                $this->alias.".id"=>$id
            )
        ));
        $register = $this->Activityapplicant->find("count", array(
            "conditions" =>array(
                $this->Activityapplicant->alias.".activity_id"=>$id,
                $this->Activityapplicant->alias.".valid"=>1,
            )
        ));

        return $rs['Activity']['quota'] - $register;
    }

    public function enrolstatuscheck($id = null, &$msg){
        if(!$this->exists($id)){
            $msg = "活動不存在";
            return false;
        }

        //enrol date check
        $this->recursive = -1;
        $rs = $this->find("first", array(
            "conditions" =>array(
                $this->alias.".id"=>$id
            )
        ));
        if($rs['Activity']['closed']){
            $msg = "活動已完結。";
            return false;
        }
        if(strtotime($rs['Activity']['enrolstart']) > time()){
            $msg = "活動報名日期未開始。";
            return false;
        }
        if(strtotime($rs['Activity']['enrolend']) < time()){
            $msg = "活動報名日期已過。";
            return false;
        }
        //活動是否已公開或生效中
        if(!$rs['Activity']['active']){
            $msg = "活動已結束。";
            return false;
        }
        else if(!$rs['Activity']['publish']){
            $msg = "活動未公開。";
            return false;
        }

        return true;
    }

    public function activity_count($user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null) {
        $conditions['AND'][$this->alias.".publish"] = 1;

        if(!empty($user_id)){
            $conditions['AND'][$this->alias.".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias.".startdate <="] = $end_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias.".enddate >="] = $start_date;
        }
        if(!empty($activity_id)){
            $conditions['AND'][$this->alias.".id"] = $activity_id;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND'][$this->alias.".activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($unit_id)){
            $conditions['AND'][$this->Unit->alias.".id"] = $unit_id;
        }

        $options = array(
            'link' => array(
                'Unit'
            ),
            "conditions"=>$conditions
        );

        $tmp = $this->find('count',$options);
        return $tmp;
    }

    public function closeactivity_list($user_id = null, $start_date = null, $end_date = null, $activitygroup_id = null, $unit_id = null) {

        $conditions['AND'][$this->alias.".closed"] = 1;

        if(!empty($user_id)){
            $conditions['AND'][$this->alias.".countuser_id"] = $user_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias.".closedate >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias.".closedate <="] = $end_date;
        }
        if(!empty($activity_id)){
            $conditions['AND'][$this->alias.".id"] = $activity_id;
        }
        if(!empty($activitygroup_id)){
            $conditions['AND'][$this->alias.".activitygroup_id"] = $activitygroup_id;
        }
        if(!empty($unit_id)){
            $conditions['AND'][$this->Unit->alias.".id"] = $unit_id;
        }

        $options = array(
            'link' => array(
                'Unit'
            ),
            "conditions"=>$conditions
        );

        $rs = $this->find('all',$options);
        return $rs;

    }

}
