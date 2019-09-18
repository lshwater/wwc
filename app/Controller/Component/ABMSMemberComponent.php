<?
App::uses('Component', 'Controller');
class ABMSMemberComponent extends Component {
    // the other component your component uses
    public $start;
    public $end;
    public $cus_conditions;
    public $result;
    public $xlsxdata;

    public function initialize(Controller $controller) {
        $this->Controller = $controller;
        $this->Model = $this->Controller->{$this->Controller->modelClass};
        $this->modelAlias = $this->Model->alias;
        $this->result = array();
        $this->xlsxdata = array();
        $this->cus_conditions = null;
        parent::initialize($controller);
    }

    public function export(){
        $this->Member = ClassRegistry::init('Member');
        $this->Member->Behaviors->load('Containable');

        $this->result = $this->Member->find("all", array(
            "conditions"=>array(
                $this->Member->alias.".code >="=>$this->start,
                $this->Member->alias.".code <="=>$this->end,
            ),
            "contain"=>array(
                "MemberCustomField.Memberinputfield.Selectionlist.Selectionitem"
            )
        ));

        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>0,"row"=>1, "value"=>"NAME"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>1,"row"=>1, "value"=>"NO"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>2,"row"=>1, "value"=>"SEX"
        );
        $row = 2;
        if(!empty($this->result)){
            foreach($this->result as $m){
                $name = $m['Member']['c_name'];
                $gender = "";
                foreach ($m['MemberCustomField'] as  $field) {
                    if($field['memberinputfield_id'] == 6){
                        foreach($field['Memberinputfield']['Selectionlist']['Selectionitem'] as $item){
                            if ($item['id'] ==  $this->Member->retrievememberfield($m, 6)) {
                                $gender = h(__($item['name']));
                            }

                        }
                    }
                }
                if(empty($name)){
                    $name = $m['Member']['e_name'];
                }
                $this->xlsxdata[] = array(
                    "sheetindex"=>0,"col"=>0,"row"=>$row, "value"=>$name
                );
                $this->xlsxdata[] = array(
                    "sheetindex"=>0,"col"=>1,"row"=>$row, "value"=>$m['Member']['code']
                );
                $this->xlsxdata[] = array(
                    "sheetindex"=>0,"col"=>2,"row"=>$row, "value"=>$gender
                );
                $row++;
            }
        }
    }

    public function exportaddrlabel(){
        $this->Member = ClassRegistry::init('Member');
        $this->Member->Behaviors->load('Containable');

        if(!$this->cus_conditions){
            $conditions = $this->cus_conditions;
        }else{
            $conditions = "";
        }

        $this->result = $this->Member->find("all", array(
            "conditions"=>array(
                $this->Member->alias.".code >="=>$this->start,
                $this->Member->alias.".code <="=>$this->end,
                $this->Member->alias.".noadvertise"=>0,
                $this->Member->alias.".active"=>1,
                $this->Member->alias.".valid"=>1,
                $conditions
            ),
            "contain"=>array(
                "MemberCustomField.Memberinputfield.Selectionlist.Selectionitem"
            )
        ));

        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>0,"row"=>1, "value"=>"Code"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>1,"row"=>1, "value"=>"Name"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>2,"row"=>1, "value"=>"Address"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>3,"row"=>1, "value"=>"agency"
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>4,"row"=>1, "value"=>"agency_address"
        );
        $row = 2;
        if(!empty($this->result)){
            foreach($this->result as $m){
                $name = $m['Member']['c_name'];
                $addr = "";
                foreach ($m['MemberCustomField'] as  $field) {
                    if($field['memberinputfield_id'] == 8){
                        $addr = h($field['value']);
                    }
                }
                if(empty($name)){
                    $name = $m['Member']['e_name'];
                }

                if(!empty($addr)){
                    $this->xlsxdata[] = array(
                        "sheetindex"=>0,"col"=>0,"row"=>$row, "value"=>$m['Member']['code']
                    );
                    $this->xlsxdata[] = array(
                        "sheetindex"=>0,"col"=>1,"row"=>$row, "value"=>$name
                    );
                    $this->xlsxdata[] = array(
                        "sheetindex"=>0,"col"=>2,"row"=>$row, "value"=>$addr
                    );
                    $this->xlsxdata[] = array(
                        "sheetindex"=>0,"col"=>3,"row"=>$row, "value"=>"浸信會鳳德青少年綜合服務"
                    );
                    $this->xlsxdata[] = array(
                        "sheetindex"=>0,"col"=>4,"row"=>$row, "value"=>"九龍鑽石山鳳德社區中心二樓"
                    );
                    $row++;
                }

            }
        }
    }

}
?>