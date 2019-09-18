<?php
App::uses('AppModel', 'Model');

class Eventproposalcode extends AppModel {
    public $hasMany = array(
        'Eventproposal' => array(
            'className' => 'Eventproposal',
            'foreignKey' => 'eventproposalcode_id',
            'dependent' => true,
            'conditions' => "",
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        "Eventproposalnextcode"=> array(
            'className' => 'Eventproposalnextcode',
            'foreignKey' => 'eventproposalcode_id',
            'dependent' => true,
            'conditions' => "",
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
