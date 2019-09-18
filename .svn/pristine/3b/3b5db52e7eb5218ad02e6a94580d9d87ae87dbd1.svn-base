<?php
App::uses('AppModel', 'Model');
/**
 * Inputtype Model
 *
 * @property Userinputfield $Userinputfield
 */
class Identitytype extends AppModel {

    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
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
        ),
    );
}
