<?php
App::uses('AppModel', 'Model');

class Announcement extends AppModel {

    public $validate = array(
        'needconfirm' => array(
            'myCheckbox' => array(
                'rule'    => array('boolean'),
                'message' => 'Incorrect value'
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

    public $belongsTo = array(
        'Fromuser' => array(
            'className' => 'User',
            'foreignKey' => 'from_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'AnnouncementUser' => array(
            'className' => 'AnnouncementUser',
            'foreignKey' => 'announcement_id',
            'dependent' => true,
            'conditions' => "",
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

    public $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'Group',
            'joinTable' => 'announcement_groups',
            'foreignKey' => 'announcement_id',
            'associationForeignKey' => 'group_id',
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
        if (!empty($this->data[$this->alias]['content'])) {
            $this->data[$this->alias]['content'] = $purifier->purify($this->data[$this->alias]['content']);
        }
        if (!empty($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['title'] = $purifier->purify($this->data[$this->alias]['title']);
        }

        return true;
    }
}
