<?php
App::uses('AppModel', 'Model');

class Workflow extends AppModel {

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
        'Workflowstatus' => array(
            'className' => 'Workflowstatus',
            'foreignKey' => 'workflow_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Workflowstep' => array(
            'className' => 'Workflowstep',
            'foreignKey' => 'workflow_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

}
