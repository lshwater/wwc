<?php
App::uses('AppModel', 'Model');

class AnnouncementUser extends AppModel {

    public $belongsTo = array(
        'Announcement' => array(
            'className' => 'Announcement',
            'foreignKey' => 'announcement_id',
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
