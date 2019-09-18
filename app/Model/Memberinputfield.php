<?php
App::uses('AppModel', 'Model');
/**
 * Memberinputfield Model
 *
 * @property Inputtype $Inputtype
 * @property Selectionlist $Selectionlist
 * @property Member $Member
 */
class Memberinputfield extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'inputtype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cannull' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Inputtype' => array(
			'className' => 'Inputtype',
			'foreignKey' => 'inputtype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Selectionlist' => array(
			'className' => 'Selectionlist',
			'foreignKey' => 'selectionlist_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */

    public $hasMany = array(
        'MembersMemberinputfield' => array(
            'className' => 'MembersMemberinputfield'
        )
    );

    public function beforeFind(array $query){
        $query['conditions'][$this->alias.'.active'] = 1;
        return $query;
    }

}
