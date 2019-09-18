<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 */
class Menu extends AppModel {

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Menucategory' => array(
            'className' => 'Menucategory',
            'foreignKey' => 'menucategory_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'Group',
            'joinTable' => 'groups_menus',
            'foreignKey' => 'menu_id',
            'associationForeignKey' => 'group_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
    );

    public function getmenu(){
        $group = CakeSession::read('Auth.groupsusers');

        $this->Behaviors->load('Containable');
        $menu = $this->find('all', array(
                'contain'=>array(
                    'Menucategory',
                    'Group'=>array(
                        'conditions'=>array(
                            "Group.id"=>$group
                        )
                    )
                ),
                'order'=>array(
                    'Menucategory.displayorder ASC',
                    'Menu.order ASC'
                )
            )
        );

        $return = array();
        if(!empty($menu)){
            foreach($menu as $val){
                if(!empty($val['Group'])){
                    $href = array(
                        'controller'=>$val['Menu']['controller'],
                        'action'=>$val['Menu']['action'],

                    );
                    if(!empty($val['Menu']['parameter'])){
                        $parm = explode(",",$val['Menu']['parameter']);
                        foreach($parm as $p){
                            $href[] =  $p;
                        }
                    }

                    $return['Menu'][$val['Menucategory']['id']][] = array(
                        'href'=>$href,
                        'name'=>$val['Menu']['name'],
                        'labelval'=>$val['Menu']['labelval'],
                        'labelclass'=>$val['Menu']['labelclass'],
                        'class'=>$val['Menu']['class']
                    );

                    $return['Menucategory'][$val['Menucategory']['id']] = $val['Menucategory'];
                }
            }
        }

        return $return;

    }

    public function get_topmenus(){
        $groupsinuse = CakeSession::read('Auth.groupsinuse');
        if($groupsinuse == 1){

            return $this->menu;
        }
        else if($groupsinuse == 2){

            return $this->menu;
        }
        else if($groupsinuse == 3){
            return $this->menu;
        }
        else  if($groupsinuse == 4){
            unset($this->menu[1]);
            unset($this->menu[8]);
            unset($this->menu[9]);
            return $this->menu;
        }
        else  if($groupsinuse == 5){

            return array($this->menu[4], $this->menu[5],$this->menu[6],$this->menu[7]);
        }
        else  if($groupsinuse == 6){
            //unset($this->menu[2]['list'][3]);
            return array($this->menu[2],$this->menu[3]);
        }
//        else  if($groupsinuse == 7){
//            unset($this->menu[2]['list'][3]);
//            return array($this->menu[2],$this->menu[3]);
//        }
        else{
            return null;
        }

    }

    public function get_view_controller(){
        $groups = CakeSession::read('Auth.groupsusers');

        $contro = array();
        if(!empty($groups)){
            $groupsinuse = CakeSession::read('Auth.groupsinuse');

            foreach($groups as $val){

                $contro[$val] = array("group_id"=>$val , "name"=>$this->usergroups[$val]);
            }
        }

        return $contro;
    }
}
