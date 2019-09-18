<?php
App::uses('AppModel', 'Model');

class Casemanagementform extends AppModel {

    public $belongsTo = array(
        'Casemanagement'=> array(
            'className' => 'Casemanagement',
            'foreignKey' => 'casemanagement_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
//        'Servicerecord'=> array(
//            'className' => 'Servicerecord',
//            'foreignKey' => 'form_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),
//        'Casereferralform'=> array(
//            'className' => 'Casereferralform',
//            'foreignKey' => 'form_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),

    );

    public $hasMany = array(
        'Servicerecord' => array(
            'className' => 'Servicerecord',
            'foreignKey' => 'casemanagementform_id',
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
        'Casereferralform' => array(
            'className' => 'Casereferralform',
            'foreignKey' => 'casemanagementform_id',
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
        'Caseenquiryform' => array(
            'className' => 'Caseenquiryform',
            'foreignKey' => 'casemanagementform_id',
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
        'Caseassessment' => array(
            'className' => 'Caseassessment',
            'foreignKey' => 'casemanagementform_id',
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
        'Casereassessment' => array(
            'className' => 'Casereassessment',
            'foreignKey' => 'casemanagementform_id',
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
        'Casecloseform' => array(
            'className' => 'Casecloseform',
            'foreignKey' => 'casemanagementform_id',
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

    public $actsAs = array('Search.Searchable', 'Linkable.Linkable');

//    public $filterArgs = array(
//        'filter' => array('type' => 'query', 'method' => 'orConditions'),
//    );


//    public function orConditions($data = array()) {
//        $display = trim($data['filter']);
//        if($display == 1){
//            $cond = array(
//                'closed '=>0
//            );
//        }else if($display == 2){
//            $cond = array(
//                'closed '=>1
//            );
//        }else{
//
//        }
//
//        return $cond;
//    }
}
