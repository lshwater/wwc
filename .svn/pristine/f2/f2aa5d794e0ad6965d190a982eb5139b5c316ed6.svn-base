<?php
App::uses('AppModel', 'Model');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Membertmp extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
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
        'membercard' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Value already exist',
                'allowEmpty' => true,
            ),
        ),
        'json' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

}
