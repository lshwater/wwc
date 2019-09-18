<?php
App::uses('AppModel', 'Model');

class Casecloseform extends AppModel {

    public $form_name = "結束/轉移個案";

    public $belongsTo = array(
        'Casemanagementform'=> array(
            'className' => 'Casemanagementform',
            'foreignKey' => 'casemanagementform_id',
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
        'Caseclosereason'=> array(
            'className' => 'Caseclosereason',
            'foreignKey' => 'caseclosereason_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

//    public $actsAs = array('Search.Searchable', 'Linkable.Linkable');
//
//    public $filterArgs = array(
//        'filter' => array('type' => 'query', 'method' => 'orConditions'),
//    );
//
//
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

    public function afterSave($created, $options = array()) {

        if (!$created && isset($this->data['Casereferralform']['casemanagementform_id']) && isset($this->data['Casereferralform']['date'])) {
            $this->Casemanagementform->id = $this->data['Casereferralform']['casemanagementform_id'];
            $this->Casemanagementform->savefield('form_date', $this->data['Casereferralform']['date']);
        }
    }

}
