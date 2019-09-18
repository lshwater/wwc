<?php
App::uses('AppModel', 'Model');

class Eventfinalreport extends AppModel {

    public $hasAndBelongsToMany = array(

    );

    public $belongsTo = array(
        'Eventproposal'=> array(
            'className' => 'Eventproposal',
            'foreignKey' => 'eventproposal_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Approvalrecordstatus' => array(
            'className' => 'Approvalrecordstatus',
            'foreignKey' => 'approvalrecordstatus_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'conditions' => array('model'=>'Eventfinalreport'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Eventarrangement' => array(
            'className' => 'Eventarrangement',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'conditions' => array('model'=>'Eventfinalreport'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        "Approvalrecord"=> array(
            'className' => 'Approvalrecord',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'conditions' => array('model'=>'Eventfinalreport'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

    public $hasOne =  array(
        'Financialbalance' => array(
            'className' => 'Financialbalance',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'conditions' => array('Financialbalance.model'=>'Eventfinalreport'),
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
