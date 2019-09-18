<?php
App::uses('AppModel', 'Model');
/**
 * Agency Model
 *
 * @property Unit $Unit
 */
class Agency extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Value already exist',
            ),
            'pattern'=>array(
                'rule'      => '/^[a-zA-Z0-9\w?!\.;:,@#$%^&*\/\[\]\(\)=\+-]*$/',
                'message'   => 'Only alphenumeric allowed',
            ),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'agency_id',
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
