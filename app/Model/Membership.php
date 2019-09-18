<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Membership extends AppModel {

    public $validate = array(

        'code' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'message' => '已經存在'
            ),
        ),
    );

    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
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
        )
    );


    public function afterFind($results, $primary = false)
    {
        foreach ($results as $key => $val) {
            if (isset($val[$this->alias]['enddate'])) {
                if (strtotime($val[$this->alias]['enddate']) < strtotime(date("Y-m-d"))) {
                    $results[$key][$this->alias]['expired'] = true;
                } else {
                    $results[$key][$this->alias]['expired'] = false;
                }
            }

        }


        return $results;
    }

}
