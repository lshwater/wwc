<?
App::uses('Model', 'User');

class Countuser extends User {
    public $useTable = 'users';

    public $hasAndBelongsToMany = array(
        'Unit' => array(
            'className' => 'Unit',
            'joinTable' => 'users_units',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'unit_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );
}



?>