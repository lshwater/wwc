<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Eventproposalpromotion extends AppModel {

    public $hasAndBelongsToMany = array(
        'Eventproposal' => array(
            'className' => 'Eventproposal',
            'joinTable' => 'eventproposal_eventproposalpromotions',
            'foreignKey' => 'eventproposalpromotion_id',
            'associationForeignKey' => 'eventproposal_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
    );
}
