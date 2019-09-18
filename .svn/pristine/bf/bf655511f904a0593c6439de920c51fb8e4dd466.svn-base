<?php
App::uses('AppModel', 'Model');


class Memberapplication extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'payment_code' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'price' => array(
            'Numeric' => array(
                'rule' => 'numeric',
                'message' => 'Only numeric value is allowed',
                'allowEmpty' => false,
            ),
        ),
        'period' => array(
            'Numeric' => array(
                'rule' => 'naturalNumber',
                'message' => 'Please enter a valid number',
                'allowEmpty' => false,
            ),
        ),
        'startdate' => array(
            'rule' => array('date'),
            'message' => 'Please enter a valid date.',
            'allowEmpty'=> false
        ),
        'enddate' => array(
            'rule' => array('date'),
            'message' => 'Please enter a valid date.',
            'allowEmpty'=> false
        ),
        'active' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'valid' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'unit_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'membertype_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        "period" => array(
            'numeric' => array(
                'rule' => array('naturalNumber'),
            ),
        ),
        "period_d" => array(
            'numeric' => array(
                'rule' => array('naturalNumber'),
            ),
        ),
    );

    public $belongsTo = array(
        'Unit' => array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Membertype' => array(
            'className' => 'Membertype',
            'foreignKey' => 'membertype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Mainmember' => array(
            'className' => 'Member',
            'foreignKey' => 'mainmember_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Memberapplicationtype"=> array(
            'className' => 'Memberapplicationtype',
            'foreignKey' => 'memberapplicationtype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "User"=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasAndBelongsToMany = array(
        'Member' => array(
            'className' => 'Member',
            'joinTable' => 'members_memberapplications',
            'foreignKey' => 'memberapplication_id',
            'associationForeignKey' => 'member_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );


    public function beforeSave($options = array()) {

        App::import('Vendor', 'HTMLPurifier', array('file' => 'htmlpurifier/library/HTMLPurifier.auto.php'));
        $config = HTMLPurifier_Config::createDefault();
        $config->set('URI.AllowedSchemes', array('data'));
        $purifier = new HTMLPurifier($config);
        if (!empty($this->data[$this->alias]['remarks'])) {
            $this->data[$this->alias]['remarks'] = $purifier->purify($this->data[$this->alias]['remarks']);
        }

        return true;
    }

    public function beforeFind($query = array()){
        if(!parent::beforeFind($query))
        {
            return false;
        }

        $this->virtualFields = array_merge($this->virtualFields, array
        (
            'active' => "IF({$this->alias}.enddate < CURDATE(), 0, 1)"
        ));

        return true;
    }

    public function stat_newmember($start_date = null, $end_date = null, $unit_id = null) {
        $conditions = array();

        $conditions['AND'][$this->alias . ".valid"] = 1;

        if(empty($start_date) || empty($end_date)){
            return false;
        }

        if(!empty($unit_id)){
            $conditions['AND'][$this->alias . ".unit_id"] = $unit_id;
        }
        if(!empty($start_date)){
            $conditions['AND'][$this->alias . ".paymentdate >="] = $start_date;
        }
        if(!empty($end_date)){
            $conditions['AND'][$this->alias . ".paymentdate <="] = $end_date;
        }
        $this->Behaviors->load('Containable');
        $rs = $this->find("all", array(
            "conditions"=>$conditions,
            "contain"=>array(
                "Member"
            )
        ));
        return $rs;
    }
}
