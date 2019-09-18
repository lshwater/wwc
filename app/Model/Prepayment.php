<?php
App::uses('AppModel', 'Model');

class Prepayment extends AppModel {

    public $belongsTo = array(
        'Financialbudget' => array(
            'className' => 'Financialbudget',
            'foreignKey' => 'financialbudget_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
