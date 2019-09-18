<?php
App::uses('AppModel', 'Model');

class Paymentcodenext extends AppModel {


    public function getnextcode($paymenttype = null){

        $paymentnextcode = $this->find('first', array(
            "conditions"=>array(
                $this->alias.".paymenttype"=>$paymenttype
            )
        ));

        if(empty($paymentnextcode)){
            //create count
            $this->create();
            $this->save(array("paymenttype"=>$paymenttype, "count"=>1));
            $paymentnextcode = $this->find('first', array(
                "conditions"=>array(
                    $this->alias.".paymenttype"=>$paymenttype
                )
            ));
        }

        //format val=========
        $count = $paymentnextcode[$this->alias]['count'];


        $code_format = $paymentnextcode[$this->alias]['format'];

        $padnumber = substr_count($code_format, "#");

        $strtoreplace = "";
        for($i = 0; $i < $padnumber; $i++){
            $strtoreplace .= "#";
        }

        $code = str_replace($strtoreplace, str_pad($count, $padnumber, 0, STR_PAD_LEFT), $code_format);

        if($this->updateAll(
            array('count' => "count+1"),
            array($this->alias.'.id' => $paymentnextcode[$this->alias]['id'])
        )){
            return $code;
        }

        return false;
    }
}
