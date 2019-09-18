<?php
App::uses('AppModel', 'Model');

class Dbfielddropdown extends AppModel {

    public $belongsTo = array(
//        'Dbmodel' => array(
//            'className' => 'Dbmodel',
//            'foreignKey' => 'dbmodel_id',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),
        'Dbfield' => array(
            'className' => 'Dbfield',
            'foreignKey' => 'dbfield_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
