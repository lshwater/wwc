<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Eventarrangement extends AppModel {

    public $belongsTo = array(
        'Eventarrangementtype' => array(
            'className' => 'Eventarrangementtype',
            'foreignKey' => 'eventarrangementtype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Eventproposal' => array(
            'className' => 'Eventproposal',
            'foreignKey' => 'eventproposal_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
