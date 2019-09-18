<?php
App::uses('AppModel', 'Model');
/**
 * Selectionlist Model
 *
 * @property Selectionitem $Selectionitem
 * @property Userinputfield $Userinputfield
 */
class Selectionlist extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Selectionitem' => array(
			'className' => 'Selectionitem',
			'foreignKey' => 'selectionlist_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Userinputfield' => array(
			'className' => 'Userinputfield',
			'foreignKey' => 'selectionlist_id',
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

    public function afterFind($results, $primary = false) {

        if(isset($results[$this->Selectionitem->alias])){
            foreach ($results[$this->Selectionitem->alias] as $key => $val) {
                $results[$this->Selectionitem->alias][$key]['name'] = $this->dateFormatAfterFind(
                    $val['name']
                );
            }
        }
        return $results;
    }

    public function dateFormatAfterFind($dateString) {
        return h(__($dateString));
    }

}
