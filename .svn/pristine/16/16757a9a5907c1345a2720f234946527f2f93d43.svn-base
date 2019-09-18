<?php
App::uses('AppModel', 'Model');
/**
 * Unit Model
 *
 * @property Agency $Agency
 * @property User $User
 */
class Year extends AppModel {

    public $virtualFields = array(
        'name' => 'CONCAT(Year.start, " - ", Year.end)'
    );

    public $validate = array(
        'start' => array(
            "periodcheck"=>array(
                'rule' => array('periodcheck'),
                'message' => '週期範圍不正確'
            )
        ),
        'end' => array(
            "periodcheck"=>array(
                'rule' => array('periodcheck'),
                'message' => '週期範圍不正確'
            ),
            'comparison2' => array('rule'=>array('field_comparison', '>=', 'start'), 'message' => '週期範圍不正確'),
        ),
        'activedate' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field cannot be empty',
            )
        )
    );

    function periodcheck(){
        $start = $this->data['Year']['start'];
        $end = $this->data['Year']['end'];
        $id = $this->data['Year']['id'];

        $count = $this->find('count', array(
            "conditions"=>array(
                    "AND"=>array(
                    "Year.end >" =>$start,
                    "Year.start <" =>$end,
                    "Year.id != "=>$id
                )
            )
        ));

        if($count > 0){
            return false;
        }
        else{
            return true;
        }
    }

    public function getcurrent(){
        $rs = $this->find("first", array(
            "conditions"=>array(
                $this->alias . ".activedate <="=>date("Y-m-d")
            ),
            "order"=>array(
                $this->alias .".activedate DESC"
            ),
        ));
        return $rs;

    }

}
