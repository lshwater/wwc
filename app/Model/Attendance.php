<?php
App::uses('AppModel', 'Model');
/**
 * Questionnaire Model
 */
class Attendance extends AppModel
{

    public $in_out = array(
        1=>'入',
        2=>'出'
    );

    public $belongsTo = array(
        'Stock' => array(
            'className' => 'Stock',
            'foreignKey' => 'stock_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
//
//    public function beforeFind($queryData){
//
//        $queryData['conditions'][$this->alias.'.type'] = $this->alias;
//        return $queryData;
//    }
//
//    public function beforeSave($options = array()) {
//
//        $this->data[$this->alias]['type'] = $this->alias;
//
//        if($this->data[$this->alias]['member_id'] && $this->data[$this->alias]['name'] && $this->data[$this->alias]['value'] && $this->data[$this->alias]['date']){
//
//            $check = $this->find('all', array(
//                'conditions'=>array(
//                    $this->alias.'.type'=>$this->data[$this->alias]['type'],
//                    $this->alias.'.name'=>$this->data[$this->alias]['name'],
//                    $this->alias.'.value'=>$this->data[$this->alias]['value'],
//                    $this->alias.'.date'=>$this->data[$this->alias]['date'],
//                    $this->alias.'.member_id'=>$this->data[$this->alias]['member_id']
//                )
//            ));
//
//            if(!empty($check)){
//                return false;
//            }
//        }
//
//        return true;
//    }


}
