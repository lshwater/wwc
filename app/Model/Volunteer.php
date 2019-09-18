<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Volunteer extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'code' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
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
        'member_id' => array(
            'unique' => array(
                'rule' => 'isUnique',
//                'required' => 'create',
                'message' => 'Value already exist',
                'allowEmpty' => true,
            ),
        ),
        'e_name' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'This field cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'identity' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'required' => false,
                'message' => '已經存在'
            ),
        ),
        'identityhash'=>array(
            'unique' => array(
                'rule' => 'isUnique',
                'required' => false,
                'message' => '已經存在'
            ),
        ),
	);

    public $belongsTo = array(
        'Gender' => array(
            'className' => 'Selectionitem',
            'foreignKey' => 'gender',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Employmentstatus' => array(
            'className' => 'Selectionitem',
            'foreignKey' => 'employmentstatus_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Educationlevel' => array(
            'className' => 'Selectionitem',
            'foreignKey' => 'education_level',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Volunteerunit" => array(
            'className' => 'Volunteerunit',
            'foreignKey' => 'volunteerunit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Member" => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Identitytype' => array(
            'className' => 'Identitytype',
            'foreignKey' => 'identitytype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
//        'Activity' => array(
//            'className' => 'Activity',
//            'dependent' => true
//        ),
        'ActivitiesVolunteer' => array(
            'className' => 'ActivitiesVolunteer',
            'foreignKey' => 'volunteer_id',
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

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
        'Eventproposaltarget' => array(
            'className' => 'Eventproposaltarget',
            'joinTable' => 'volunteers_eventproposaltargets',
            'foreignKey' => 'volunteer_id',
            'associationForeignKey' => 'eventproposaltarget_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Volunteertype' => array(
            'className' => 'Volunteertype',
            'joinTable' => 'volunteers_volunteertypes',
            'foreignKey' => 'volunteer_id',
            'associationForeignKey' => 'volunteertype_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Volunteertag' => array(
            'className' => 'Volunteertag',
            'joinTable' => 'volunteers_volunteertags',
            'foreignKey' => 'volunteer_id',
            'associationForeignKey' => 'volunteertag_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Availability' => array(
            'className' => 'Availability',
            'joinTable' => 'volunteers_availabilities',
            'foreignKey' => 'volunteer_id',
            'associationForeignKey' => 'availability_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
	);


    /*
     * Search Handler
     */

    public $actsAs = array('Search.Searchable');

    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions'),
    );

    public function orConditions($data = array()) {

    }

    public function beforeValidate($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        if (!empty($this->data[$this->alias]['identity'])) {
            $this->data[$this->alias]['identity'] = strtoupper(trim($this->data[$this->alias]['identity']));
            $this->data[$this->alias]['identityhash'] = $this->datahash($this->data[$this->alias]['identity']);
            $this->data[$this->alias]['identity'] = $this->encryptdata($this->data[$this->alias]['identity']);
        }
    }

    public function beforeSave($options = array()) {

        if(!empty($this->data['Availability'])){
            $this->data['Availability'] = $this->bf_save_reformat($this->data['Availability'],'Availability');
        }
        if(!empty($this->data[$this->alias]['e_name'])){
            $this->data[$this->alias]['e_name'] = trim($this->data[$this->alias]['e_name']);
            $this->data[$this->alias]['e_name'] = strtoupper($this->data[$this->alias]['e_name']);
        }
        return true;

    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {
            if(!empty($results[$key]['Availability'])){
                $results[$key]['Availability'] = $this->af_read_reformat($results[$key]['Availability']);
            }
        }

        array_walk_recursive($results, array($this,'replace_identity'));

        return $results;
    }

    public function replace_identity(&$item2, $key){

        if($key == "identity"){
            $item2 = $this->decryptdata($item2);
            $item2 = "XXXXXXXX";
        }

    }


    public function bf_save_reformat($in, $name){

        $out = null;
        $i = 0;
        foreach($in as $key => $item){
            $out[$name][$i] = $key;
            $i++;
        };

        if($in == null){
            $out[$name] = '';
        }

        return $out;
    }

    public function af_read_reformat($in){
        $out = null;
        foreach ($in as $key => $item){
            $out[$item['id']] = '1';
        };
        return $out;
    }

    //create new volunteer
    public function applyvolunteer($volunteer=null){
        $conditions = array(
            $this->alias.'.member_id' => $volunteer[$this->alias]['member_id']
        );
        if ($this->hasAny($conditions)){
            return true;
        }

        $this->begin();
        $this->create();
        $volunteer[$this->alias]['code'] = uniqid();
        if($this->saveAssociated($volunteer, array("deep"=>true))){
            $code = configure::read("Volunteer.code_prefix").str_pad($this->id, 6, 0, STR_PAD_LEFT).configure::read("Volunteer.code_suffix");
            if(!$this->saveField('code',$code)){
                $this->rollback();
                return false;
            }
            $this->commit();
            return true;
        }else{
            $this->rollback();
            return false;
        }
    }


}
