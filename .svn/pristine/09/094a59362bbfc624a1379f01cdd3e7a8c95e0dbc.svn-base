<?php
App::uses('AppModel', 'Model');

class Eventproposalnextcode extends AppModel {

    public $belongsTo = array(
        'Eventproposalcode' => array(
            'className' => 'Eventproposalcode',
            'foreignKey' => 'eventproposalcode_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Year' => array(
            'className' => 'Year',
            'foreignKey' => 'year_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function getnextcode($year_id = null, $eventproposalcode_id = null){
        //Configure::write('debug', 2);
        if(!$eventproposalcode_id && !$year_id){
            return false;
        }
        $rs = $this->find("first", array("conditions"=>array(
            $this->alias.".year_id"=>$year_id,
            $this->alias.".eventproposalcode_id"=>$eventproposalcode_id
        )));
        if(empty($rs)){
            //create count
            $this->create();
            $this->save(array("year_id"=>$year_id, "eventproposalcode_id"=>$eventproposalcode_id, "count"=>configure::read("Eventproposal.codestart")));
            $rs = $this->find("first", array("conditions"=>array(
                $this->alias.".year_id"=>$year_id,
                $this->alias.".eventproposalcode_id"=>$eventproposalcode_id
            )));
        }
        $count = $rs['Eventproposalnextcode']['count'];
        $eventproposalnextcode_id = $rs['Eventproposalnextcode']['id'];
        $this->Eventproposalcode->recursive = -1;
        $eventproposalcode = $this->Eventproposalcode->findById($eventproposalcode_id);
        $Year = $this->Year->findById($year_id);
        //format val=========
        $year_start = substr($Year['Year']['start'], 2, 2);
        $year_end = substr($Year['Year']['end'], 2, 2);
        $code = $eventproposalcode['Eventproposalcode']['name'];
        $number = $count;
        //=========
        $eventproposalcodeformat = null;
        $eventproposalcodeformat_raw = Configure::read("eventproposalcodeformat");
        eval("\$eventproposalcodeformat = \"$eventproposalcodeformat_raw\";");
        if($this->updateAll(
            array('count' => "count+1"),
            array($this->alias.'.id' => $eventproposalnextcode_id)
        )){
            return $eventproposalcodeformat;
        }
        return false;
    }
}
