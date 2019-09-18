<?php
App::uses('AppModel', 'Model');

class Financialbudgetdetail extends AppModel {

    public $belongsTo = array(
        'Financialbudget'=> array(
            'className' => 'Financialbudget',
            'foreignKey' => 'financialbudget_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

        'Financialitem'=> array(
            'className' => 'Financialitem',
            'foreignKey' => 'financialitem_id',
        )
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(

        'quantity' => array(
            'naturalNumber' => array(
                'rule' => 'naturalNumber',
                'message' => 'Please enter a valid number',
                'allowEmpty' => false,
            ),
        ),
        'unit_cost' => array(
            'Numeric' => array(
                'rule' => 'numeric',
                'message' => 'Only numeric value is allowed',
                'allowEmpty' => false,
            ),
        ),
        'financialbudget_id' => array(
            'rule' => array('notBlank'),
            'message' => 'This field cannot be empty',
        ),
        'financialitem_id' => array(
            'rule' => array('notBlank'),
            'message' => 'This field cannot be empty',
        ),
        'type' => array(
            'rule' => 'alphaNumeric',
            'message' => 'Enter a valid type',
            'allowEmpty' => false
        ),

    );

}
