<?php
App::uses('Attachment', 'Model');

class Document extends Model {
    public $useTable = "attachments";

    public $belongsTo = array(
        'User'=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public function beforeFind($queryData) {

        $queryData['conditions'][$this->alias.'.model'] = "Document";
        return $queryData;
    }
}
