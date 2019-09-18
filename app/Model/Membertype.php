<?php
App::uses('AppModel', 'Model');

class Membertype extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
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

//    public function afterFind($results, $primary = false) {
//        foreach ($results as $key => $val) {
//            if(isset($val[$this->alias])){
//                $results[$key][$this->alias]['name'] = $this->dateFormatAfterFind(
//                    $val[$this->alias]['name']
//                );
//            }
//        }
//        return $results;
//    }

//    public function dateFormatAfterFind($dateString) {
//        return h(__($dateString));
//    }
}
