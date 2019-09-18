<?php
App::uses('AppModel', 'Model');

class Customgroup extends AppModel {

    public $belongsTo = array(
//        'Customtype' => array(
//            'className' => 'Customtype',
//            'foreignKey' => 'type_id',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),
        'Customtype' => array(
            'className' => 'Customtype',
            'foreignKey' => 'type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Customlayout' => array(
            'className' => 'Customlayout',
            'foreignKey' => 'customgroup_id',
            'dependent' => false,
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

}
