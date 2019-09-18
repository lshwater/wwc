<?php
App::uses('AppModel', 'Model');


class MemberMemberrelation extends AppModel {

    public $validate = array(
        'member_parent' => array(
            'rule' => array('isUniqueMulti', array('member_parent', 'member_child', 'relationship_id')),
            'message' => '已報名',
        ),
    );

    public $belongsTo = array(
        'Parentmember' => array(
            'className' => 'Member',
            'foreignKey' => 'member_1',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Childmember' => array(
            'className' => 'Member',
            'foreignKey' => 'member_2',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        "Memberrelation"=> array(
            'className' => 'Memberrelation',
            'foreignKey' => 'relationship_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

    );

    public function saverelation($member_parent = null, $member_child = null, $relationship_id = null){
        if(!$member_parent && !$member_child && !$relationship_id){
            return false;
        }

        $rs = $this->find("first", array(
           "conditions"=>array(
               "member_parent"=>$member_parent,
               "member_child"=>$member_child,
               "relationship_id"=>$relationship_id
           )
        ));

        if(empty($rs)){
            $this->create();
            return $this->save(array(
                "member_parent"=>$member_parent,
                "member_child"=>$member_child,
                "relationship_id"=>$relationship_id
            ));
        }else{
            return true;
        }
    }
}
