<?php
App::uses('AppModel', 'Model');
/**
 * Agency Model
 *
 * @property Unit $Unit
 */
class Custominputdatetime extends AppModel {

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

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['value'])) {

            $this->Behaviors->load('Containable');
            $struct = $this->Customfield->find('first',array(
                'conditions'=>array(
                    'Customfield.id'=>$this->data[$this->alias]['field_id']
                )
            ));

            if($struct['Customfield']['type'] == 'date'){
                $this->data[$this->alias]['date'] = $this->data[$this->alias]['value'];
            }

            if($struct['Customfield']['type'] == 'time'){
                $this->data[$this->alias]['time'] = $this->data[$this->alias]['value'];
            }

            if($struct['Customfield']['type'] == 'datetime'){
                $this->data[$this->alias]['date'] = date('Y-m-d', strtotime($this->data[$this->alias]['value']));
                $this->data[$this->alias]['time'] = date('H:i:s', strtotime($this->data[$this->alias]['value']));
            }


        }


        return true;
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {
            if (isset($val[$this->alias]['value'])) {

                $this->Behaviors->load('Containable');
                $struct = $this->Customfield->find('first',array(
                    'conditions'=>array(
                        'Customfield.id'=>$val[$this->alias]['field_id']
                    )
                ));

                if($struct['Customfield']['type'] == 'date'){
                    $results[$key][$this->alias]['value'] = $val[$this->alias]['date'];
                }

                if($struct['Customfield']['type'] == 'time'){
                    $results[$key][$this->alias]['value'] = $val[$this->alias]['time'];
                }

                if($struct['Customfield']['type'] == 'datetime'){
                    $results[$key][$this->alias]['value'] = $val[$this->alias]['date']." ".$val[$this->alias]['time'];
                }

                $results[$key][$this->alias]['value_text'] = $results[$key][$this->alias]['value'];

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
