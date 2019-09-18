<?php
App::uses('AppModel', 'Model');

class Cutoffdate extends AppModel {
    public $validate = array(
        'name' => array(
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
                'message' => '日子已經存在',
            )
        ),
        'activedate' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            ),
            'comparison2' => array('rule'=>array('field_comparison', '>=', 'name'), 'message' => '必須在最後更改日期後'),
        )
    );

    public function canchange($date = null, &$msg, $rolecheck = true){
        if(Configure::read("modulus.Cutoffdate")){
            if(!$date){
                $date = date("Y-m-d");
            }
            $cutoffdate = $this->getlastdate();
            if(strtotime($cutoffdate['Cutoffdate']['name']) <= strtotime($date)){
                return true;
            }else{
                $msg = "注意： 可更改日期已過，可能會影響之前的報告結果。";
                if($rolecheck){
                    if(CakeSession::read('Auth.superadmin')){
                        return true;
                    }
                }
                return false;
            }
        }else{
            return true;
        }
    }

    public function getlastdate(){
        $rs = $this->find("first", array(
           "conditions"=>array(
               "activedate <="=>date("Y-m-d")
           ),
            "order"=>array(
                "activedate DESC"
            ),
        ));
        return $rs;
    }
}
