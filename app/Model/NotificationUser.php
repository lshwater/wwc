<?php
App::uses('AppModel', 'Model');

class NotificationUser extends AppModel {

    public $belongsTo = array(
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'notification_id',
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
