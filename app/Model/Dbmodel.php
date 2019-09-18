<?php
App::uses('AppModel', 'Model');

class Dbmodel extends AppModel {

    public $hasMany = array(
        'Dbfield' => array(
            'className' => 'Dbfield',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Customtype' => array(
            'className' => 'Customtype',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Customfield' => array(
            'className' => 'Customfield',
            'foreignKey' => 'model_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Workflow' => array(
            'className' => 'Workflow',
            'foreignKey' => 'model_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

    public function get_struct($id, $alias=null){

        $object =array();
        $this->Customfield->Behaviors->load('Containable');

        $conditions = array(
            'model_id'=>$id
        );

        if(!empty($alias)){
            $conditions['alias'] = $alias;
        }

        $fields = $this->Customfield->find('all',array(
            'conditions'=>$conditions,
            'order'=>array(
                'default_order'=>'ASC',
            ),
            'contain'=>array(
                'Customtypedropdown'
            )
        ));

        $fields = Set::combine($fields, "{n}.Customfield.id","{n}");

        foreach($fields as $k=>$field){

            $object[$field['Customfield']['id']] = array(
                'alias'=>$field['Customfield']['alias'],
                'model_id'=>$field['Customfield']['model_id'],
                'field_id'=>$field['Customfield']['id'],
                'label'=>(empty($field['Customfield']['label']))?$field['Customfield']['name']:$field['Customfield']['label'],
                'type'=>$field['Customfield']['type'],
                'order'=>$field['Customfield']['default_order'],
                'div_class'=>$field['Customfield']['default_div_class'],
                'can_filter'=>$field['Customfield']['can_filter'],
            );

            if($field['Customfield']['required']){
                $object[$field['Customfield']['id']]['required'] = true;
            }

            if(isset($field['Customfield']['default'])){
                $object[$field['Customfield']['id']]['default'] = $field['Customfield']['default'];
            }

            if($field['Customfield']['placeholder']){
                $object[$field['Customfield']['id']]['placeholder'] = $field['Customfield']['placeholder'];
            }


            if($field['Customfield']['type'] == 'select'){
                $options = array();
                $object[$field['Customfield']['id']]['multiple'] = intval($field['Customfield']['multiple']);
                $object[$field['Customfield']['id']]['options'] = array();
//                $options = $this->Customfield->Customtypedropdown->find('list',array('fields'=>array('value', 'oname'),'order'=>array('order'=>'ASC')));
                if($field['Customtypedropdown']){
                    foreach($field['Customtypedropdown'] as $list){
                        $options[$list['value']] = $list['oname'];
                    }
                }

                $object[$field['Customfield']['id']]['options'] = $options;
            }

        }
        return $object;

    }


    public function getlogfield($alias){

        $this->Behaviors->load('Containable');

        $model = $this->find('first',array(
            'conditions'=>array(
                'Dbmodel.name'=>"Member"
            ),
            'contain'=>array(
                'Dbfield'=>array(
                    'conditions'=>array(
                        'Dbfield.log'=>1
                    ),
                    'fields'=>array('db_field')
                )
            )
        ));

        $field = array();
        if($model){
            $field = Set::combine($model['Dbfield'], '{n}.db_field', '{n}');
        }
        return $field;

    }



}
