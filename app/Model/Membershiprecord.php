<?php
App::uses('AppModel', 'Model');

class Membershiprecord extends AppModel {

    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
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
        ),
        'Membertype' => array(
            'className' => 'Membertype',
            'foreignKey' => 'membertype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Membership' => array(
            'className' => 'Membership',
            'foreignKey' => 'membership_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Membershiprecordtype' => array(
            'className' => 'Membershiprecordtype',
            'foreignKey' => 'membershiprecordtype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),


    );


//    public function afterFind($results, $primary = false)
//    {
//        foreach ($results as $key => $val) {
//            if (isset($val[$this->alias]['enddate'])) {
//                if (strtotime($val[$this->alias]['enddate']) < strtotime(date("Y-m-d"))) {
//                    $results[$key][$this->alias]['expired'] = true;
//                } else {
//                    $results[$key][$this->alias]['expired'] = false;
//                }
//            }
//
//        }
//
//
//        return $results;
//    }

}
