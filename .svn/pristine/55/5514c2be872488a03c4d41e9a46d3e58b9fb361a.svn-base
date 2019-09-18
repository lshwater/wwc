<?php
App::uses('AppModel', 'Model');

class Message extends AppModel {
    var $virtualFields = array(
        'msg_less' => 'SUBSTRING(msg,1,150)'
    );
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
        'msg' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        "title"=>array(
            "maxLength"=>array(
                'rule' => array('maxLength', 1024),
                'message' => 'It must be no larger than 1024 characters long.'
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'It cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        )
    );

    public $hasMany = array(
        'Recipient' => array(
            'className' => 'MessagesUser',
            'foreignKey' => 'message_id',
            'dependent' => true,
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

//    /**
//     * belongsTo associations
//     *
//     * @var array
//     */
    public $belongsTo = array(
        'Fromuser' => array(
            'className' => 'User',
            'foreignKey' => 'from_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeSave($options = array()) {

        App::import('Vendor', 'HTMLPurifier', array('file' => 'htmlpurifier/library/HTMLPurifier.auto.php'));
        $config = HTMLPurifier_Config::createDefault();
        $config->set('URI.AllowedSchemes', array('data'));
        $purifier = new HTMLPurifier($config);
        if (!empty($this->data[$this->alias]['msg'])) {
            $this->data[$this->alias]['msg'] = $purifier->purify($this->data[$this->alias]['msg']);
        }
        if (!empty($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['title'] = $purifier->purify($this->data[$this->alias]['title']);
        }

        return true;
    }

    public function getunreadmsgs($timestamp = null){
        $this->recursive = 0;
        if(!empty($timestamp)){
            $rs =  $this->Recipient->find('all', array(
                    'conditions'=>array(
                        $this->Recipient->alias.'.read'=>0,
                        $this->Recipient->alias.'.user_id'=>CakeSession::read('Auth.User.id'),
                        $this->Recipient->alias.'.created >='=>date("Y-m-d H:i:s", $timestamp),
                    ),
                    "limit"=>5,
                    'order' => array($this->Recipient->alias.'.created DESC'),
                )
            );
            if(empty($rs)){
                return false;
            }else{
                return $rs;
            }
        }
        else{
            return $this->Recipient->find('all', array(
                    'conditions'=>array(
                        $this->Recipient->alias.'.read'=>0,
                        $this->Recipient->alias.'.user_id'=>CakeSession::read('Auth.User.id')
                    ),
                    "limit"=>5,
                    'order' => array($this->Recipient->alias.'.created DESC'),
                )
            );
        }
    }

    public function checkhasright($msg_id = null){
//        Configure::write('debug', 2);
        $checkown = $this->find("count", array(
            'conditions' => array(
                $this->alias.'.from_id' => CakeSession::read('Auth.User.id')
            )
        ));

        $check = $this->Recipient->find("count", array(
            'conditions' => array(
                "AND"=>array(
                    $this->Recipient->alias.'.message_id' => $msg_id,
                    $this->Recipient->alias.'.user_id' => CakeSession::read('Auth.User.id'),
                    $this->Recipient->alias.'.active' => 1
                )
            )
        ));

        if($check > 0 || $checkown >0){
            return true;
        }else{
            return false;
        }
    }
}
