<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Stock extends AppModel {

    var $virtualFields = array(
        'long_name' => "CONCAT(Stock.fix_asset_no, ' - ', Stock.name)"
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

    public $belongsTo = array(
        'Unit' => array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Holder' => array(
            'className' => 'User',
            'foreignKey' => 'holder_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Voucher' => array(
            'className' => 'Voucher',
            'foreignKey' => 'voucher_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Stocktype' => array(
            'className' => 'Stocktype',
            'foreignKey' => 'type',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'Attendance' => array(
            'className' => 'Attendance',
            'foreignKey' => 'stock_id',
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
	);

    public function getlocationjson($unis = null){
        $conditions = array();
        if($unis){
            $conditions = array(
                'unit_id'=> $units
            );
        }
        $medicine = $this->find("all", array(
            'conditions'=>$conditions,
            "fields"=>array(
                "DISTINCT location_detail"
            ),
            'recursive'=>-1
        ));

        $_json = array();
        foreach($medicine as $v){
            if(!empty($v['Stock']['location_detail'])){
                $_json[] = array(
                    "id"=>$v['Stock']['location_detail'],
                    "name"=>$v['Stock']['location_detail']
                );
            }
        }
        return $_json;
    }
    public function beforeValidate($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        if(configure::read('member_username') == "email"){
            $this->validate['username']['email'] = array(
                'rule' => array('email'),
                'message' => 'Email - Wrong format'
            );
        }else{
            $this->validate['username']['alphaNumeric'] = array(
                'rule' => array('alphaNumeric'),
                'message' => 'Input value is not accepted'
            );
        }
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType'=>'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        if (isset($this->data[$this->alias]['e_name'])) {
            $this->data[$this->alias]['e_name'] = strtoupper($this->data[$this->alias]['e_name']);
        }

        return true;
    }

    public function generatepassword($length = 8){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    public function beforeFind(array $queryData){

//        if($this->levelofview() == 'unit' && $queryData['recursive'] != -1){
//            $unit_id = CakeSession::read('Auth.unit');
//            $queryData['conditions'][$this->alias.'.unit_id'] = $unit_id;
//        }
        return $queryData;
    }

    /*
     * Search Handler
     */

    public $actsAs = array('Search.Searchable');

//    public function afterSave($created, $options = array()) {
//        if ($created && isset($this->data['Member'])) {
//            $code = "M".str_pad($this->data['Member']['id'], 4, "0", STR_PAD_LEFT);
//            $this->id = $this->data['Member']['id'];
//            $this->saveField('code',$code);
//        }
//    }


    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions'),
    );

    public function orConditions($data = array()) {
//        $filter = trim($data['filter']);
//        $cond = array(
//            'OR' => array(
//                $this->alias . '.code LIKE' => '%' . $filter . '%',
//                $this->alias . '.username LIKE' => '%' . $filter . '%',
//            ));
//        return $cond;
    }

}
