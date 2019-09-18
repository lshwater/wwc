<?php
App::uses('AppModel', 'Model');

class Servicerecord extends AppModel {

    public $interview_type = array(
        "會面"=>"會面",
        "電話"=>"電話"
    );

    public $form_name = "會面記錄";


    public $belongsTo = array(
        'Casemanagementform'=> array(
            'className' => 'Casemanagementform',
            'foreignKey' => 'casemanagementform_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Servicerecord'=> array(
            'className' => 'User',
            'foreignKey' => 'service_provider_id',
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
        'Servicerecordtype'=> array(
            'className' => 'Servicerecordtype',
            'foreignKey' => 'servicerecordtype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

//    public $actsAs = array('Search.Searchable', 'Linkable.Linkable');
//
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

    public function afterSave($created, $options = array()) {

        if (!$created && isset($this->data['Servicerecord']['casemanagementform_id']) && isset($this->data['Servicerecord']['date'])) {
            $this->Casemanagementform->id = $this->data['Servicerecord']['casemanagementform_id'];
            $this->Casemanagementform->savefield('form_date', $this->data['Servicerecord']['date']);
        }
    }
}
