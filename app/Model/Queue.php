<?php
App::uses('AppModel', 'Model');
/**
 * Queue Model
 *
 */
class Queue extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'controller' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'action' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'var' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
		),
	);

    public function push_back($controller, $action, $var){

        if(empty($controller) || empty($action)){
            return false;
        }

        $data2save = array(
            'controller'=>$controller,
            'action'=>$action,
            'var'=>serialize($var)
        );


        return $this->save($data2save);
    }

    public function pop(){
        $rs = $this->find('first', array(
            'order'=>array(
                $this->alias.'.created ASC'
            )
        ));
        return $rs;
    }
}
