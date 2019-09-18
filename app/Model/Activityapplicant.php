<?php
App::uses('AppModel', 'Model');


class Activityapplicant extends AppModel {

    public $validate = array(
        'member_id' => array(
            'rule' => array('isUniqueMulti', array('member_id', 'activity_id')),
            'message' => '已報名',
        ),

    );

    public $belongsTo = array(
        'Activity' => array(
            'className' => 'Activity',
            'foreignKey' => 'activity_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Activityapplication' => array(
            'className' => 'Activityapplication',
            'foreignKey' => 'activityapplication_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'Activityattendant' => array(
            'className' => 'Activityattendant',
            'foreignKey' => 'activityapplicant_id',
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

    function applicationcheck($member_id = null, $activity_id = null, &$msg = null){

        //memberonly?
        $activity = $this->Activity->find('first', array(
                'conditions'=>array('Activity.id'=>$activity_id),
                "recursive"=>-1
            )
        );
        if($activity['Activity']['memberonly']){
            if(empty($member_id)){
                $msg =  "只接受會員報名。";
                return false;
            }
        }


        if(!empty($member_id)){
            //double application check
            $this->Member->recursive = 0;
            $member = $this->Member->findById($member_id);
            $doublecheck = $this->find("first", array(
                "conditions"=>array(
                    "Activityapplicant.member_id"=>$member_id,
                    'Activityapplicant.activity_id'=>$activity_id
                ),
                "recursive"=>0
            ));
            if(!empty($doublecheck) && $doublecheck['Activityapplicant']['valid'] == 1){
                $msg =  "會員 (".h($member['Member']['code']).") 已經報名！";
                return false;
            }
            if(!empty($doublecheck) && $doublecheck['Activityapplicant']['valid'] == 0){
                $msg =  "會員 (".h($member['Member']['code']).") 曾經報名並已經退出，不能重覆報名";
                return false;
            }

            //membership cover?
            if(empty($activity['Activity']['membershipcheck'])){
                $datecheck = date("Y-m-d");
            }else{
                $datecheck = $activity['Activity']['membershipcheck'];
            }
            if(!$this->Member->checkmembership($member_id, $datecheck, $msg)){
                return false;
            }
        }

        return true;
    }
}
