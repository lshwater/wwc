<?
class CutoffdateHelper extends AppHelper {
    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
    }

    public function check($date = null, &$msg = null, $rolecheck = true){
        if(Configure::read("modulus.Cutoffdate")){
            if(!$date){
                $date = date("Y-m-d");
            }
            $cutoffdate = Configure::read('cutoffdate');
            if(strtotime($cutoffdate['Cutoffdate']['name']) <= strtotime($date)){
                return true;
            }else{
                $msg = "注意： 可更改日期已過，可能會影響之前的報告結果。";
                if($rolecheck){
                    if(CakeSession::read('Auth.superadmin')){
                        return true;
                    }
                }
                return false;
            }
        }
        else{
            return true;
        }
    }
}
?>