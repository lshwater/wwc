<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Stocktype extends AppModel {



    public $belongsTo = array(
        'Unit' => array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'Stock' => array(
            'className' => 'Stock',
            'foreignKey' => 'type',
            'dependent' => true,
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
