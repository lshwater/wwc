<?php
App::uses('AppModel', 'Model');
/**
 * MembersMemberinputfield Model
 *
 * @property Member $Member
 * @property Memberinputfield $Memberinputfield
 */
class MembersMemberinputfield extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'member_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'memberinputfield_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Memberinputfield' => array(
			'className' => 'Memberinputfield',
			'foreignKey' => 'memberinputfield_id',
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
                if(isset($this->data[$this->alias]['memberinputfield_id'])){
                    $this->Memberinputfield->recursive = 0;
                    $validationinfo = $this->Memberinputfield->findById($this->data[$this->alias]['memberinputfield_id']);
                }else if(isset($this->data[$this->alias]['id'])){

                    $validationinfo = $this->find('first', array(
                        'conditions'=>array(
                            $this->alias.'.id'=>$this->data[$this->alias]['id']
                        ),
                        'contain'=>array(
                            $this->Memberinputfield->alias.'.'.$this->Memberinputfield->Inputtype->alias
                        )
                    ));
                    $validationinfo[$this->Memberinputfield->Inputtype->alias] = $validationinfo[$this->Memberinputfield->alias][$this->Memberinputfield->Inputtype->alias];
                }

                if($validationinfo[$this->Memberinputfield->alias]['required']){
                    $allowEmpty = false;
                }else{
                    $allowEmpty = true;
                }

                switch($validationinfo[$this->Memberinputfield->Inputtype->alias]['type']){

                    case "text":
                        if(!$allowEmpty){
                            $this->validate['value']['notempty'] = array(
                                'rule'=>array('notEmpty'),
                                'message' => 'Cannot be empty',
                            );
                        }
                        break;
                    case "textarea":
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

    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias])) {
            foreach($this->data[$this->alias] as $val){
                if(isset($this->data[$this->alias]['memberinputfield_id'])){
                    //For HKID
//                    if($this->data[$this->alias]['memberinputfield_id'] == '5'){
//                        $this->data[$this->alias]['value'] = trim($this->data[$this->alias]['value']);
//                    }

                   if($this->data[$this->alias]['memberinputfield_id'] == '10'){
                        $this->data[$this->alias]['value'] = substr($this->data[$this->alias]['value'], 0,1)."XXX XXXX";
                   }
                    
                   if($this->data[$this->alias]['memberinputfield_id'] == '11'){
                        $this->data[$this->alias]['value'] = substr($this->data[$this->alias]['value'], 0,1)."XXX XXXX";
                   }
                }
            }
        }
        return true;
    }
    
    
    // for demo
    public function afterFind($results, $primary = false){

		foreach ($results as $key => $val) {

		    // for demo
//		    if ($val['MemberCustomField']['memberinputfield_id'] == '10' && !empty($val['MemberCustomField']['value'])) {
//		        $results[$key]['MemberCustomField']['value'] = "39979924";
//		    }
//		    if ($val['MemberCustomField']['memberinputfield_id'] == '11'  && !empty($val['MemberCustomField']['value'])) {
//		        $results[$key]['MemberCustomField']['value'] = "39979924";
//		    }
//		   	if ($val['MemberCustomField']['memberinputfield_id'] == '8'  && !empty($val['MemberCustomField']['value'])) {
//		        $results[$key]['MemberCustomField']['value'] = "Room 7, Block A, 13/F, Yip Fat Factory Building, Phase 1, 77, Hoi Yuen Road";
//		    }

		}

		return $results;
	}
	
    
}
