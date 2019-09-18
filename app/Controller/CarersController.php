<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class CarersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    /**
     * index method
     *
     * @return void
     */

    public function index(){
//        Configure::write('debug', 2);
        $this->Carer->recursive = 0;
        $this->set('Carers', $this->Carer->find('all'));
    }

    public function advsearch($withoutmenu = false, $voluntertype = 1)
    {
        if($withoutmenu){
            $this->layout = "withoutmenu";
        }
        $Carertype = $this->Carer->Carertype->find("first", array(
            "conditions"=>array(
                $this->Carer->Carertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $this->set('Carertype', $Carertype);
    }

    //需要整張FORM 連token post過來
//    public function ajax_checkinfo(){
////        Configure::write('debug', 2);
//        $this->autoRender = false;
//        $this->RequestHandler->respondAs('json');
//        $result = false;
//        $errormsg = "";
//
//        if ($this->request->is('post') || $this->request->is('put')) {
//            $membercard = trim($this->request->data['Carer']['membercard']);
//            $code = trim($this->request->data['Carer']['code']);
//            $c_name = trim($this->request->data['Carer']['c_name']);
//            $e_name = trim($this->request->data['Carer']['e_name']);
//            $phone_main = trim($this->request->data['Carer']['phone_main']);
//            $Carertypes = $this->request->data['Carer']['Carertype'];
//
//            if(empty($c_name) && empty($e_name) && empty($phone_main) && empty($code) && empty($membercard) && empty($Carertypes) ){
//                $errormsg = "必須至少填寫其中一個條件";
//            }else{
//                $conditions = array();
//                if(!empty($membercard)){
//                    $conditions['OR'][$this->Carer->alias.".membercard"] = $membercard;
//                }
//                if(!empty($c_name)){
//                    $conditions['OR'][$this->Carer->alias.".c_name"] = $c_name;
//                }
//                if(!empty($e_name)){
//                    $conditions['OR'][$this->Carer->alias.".e_name"] = $e_name;
//                }
//                if(!empty($code)){
//                    $conditions['OR'][$this->Carer->alias.".code"] = $code;
//                }
//                if(!empty($phone_main)){
//                    $conditions['OR'][$this->Carer->alias.".phone_main"] = $phone_main;
//                }
//                if(!empty($Carertypes)){
//                    foreach($Carertypes as $Carertype){
//                        $conditions['OR'][][$this->Carer->Carertype->alias.'.id'] = $Carertype;
//                    }
//                }
//                if(!empty($conditions)){
//                    $serachresult = $this->Carer->find("all", array(
//                        "conditions"=> $conditions,
//                        'fields'=>array(
//                            "Carer.code", "Carer.e_name","Carer.c_name","Carer.phone_main","Carer.id","Carer.email"
//                        )
//                    ));
//
//                    if(!empty($serachresult)){
//                        foreach($serachresult as $key=>$val){
//                            $result[]['Carer'] = $serachresult[$key]['Carer'];
//                        }
//                    }
//                }
//                if(empty($result)){
//                    $errormsg = "沒有記錄";
//                }
//            }
//
//            echo json_encode(
//                array(
//                    "result"=>$result,
//                    "errormsg"=>$errormsg
//                )
//            );
//        }
//    }

    public function matching($voluntertype = 1){

        $this->layout = "withoutmenu";
        $Carertype = $this->Carer->Carertype->find("first", array(
            "conditions"=>array(
                $this->Carer->Carertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        if(empty($Carertype)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->set('Carertype', $Carertype);

        $availability = $this->Carer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));


        $this->set('availability', $availability);
        $this->set('Carerunits', $this->Carer->Carerunit->find("list"));
        $this->set('eventproposaltargets', $this->Carer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true))));
        $this->set('Carer_type', $this->Carer->Carertype->find('list'));
    }

    public function delete($id = null){
        $this->Carer->id = $id;
        if (!$this->Carer->exists()) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Carer->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00043".')', 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function edit($id = null){
//        Configure::write('debug', 2);
        $this->loadModel('Selectionlist');
        if (!$this->Carer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Carer->begin();
            if($this->Carer->saveAssociated($this->request->data, array("deep"=>true))){
                $this->Carer->commit();
                $this->Session->setFlash(__('成功儲存'), 'default', array('class'=>'alert alert-success'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            }else{
                $this->Session->setFlash(__('儲存失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00045".')', 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Carer.' . $this->Carer->primaryKey => $id));
            $this->request->data = $this->Carer->find('first', $options);
        }

        $employment_status = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '5')
            )
        );
        $gender = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '1')
            )
        );
        $education_level = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '3')
            )
        );

        $this->Carer->Eventproposaltarget->recursive = 0;
        $eventproposaltargets = $this->Carer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $Carer_type = $this->Carer->Carertype->find('list');
        $Carertags = $this->Carer->Carertag->find('list', array('conditions'=>array('active'=>true)));
        $availability = $this->Carer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));
        $Carerunits = $this->Carer->Carerunit->find("list");

        $this->set('identitytypes', $this->Carer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("Carerunits", $Carerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('Carer_type', $Carer_type);
        $this->set('Carertags', $Carertags);
        $this->set('education_level', $education_level);
        $this->set('eventproposaltargets', $eventproposaltargets);
        $this->set('availability', $availability);

    }

    public function add(){


        if ($this->request->is('post')) {
            $this->Carer->begin();
            $this->Carer->create();
            if($this->Carer->saveAssociated($this->request->data, array("deep"=>true))){

                $code = configure::read("Carer.code_prefix").str_pad($this->Carer->id, 6, 0, STR_PAD_LEFT).configure::read("Carer.code_suffix");
                if(!$this->Carer->saveField('code',$code)){
                    $error = configure::read("error_prefix")."00006";
                }

                $this->Carer->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("action"=>'index'));
            }else{
                $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00044".')', 'default', array('class'=>'alert alert-danger'));
            }
        }
        $this->loadModel('Selectionlist');
        $employment_status = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '5')
            )
        );
        $gender = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '1')
            )
        );
        $education_level = $this->Selectionlist->Selectionitem->find('list', array(
                'conditions' => array('Selectionitem.selectionlist_id' => '3')
            )
        );

        $this->Carer->Eventproposaltarget->recursive = 0;
        $Carer_type = $this->Carer->Carertype->find('list');
        $Carertags = $this->Carer->Carertag->find('list', array('conditions'=>array('active'=>true)));
        $eventproposaltargets = $this->Carer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $availability = $this->Carer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));

        $Carerunits = $this->Carer->Carerunit->find("list");

        $this->set('identitytypes', $this->Carer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("Carerunits", $Carerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('Carer_type', $Carer_type);
        $this->set('Carertags', $Carertags);
        $this->set('education_level', $education_level);
        $this->set('eventproposaltargets', $eventproposaltargets);
        $this->set('availability', $availability);
    }

    public function ajax_checkidentity(){
        if($this->request->is('post') || $this->request->is('put')) {
            $hkid = trim(strtoupper($this->request->data['hkid']));

            App::import('Vendor', 'hkid');
            $obj_hkid = new HKID();
            $obj_hkid->set($hkid);

            if(!$obj_hkid->validate()){
                $msg['format'] = false;
            }else{
                $msg['format'] = true;
            }
            $this->set(compact('msg'));
            $this->set('_serialize', array('msg'));
        }
    }

    public function view($id = null)
    {
//        Configure::write('debug', 2);
        if (!$this->Carer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Carer->Behaviors->load('Containable');

        $options = array(
            'recursive' => -1,
            'conditions' => array(
                'Carer.' . $this->Carer->primaryKey => $id
            ),
            'contain' => array(
                'Identitytype',
                'Carertype',
                'Gender.Selectionitem',
                'Employmentstatus.Selectionitem',
                'Educationlevel.Selectionitem',
                'Eventproposaltarget',
                'Availability',
                'ActivitiesCarer.Activity.Eventproposal'
            ),
        );

        $availabilities = $this->Carer->Availability->find('all', array(
            'recursive' => -1
        ));
        $this->set('availabilities', $availabilities);

        $Carer = $this->Carer->find('first', $options);
        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);
        $this->set('Carer', $Carer);
//        $this->set("modal_title", $Carer['Carer']['chinese_name']);
    }

    public function ajax_matching(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $datasearch = array();
        $errormsg = "";

        if ($this->request->is('post') || $this->request->is('put')) {

            $datasearch['membercard'] = trim($this->request->data['Carer']['membercard']);
            $datasearch['code'] = trim($this->request->data['Carer']['code']);
            $datasearch['c_name'] = trim($this->request->data['Carer']['c_name']);
            $datasearch['e_name'] = trim($this->request->data['Carer']['e_name']);
            $datasearch['phone_main'] = trim($this->request->data['Carer']['phone_main']);

            $datasearch['from_age'] = trim($this->request->data['Carer']['from_age']);
            $datasearch['to_age'] = trim($this->request->data['Carer']['to_age']);
            $datasearch['Carerunit'] = trim($this->request->data['Carer']['Carerunit']);
            $datasearch['eventproposaltargets'] = $this->request->data['Carer']['eventproposaltarget'];
            $datasearch['Carertypes'] = $this->request->data['Carer']['Carertype'];
            $datasearch['availabilities'] = !empty($this->request->data['Carer']['availability']) ? $this->request->data['Carer']['availability'] : null;

            $this->Carer->virtualFields = array(
                'age' =>'(PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT('.$this->Carer->alias.'.dob, "%Y%m") )) DIV 12',
            );

            if(!array_filter($datasearch)){
                $errormsg = "必須至少填寫其中一個條件";
            }else{
                $condition_Carer = array();
                $condition_Carertype = array();
                $condition_eventproposaltarget = array();
                $condition_availability = array();

                if(!empty($datasearch['membercard'])){
                    $condition_Carer['AND'][$this->Carer->alias.".membercard"] = $datasearch['membercard'];
                }
                if(!empty($datasearch['code'])){
                    $condition_Carer['AND'][$this->Carer->alias.".code"] = $datasearch['code'];
                }
                if(!empty($datasearch['c_name'])){
                    $condition_Carer['AND'][$this->Carer->alias.".c_name LIKE"] = "%".$datasearch['c_name']."%";
                }
                if(!empty($datasearch['e_name'])){
                    $condition_Carer['AND'][$this->Carer->alias.".e_name LIKE"] = "%".$datasearch['e_name']."%";
                }
                if(!empty($datasearch['phone_main'])){
                    $condition_Carer['AND'][$this->Carer->alias.".phone_main"] = $datasearch['phone_main'];
                }
                //conditions for Eventproposaltarget
                if(!empty($datasearch['eventproposaltargets'])){
                    foreach($datasearch['eventproposaltargets'] as $eventproposaltarget){
                        $condition_eventproposaltarget['OR'][][$this->Carer->Eventproposaltarget->alias.'.id'] = $eventproposaltarget;
                    }
                }

                //conditions for Availability
                if(!empty($datasearch['availabilities'])){
                    foreach($datasearch['availabilities'] as $index=>$val){
                        if($val){
                            $condition_availability['OR'][][$this->Carer->Availability->alias.".id"] = $index;
                        }
                    }
                }

                //conditions for Carertype
                if(!empty($datasearch['Carertypes'])){
                    foreach($datasearch['Carertypes'] as $Carertype){
                        $condition_Carertype['OR'][][$this->Carer->Carertype->alias.'.id'] = $Carertype;
                    }
                }

                //conditions for Carer
                if(!empty($datasearch['Carerunit'])){
                    $condition_Carer['AND'][$this->Carer->alias.'.Carerunit_id'] = $datasearch['Carerunit'];
                }
                if(!empty($datasearch['from_age'])){
                    $condition_Carer['AND'][$this->Carer->alias.".age >="] = $datasearch['from_age'];
                }
                if(!empty($datasearch['to_age'])){
                    $condition_Carer['AND'][$this->Carer->alias.".age <="] = $datasearch['to_age'];
                }

                if(!(empty($condition_Carer) && empty($condition_Carertype) && empty($condition_eventproposaltarget) && empty($condition_availability))){
                    $this->Carer->Behaviors->load('Containable');
                    $serachresult = $this->Carer->find("all", array(
                        "conditions"=> $condition_Carer,
                        "contain"=>array(
                            "Eventproposaltarget"=>array(
                                "conditions"=>$condition_eventproposaltarget
                            ),
                            "Carertype"=>array(
                                "conditions"=>$condition_Carertype,
                            ),
                            "Availability"=>array(
                                "conditions"=>$condition_availability
                            )
                        ),

                    ));

                    if(!empty($serachresult)){
                        foreach($serachresult as $key=>$val){
                            if(!empty($datasearch['Carertypes'])){
                                if($serachresult[$key]['Carertype'] == null){continue;}
                            }
                            if(!empty($datasearch['eventproposaltargets'])){
                                if($serachresult[$key]['Eventproposaltarget'] == null){continue;}
                            }
                            if(!empty($datasearch['availabilities'])){
                                if($serachresult[$key]['Availability'] == null){continue;}
                            }

                            $result[] = $serachresult[$key];
                        }
                    }
                }

                if(empty($result)){
                    $errormsg = "沒有記錄";
                }
            }
            echo json_encode(
                array(
                    "result"=>$result,
                    "errormsg"=>$errormsg
                )
            );
        }
    }

    public function beforeFilter()
    {
//        if ($this->request['action'] == 'ajax_checkinfo' ) {
//            $this->Security->csrfUseOnce = false;
//        }
        if ($this->request['action'] == 'edit' || $this->request['action'] == 'add' || $this->request['action'] == 'matching' ) {
            $this->Security->unlockedFields = array('Availability');
        }
        if ($this->request['action'] == 'ajax_matching' ) {
            $this->Security->unlockedActions[] = 'ajax_matching';
        }
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }

}
