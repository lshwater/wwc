<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Eventproposaltarget extends AppModel {

    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    public $hasAndBelongsToMany = array(
        'Volunteer' => array(
            'className' => 'Volunteer',
            'joinTable' => 'volunteers_eventproposaltargets',
            'foreignKey' => 'eventproposaltarget_id',
            'associationForeignKey' => 'volunteer_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Member' => array(
            'className' => 'Member',
            'joinTable' => 'members_eventproposaltargets',
            'foreignKey' => 'eventproposaltarget_id',
            'associationForeignKey' => 'member_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );
}
