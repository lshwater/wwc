<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class Procumentrequest extends AppModel {




    public $belongsTo = array(
        'Unit' => array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Requester' => array(
            'className' => 'User',
            'foreignKey' => 'requester_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Stocktype' => array(
            'className' => 'Stocktype',
            'foreignKey' => 'type',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );



    public function beforeFind(array $queryData){

//        if($this->levelofview() == 'unit' && $queryData['recursive'] != -1){
//            $unit_id = CakeSession::read('Auth.unit');
//            $queryData['conditions'][$this->alias.'.unit_id'] = $unit_id;
//        }
        return $queryData;
    }

    /*
     * Search Handler
     */

    public $actsAs = array('Search.Searchable');

//    public function afterSave($created, $options = array()) {
//        if ($created && isset($this->data['Member'])) {
//            $code = "M".str_pad($this->data['Member']['id'], 4, "0", STR_PAD_LEFT);
//            $this->id = $this->data['Member']['id'];
//            $this->saveField('code',$code);
//        }
//    }


    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions'),
    );

    public function orConditions($data = array()) {
//        $filter = trim($data['filter']);
//        $cond = array(
//            'OR' => array(
//                $this->alias . '.code LIKE' => '%' . $filter . '%',
//                $this->alias . '.username LIKE' => '%' . $filter . '%',
//            ));
//        return $cond;
    }

}
