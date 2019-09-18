<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Volunteertype extends AppModel {

    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Value already exist',
            ),
        ),
    );

    public $hasAndBelongsToMany = array(
        'Volunteer' => array(
            'className' => 'Volunteer',
            'joinTable' => 'volunteers_volunteertypes',
            'foreignKey' => 'volunteertype_id',
            'associationForeignKey' => 'volunteer_id',
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
