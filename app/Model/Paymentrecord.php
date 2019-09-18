<?php
App::uses('AppModel', 'Model');

class Paymentrecord extends AppModel {

    public $belongsTo = array(
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'payment_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
