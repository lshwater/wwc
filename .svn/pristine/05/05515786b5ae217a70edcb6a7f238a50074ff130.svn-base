<?php
App::uses('AppModel', 'Model');
/**
 * Agency Model
 *
 * @property Unit $Unit
 */
class Customtype extends AppModel {
	public $recursive = -1;
//	public $useDbConfig = 'mysql';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */

    public $belongsTo = array(
        'Dbmodel' => array(
            'className' => 'Dbmodel',
            'foreignKey' => 'model_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

	public $hasMany = array(
        'Customlayout' => array(
            'className' => 'Customlayout',
            'foreignKey' => 'type_id',
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
        'Customgroup' => array(
            'className' => 'Customgroup',
            'foreignKey' => 'type_id',
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


	);





	public function copy_model($from_model_id, $to_model_id){
		$from_model = $this->get_struct($from_model_id);
		if(!$this->exists($to_model_id)){
			return false;
		}
		$success = false;
		$this->begin();
		if(!empty($from_model)){
			foreach($from_model as $field){
				if($field['type'] == $this->Customfield->type_select){
					$success = $this->Customfield->create_struct($to_model_id, $field['name'], $field['type'], $field['required'], $field['label'], $field['default'], $field['attribute'], $field['placeholder']);
					if($success){
						if(!empty($field['options'])){
							$main_id =  $this->Customfield->getLastInsertID();
							foreach($field['options'] as $k=>$option){
								$success = $this->Customfield->create_struct($to_model_id, $k, $this->Customfield->type_select_item,0, $option, null, null, null, $main_id);
								if(!$success){
									break;
								}
							}
						}
					}else{
						break;
					}
				} else if($field['type'] == $this->Customfield->type_array){
					$success = $this->Customfield->create_struct($to_model_id, $field['name'], $field['type'], $field['required'], $field['label'], $field['default'], $field['attribute'], $field['placeholder']);
					if($success){
						$parent = $this->Customfield->read(null, $this->Customfield->getLastInsertID());
						foreach($field['child'] as $child){
							if(!$child['hidden']){
								$success = $this->Customfield->create_struct($to_model_id, $child['name'], $child['type'],$child['required'], $child['label'], $child['default'], $field['attribute'], $child['placeholder'], $parent['Customfield']['main_struct_id']);
								if(!$success){
									break;
								}
							}
						}

					}else{
						break;
					}

				}else{
					$success = $this->Customfield->create_struct($to_model_id, $field['name'], $field['type'], $field['required'], $field['label'], $field['default'], $field['attribute'], $field['placeholder']);
					if(!$success){
						break;
					}
				}
			}
		}

		if($success){
			$this->commit();
			return true;
		}else{
			return false;
		}

	}


}
