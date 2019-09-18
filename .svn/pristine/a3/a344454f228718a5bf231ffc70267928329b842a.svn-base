<?php
App::uses('AppModel', 'Model');


class Actionlog extends AppModel {

    var $action2log = array(
        'delete',
        'edit',
        'add',
        'new'
    );
    var $REQUEST_METHOD = array(
        "POST",
        "PUT"
    );
    var $action2escape = array(
        'ajax_getunreadnotices',
        'ajax_getunmsgs'
    );

    public $validate = array(
        'REQUEST_METHOD'=> array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
        'user_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
        'controller' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
        'action' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
        'link' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
        'IP' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
        ),
    );

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function addlog($request){
        if(in_array($request['action'], $this->action2escape)){
            return;
        }

        if(
            in_array($request['action'], $this->action2log) ||
            in_array($_SERVER['REQUEST_METHOD'], $this->REQUEST_METHOD)
        ){
//        Configure::write('debug', 2);

            $this->create();
            $this->save(
                array(
                    "controller"=>$request['controller'],
                    "action"=>$request['action'],
                    "link"=>Router::url( $this->here, true ),
                    "user_id"=>CakeSession::read('Auth.User.id'),
                    "IP"=>$_SERVER['REMOTE_ADDR'],
                    "REQUEST_METHOD"=>$_SERVER['REQUEST_METHOD']
                )
            );
        }
    }

}
