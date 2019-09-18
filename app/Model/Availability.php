<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Availability extends AppModel {

    public $hasAndBelongsToMany = array(
        'Volunteer' => array(
            'className' => 'Volunteer',
            'joinTable' => 'volunteers_availabilities',
            'foreignKey' => 'availability_id',
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
