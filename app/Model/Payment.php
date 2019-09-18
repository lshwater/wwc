<?php
App::uses('AppModel', 'Model');

class Payment extends AppModel {

    public $belongsTo = array(
        'Paymentmethod'=> array(
            'className' => 'Paymentmethod',
            'foreignKey' => 'paymentmethod_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Membership'=> array(
            'className' => 'Membership',
            'foreignKey' => 'membership_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Unit'=> array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User'=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'Paymentrecord' => array(
            'className' => 'Paymentrecord',
            'foreignKey' => 'payment_id',
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

}
