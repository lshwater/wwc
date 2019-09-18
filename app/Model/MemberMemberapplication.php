<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class MemberMemberapplication extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Memberapplication' => array(
            'className' => 'Memberapplication',
            'foreignKey' => 'memberapplication_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


}
