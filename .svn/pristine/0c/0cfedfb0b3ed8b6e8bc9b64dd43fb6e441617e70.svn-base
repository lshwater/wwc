<?php
App::uses('AppModel', 'Model');
/**
 * UsersUserinputfield Model
 *
 * @property User $User
 * @property Userinputfield $Userinputfield
 * @property UsersUserinputfieldvalue $UsersUserinputfieldvalue
 */
class UsersUserinputfield extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'userinputfield_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Userinputfield' => array(
			'className' => 'Userinputfield',
			'foreignKey' => 'userinputfield_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public $actsAs = array('Containable');

    public function beforeValidate($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);


        if(!empty($this->data[$this->alias])){
            foreach($this->data[$this->alias] as $val){
                unset($this->validate['value']);
                if(isset($this->data[$this->alias]['userinputfield_id'])){
                    $this->Userinputfield->recursive = 0;
                    $validationinfo = $this->Userinputfield->findById($this->data[$this->alias]['userinputfield_id']);
                }else if(isset($this->data[$this->alias]['id'])){

                    $validationinfo = $this->find('first', array(
                        'conditions'=>array(
                            $this->alias.'.id'=>$this->data[$this->alias]['id']
                        ),
                        'contain'=>array(
                            $this->Userinputfield->alias.'.'.$this->Userinputfield->Inputtype->alias
                        )
                    ));
                    $validationinfo[$this->Userinputfield->Inputtype->alias] = $validationinfo[$this->Userinputfield->alias][$this->Userinputfield->Inputtype->alias];
                }

                if($validationinfo[$this->Userinputfield->alias]['required']){
                    $allowEmpty = false;
                }else{
                    $allowEmpty = true;
                }

                switch($validationinfo[$this->Userinputfield->Inputtype->alias]['type']){

                    case "text":
                        if(!$allowEmpty){
                            $this->validate['value']['notempty'] = array(
                                'rule'=>array('notEmpty'),
                                'message' => 'Cannot be empty',
                            );
                        }
                        break;
                    case "number":
                        $this->validate['value']['numeric'] = array(
                            'rule' => array('numeric'),
                            'message' => 'must be numeric',
                            'allowEmpty'=>$allowEmpty
                        );
                        break;
                    case "email":
                        $this->validate['value']['email'] = array(
                            'rule' => array('email'),
                            'message' => 'Wrong format',
                            'allowEmpty'=>$allowEmpty
                        );
                        break;
                    case "boolean":
                        $this->validate['value']['boolean'] = array(
                            'rule' => array('boolean'),
                            'message' => 'Incorrect value',
                            'allowEmpty'=>$allowEmpty
                        );
                        break;
                    case "date":
                        $this->validate['value']['date'] = array(
                            'rule' => array('date'),
                            'message' => 'Enter a valid date',
                            'allowEmpty'=>$allowEmpty
                        );
                        break;
                    case "selectionlist":
                        $this->validate['value']['selectionlist'] = array(
                            'rule' => array('numeric'),
                            'message' => 'Incorrect value',
                            'allowEmpty'=>$allowEmpty
                        );
                        break;
                }
            }
        }


    }

}
