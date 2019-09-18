<?php
App::uses('AppModel', 'Model');

class Paymentitemcategory extends AppModel {

    public $hasMany = array(
        'Paymentitem' => array(
            'className' => 'Paymentitem',
            'foreignKey' => 'paymentitemcategory_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
