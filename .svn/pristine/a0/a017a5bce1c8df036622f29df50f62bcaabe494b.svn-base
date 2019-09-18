<?php
App::uses('AppModel', 'Model');

class Volunteerunit extends AppModel {

    public $validate = array(
        'name' => array(
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
            )
        ),
    );

    public $hasMany = array(
        'Volunteer' => array(
            'className' => 'Volunteer',
            'dependent' => false
        ),
        'ActivitiesVolunteer' => array(
            'className' => 'ActivitiesVolunteer',
            'foreignKey' => 'volunteerunit_id',
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

    //The Associations below have been created with all possible keys, those that are not needed can be removed
//    public $hasMany = array(
////        'Activity' => array(
////            'className' => 'Activity',
////            'dependent' => true
////        ),
//
//    );



}
