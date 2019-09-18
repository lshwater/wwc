<?php
App::uses('AppModel', 'Model');

class Paymentitem extends AppModel {

    public $validate = array(
        'code' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Value already exist',
            ),
            'pattern'=>array(
                'rule'      => '/^[a-zA-Z0-9\w?!\.;:,@#$%^&*\/\[\]\(\)=\+-]*$/',
                'message'   => 'Only alphenumeric allowed',
            ),
        ),
    );

    public $belongsTo = array(
        'Paymentitemcategory' => array(
            'className' => 'Paymentitemcategory',
            'foreignKey' => 'paymentitemcategory_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
