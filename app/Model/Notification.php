<?php
App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');
/**
 * Notification Model
 *
 * @property User $User
 */
class Notification extends AppModel {
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
			),
		),
	);

    public $hasMany = array(
        'Recipient' => array(
            'className' => 'NotificationUser',
            'foreignKey' => 'notification_id',
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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Fromuser' => array(
			'className' => 'User',
			'foreignKey' => 'from_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);

    public function getunreadnotices($timestamp = null){
        $this->recursive = 0;
        if(!empty($timestamp)){
            $rs =  $this->Recipient->find('all', array(
                    'conditions'=>array(
                        $this->Recipient->alias.'.read'=>0,
                        $this->Recipient->alias.'.user_id'=>CakeSession::read('Auth.User.id'),
                        $this->Recipient->alias.'.created >='=>date("Y-m-d H:i:s", $timestamp),
                    ),
                    "limit"=>5
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
                    "limit"=>5
                )
            );
        }
    }

    public function addnotices($msg = null, $title = null, $user_ids = array(), $param = array()){
        if(empty($msg) || empty($title) || empty($user_ids)){
            return false;
        }

        if(!empty($param['from_name'])){
            $from_name = $param['from_name'];
        }else{
            $from_name = CakeSession::read('Auth.User.name');
        }

        if(!empty($param['from_id'])){
            $from_id = $param['from_id'];
        }else{
            $from_id = CakeSession::read('Auth.User.id');
        }

        $horn_user_id = array();
        $this->begin();
        $this->create();
        if($this->save(
            array(
                "from_name"=>$from_name,
                "from_id"=>$from_id,
                "title"=>$title,
                "msg"=>$msg
            )
        )){

            foreach($user_ids as $user_id){
                $data2save = array(
                    "notification_id"=>$this->id,
                    "user_id"=>$user_id,
                    "read"=>0,
                );
                $this->Recipient->create();
                if(!$this->Recipient->save($data2save)){
                    $this->rollback();
                    return false;
                }
                $tmpuser = $this->Fromuser->findById($user_id);
                if(!empty($tmpuser[$this->Fromuser->alias]['code']) && !empty($tmpuser[$this->Fromuser->alias]['horn_clientid'])){
                    $horn_user_id[] = array(
                        "horn_account"=>$tmpuser[$this->Fromuser->alias]['code'],
                        "horn_clientid"=>$tmpuser[$this->Fromuser->alias]['horn_clientid']
                    );
                }

            }
        }
        $this->commit();

        //testing code
        $HttpSocket = new HttpSocket();

        $url = "http://pushapps.hypoidea.com/Messages/api_addMessage";

        if(!empty($horn_user_id)){

            foreach($horn_user_id as $horn){
                $data = array(
                    "sender_token"=>configure::read("PushApps.token"),
                    "client_id"=>$horn['horn_clientid'],
                    "account"=>$horn['horn_account'],
                    "message_title"=>$title,
                    "message_content"=>$msg
                );
                $results = $HttpSocket->post($url, json_encode($data), array(
                    "header"=>array(
                        "Content-Type"=>"application/x-www-form-urlencoded"
                    )
                ));
            }
        }

        return true;
    }
}
