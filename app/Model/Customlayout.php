<?php
App::uses('AppModel', 'Model');

class Customlayout extends AppModel {

    public $belongsTo = array(
        'Customtype' => array(
            'className' => 'Customtype',
            'foreignKey' => 'type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Customfield' => array(
            'className' => 'Customfield',
            'foreignKey' => 'field_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Dbmodel' => array(
            'className' => 'Dbmodel',
            'foreignKey' => 'model_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Customgroup' => array(
            'className' => 'Customgroup',
            'foreignKey' => 'customgroup_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );




    public function get_struct($id){

        $this->Behaviors->load('Containable');
        $layout = $this->find('all',array(
            'conditions'=>array(
//                'Customlayout.model_id'=>$model,
                'Customlayout.type_id'=>$id,
            ),
            'order'=>array(
                'Customlayout.order'=>'ASC'
            ),
            'contain'=>array(
                'Customfield.Customtypedropdown'
            )
        ));


        $layout = Set::combine($layout, "{n}.Customlayout.field_id","{n}");

        foreach($layout as $k=>$field){

            $object[$field['Customfield']['id']] = array(
                'layout_id'=>$field['Customlayout']['id'],
                'group_id'=>$field['Customlayout']['customgroup_id'],
                'type_id'=>$field['Customlayout']['type_id'],
                'field_id'=>$field['Customfield']['id'],
                'model_id'=>$field['Customfield']['model_id'],
                'alias'=>$field['Customfield']['alias'],
                'label'=>(empty($field['Customfield']['label']))?$field['Customfield']['alias']:$field['Customfield']['label'],
                'type'=>$field['Customfield']['type'],
                'placeholder'=>$field['Customlayout']['placeholder'],
                'default'=>$field['Customlayout']['default'],
                'div_class'=>$field['Customlayout']['div_class'],
                'customgroup_id'=>$field['Customlayout']['customgroup_id'],
            );

            if($field['Customfield']['required']){
                $object[$field['Customfield']['id']]['required'] = true;
            }


            if($field['Customfield']['type'] == 'select'){
                $options = array();
                $object[$field['Customfield']['id']]['multiple'] = intval($field['Customfield']['multiple']);
                $object[$field['Customfield']['id']]['options'] = array();
                if($field['Customfield']['Customtypedropdown']){
                    foreach($field['Customfield']['Customtypedropdown'] as $list){
                        $options[$list['value']] = $list['oname'];
                    }
                }

                $object[$field['Customfield']['id']]['options'] = $options;
            }

        }
        return $object;

    }

    public function get_struct_with_group($id){

        $rst = array();


        $this->Behaviors->load('Containable');



        $layout = $this->find('all',array(
            'conditions'=>array(
//                'Customlayout.model_id'=>$model,
                'Customlayout.type_id'=>$id,
                'Customlayout.customgroup_id'=>null,
            ),
            'order'=>array(
                'Customlayout.order'=>'ASC'
            ),
            'contain'=>array(
                'Customfield.Customtypedropdown'
            )
        ));


        $layout = Set::combine($layout, "{n}.Customlayout.field_id","{n}");

        foreach($layout as $k=>$field){

            $object[$field['Customfield']['id']] = array(
                'layout_id'=>$field['Customlayout']['id'],
                'group_id'=>$field['Customlayout']['customgroup_id'],
                'type_id'=>$field['Customlayout']['type_id'],
                'field_id'=>$field['Customfield']['id'],
                'model_id'=>$field['Customfield']['model_id'],
                'alias'=>$field['Customfield']['alias'],
                'label'=>(empty($field['Customfield']['label']))?$field['Customfield']['alias']:$field['Customfield']['label'],
                'type'=>$field['Customfield']['type'],
                'placeholder'=>$field['Customlayout']['placeholder'],
                'default'=>$field['Customlayout']['default'],
                'div_class'=>$field['Customlayout']['div_class'],
                'customgroup_id'=>$field['Customlayout']['customgroup_id'],
            );

            if($field['Customfield']['required']){
                $object[$field['Customfield']['id']]['required'] = true;
            }


            if($field['Customfield']['type'] == 'select'){
                $options = array();
                $object[$field['Customfield']['id']]['multiple'] = intval($field['Customfield']['multiple']);
                $object[$field['Customfield']['id']]['options'] = array();
                if($field['Customfield']['Customtypedropdown']){
                    foreach($field['Customfield']['Customtypedropdown'] as $list){
                        $options[$list['value']] = $list['oname'];
                    }
                }

                $object[$field['Customfield']['id']]['options'] = $options;
            }

        }
        $rst['nogroup'] = $object;


        $this->Customgroup->Behaviors->load('Containable');
        $layout = $this->Customgroup->find('all',array(
            'conditions'=>array(
                'Customgroup.type_id'=>$id,
            ),
            'order'=>array(
                'Customgroup.display_order'=>'ASC'
            ),
            'contain'=>array(
                'Customlayout'=>array(
                    'order'=>array(
                        'Customlayout.order'=>'ASC'
                    )
                ),
                'Customlayout.Customfield.Customtypedropdown'
            )
        ));

        $object = array();

        foreach($layout as $k=>$group){
            $index = $group['Customgroup']['id'];

            $object[$index]['name'] = $group['Customgroup']['display_name'];
            $f = array();
            foreach($group['Customlayout'] as $field){
                $f = array(
                    'layout_id'=>$field['id'],
                    'group_id'=>$field['customgroup_id'],
                    'type_id'=>$field['type_id'],
                    'field_id'=>$field['Customfield']['id'],
                    'model_id'=>$field['Customfield']['model_id'],
                    'alias'=>$field['Customfield']['alias'],
                    'label'=>(empty($field['Customfield']['label']))?$field['Customfield']['alias']:$field['Customfield']['label'],
                    'type'=>$field['Customfield']['type'],
                    'placeholder'=>$field['placeholder'],
                    'default'=>$field['default'],
                    'div_class'=>$field['div_class'],
                    'customgroup_id'=>$field['customgroup_id'],
                );


                if($field['Customfield']['required']){
                    $f['required'] = true;
                }


                if($field['Customfield']['type'] == 'select'){
                    $options = array();
                    $f['multiple'] = intval($field['Customfield']['multiple']);
                    $f['options'] = array();
                    if($field['Customfield']['Customtypedropdown']){
                        foreach($field['Customfield']['Customtypedropdown'] as $list){
                            $options[$list['value']] = $list['oname'];
                        }
                    }

                    $f['options'] = $options;
                }
                $object[$index]['fields'][] = $f;
            }

        }

        $rst['group'] = $object;
        return $rst;

    }

}
