<?php
App::uses('AppModel', 'Model');

class Dbfield extends AppModel {

    public $belongsTo = array(
        'Dbmodel' => array(
            'className' => 'Dbmodel',
            'foreignKey' => 'model_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Dbfielddropdown' => array(
            'className' => 'Dbfielddropdown',
            'foreignKey' => 'dbfield_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
