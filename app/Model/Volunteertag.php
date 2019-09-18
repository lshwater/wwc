<?php
App::uses('AppModel', 'Model');

class Volunteertag extends AppModel {


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
            'joinTable' => 'volunteers_volunteertags',
            'foreignKey' => 'volunteertag_id',
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
