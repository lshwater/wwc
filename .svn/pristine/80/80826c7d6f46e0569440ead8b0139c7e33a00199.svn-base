<?php
App::uses('AppModel', 'Model');

class MessagesUser extends AppModel {

    public $belongsTo = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'message_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeFind($queryData) {
        $queryData['conditions'][$this->alias.'.user_id'] = CakeSession::read("Auth.User.id");;
        return $queryData;
    }
}
