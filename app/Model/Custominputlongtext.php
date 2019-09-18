<?php
App::uses('AppModel', 'Model');
/**
 * Agency Model
 *
 * @property Unit $Unit
 */
class Custominputlongtext extends AppModel {

    public $recursive = -1;
//    public $useDbConfig = 'mysql';

    public $belongsTo = array(
        'Dbmodel' => array(
            'className' => 'Dbmodel',
            'foreignKey' => 'model_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Customtype"=> array(
            'className' => 'Customtype',
            'foreignKey' => 'type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Customfield"=> array(
            'className' => 'Customfield',
            'foreignKey' => 'field_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {

            if (isset($val[$this->alias]['value'])) {
                $results[$key][$this->alias]['value_text'] = $val[$this->alias]['value'];
            }

        }

        return $results;
    }

    public function beforeFind($queryData) {


        $queryData['conditions']['value LIKE'] = "%".$queryData['conditions']['value']."%";
        unset($queryData['conditions']['value']);


        return $queryData;
    }


}
