    <?php
App::uses('AppModel', 'Model');

class Financialbudget extends AppModel {

    public $belongsTo = array(
        'User'=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public $hasMany = array(
        'Financialbudgetdetail' => array(
            'className' => 'Financialbudgetdetail',
            'foreignKey' => 'financialbudget_id',
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
        'Financialbudgetincome' => array(
            'className' => 'Financialbudgetdetail',
            'foreignKey' => 'financialbudget_id',
            'dependent' => true,
            'conditions' => array('type' => 'income'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Financialbudgetexpense' => array(
            'className' => 'Financialbudgetdetail',
            'foreignKey' => 'financialbudget_id',
            'dependent' => true,
            'conditions' => array('type' => 'expense'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Prepayment' => array(
            'className' => 'Prepayment',
            'foreignKey' => 'financialbudget_id',
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


    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(

        'total_expense' => array(
            'Numeric' => array(
                'rule' => 'numeric',
                'message' => 'Only numeric value is allowed',
                'allowEmpty' => false,
            ),
        ),
        'total_income' => array(
            'Numeric' => array(
                'rule' => 'numeric',
                'message' => 'Only numeric value is allowed',
                'allowEmpty' => false,
            ),
        ),
        'model_id' => array(
            'rule' => array('notBlank'),
            'message' => 'This field cannot be empty',
        ),
        'user_id' => array(
            'rule' => array('notBlank'),
            'message' => 'This field cannot be empty',
        ),
        'editable' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),

    );

}
