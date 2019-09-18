<?php
App::uses('AppModel', 'Model');


class Activityapplication extends AppModel {

    public $belongsTo = array(
        'Activity' => array(
            'className' => 'Activity',
            'foreignKey' => 'activity_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $validate = array(
        'code' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Value already exist',
            ),
        )
    );

    public $hasMany = array(
        'Activityapplicant' => array(
            'className' => 'Activityapplicant',
            'foreignKey' => 'activityapplication_id',
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

    public function getcode($date = null){
        if(!$date){
            $date = date("Y-m-d");
        }

        $yr = date("Y-m-1", strtotime($date));
        $rs = $this->find("count", array(
           "conditions"=>array(
               $this->alias.".date >="=>$yr
           )
        ));
        return date("ym", strtotime($date))."/".str_pad($rs+1, 4, '0', STR_PAD_LEFT);
    }

}
