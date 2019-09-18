<?php
App::uses('AppModel', 'Model');

class Membernextcode extends AppModel {

    public $belongsTo = array(
        'Year' => array(
            'className' => 'Year',
            'foreignKey' => 'year_id',
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

    public function getnextcode($membertype_id = null){
        $year = $this->Year->getcurrent();
        if(!$membertype_id){
            return false;
        }

        $membernextcode = $this->find('first', array(
            "conditions"=>array(
                $this->alias.".year_id"=>$year['Year']['id'],
                $this->alias.".membertype_id"=>$membertype_id
            )
        ));

        if(empty($membernextcode)){
            //create count
            $this->create();
            $this->save(array("year_id"=>$year['Year']['id'], "membertype_id"=>$membertype_id, "count"=>1));
            $membernextcode = $this->find("first", array("conditions"=>array(
                $this->alias.".year_id"=>$year['Year']['id'],
                $this->alias.".membertype_id"=>$membertype_id
            )));
        }

        //format val=========
        $year_start = substr($year['Year']['start'], 2, 2);
        $year_end = substr($year['Year']['end'], 2, 2);
        $count = $membernextcode[$this->alias]['count'];

        $this->Membertype->id = $membertype_id;

        $code_format = $this->Membertype->Field("code_format");

        $padnumber = substr_count($code_format, "#");

        $strtoreplace = "";
        for($i = 0; $i < $padnumber; $i++){
            $strtoreplace .= "#";
        }

        $code = str_replace($strtoreplace, str_pad($count, $padnumber, 0, STR_PAD_LEFT), $code_format);

        if($this->updateAll(
            array('count' => "count+1"),
            array($this->alias.'.id' => $membernextcode[$this->alias]['id'])
        )){
            return $code;
        }

        return false;
    }
}
