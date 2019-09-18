<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class NeedcarersController extends AppController
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
        $this->Needcarer->recursive = 0;
        $this->set('Needcarers', $this->Needcarer->find('all'));
    }

    public function advsearch($withoutmenu = false, $voluntertype = 1)
    {
        if($withoutmenu){
            $this->layout = "withoutmenu";
        }
        $Needcarertype = $this->Needcarer->Needcarertype->find("first", array(
            "conditions"=>array(
                $this->Needcarer->Needcarertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $this->set('Needcarertype', $Needcarertype);
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
//            $membercard = trim($this->request->data['Needcarer']['membercard']);
//            $code = trim($this->request->data['Needcarer']['code']);
//            $c_name = trim($this->request->data['Needcarer']['c_name']);
//            $e_name = trim($this->request->data['Needcarer']['e_name']);
//            $phone_main = trim($this->request->data['Needcarer']['phone_main']);
//            $Needcarertypes = $this->request->data['Needcarer']['Needcarertype'];
//
//            if(empty($c_name) && empty($e_name) && empty($phone_main) && empty($code) && empty($membercard) && empty($Needcarertypes) ){
//                $errormsg = "必須至少填寫其中一個條件";
//            }else{
//                $conditions = array();
//                if(!empty($membercard)){
//                    $conditions['OR'][$this->Needcarer->alias.".membercard"] = $membercard;
//                }
//                if(!empty($c_name)){
//                    $conditions['OR'][$this->Needcarer->alias.".c_name"] = $c_name;
//                }
//                if(!empty($e_name)){
//                    $conditions['OR'][$this->Needcarer->alias.".e_name"] = $e_name;
//                }
//                if(!empty($code)){
//                    $conditions['OR'][$this->Needcarer->alias.".code"] = $code;
//                }
//                if(!empty($phone_main)){
//                    $conditions['OR'][$this->Needcarer->alias.".phone_main"] = $phone_main;
//                }
//                if(!empty($Needcarertypes)){
//                    foreach($Needcarertypes as $Needcarertype){
//                        $conditions['OR'][][$this->Needcarer->Needcarertype->alias.'.id'] = $Needcarertype;
//                    }
//                }
//                if(!empty($conditions)){
//                    $serachresult = $this->Needcarer->find("all", array(
//                        "conditions"=> $conditions,
//                        'fields'=>array(
//                            "Needcarer.code", "Needcarer.e_name","Needcarer.c_name","Needcarer.phone_main","Needcarer.id","Needcarer.email"
//                        )
//                    ));
//
//                    if(!empty($serachresult)){
//                        foreach($serachresult as $key=>$val){
//                            $result[]['Needcarer'] = $serachresult[$key]['Needcarer'];
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
        $Needcarertype = $this->Needcarer->Needcarertype->find("first", array(
            "conditions"=>array(
                $this->Needcarer->Needcarertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        if(empty($Needcarertype)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->set('Needcarertype', $Needcarertype);

        $availability = $this->Needcarer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));


        $this->set('availability', $availability);
        $this->set('Needcarerunits', $this->Needcarer->Needcarerunit->find("list"));
        $this->set('eventproposaltargets', $this->Needcarer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true))));
        $this->set('Needcarer_type', $this->Needcarer->Needcarertype->find('list'));
    }

    public function delete($id = null){
        $this->Needcarer->id = $id;
        if (!$this->Needcarer->exists()) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Needcarer->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00043".')', 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function edit($id = null){
//        Configure::write('debug', 2);
        $this->loadModel('Selectionlist');
        if (!$this->Needcarer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Needcarer->begin();
            if($this->Needcarer->saveAssociated($this->request->data, array("deep"=>true))){
                $this->Needcarer->commit();
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
            $options = array('conditions' => array('Needcarer.' . $this->Needcarer->primaryKey => $id));
            $this->request->data = $this->Needcarer->find('first', $options);
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

        $this->Needcarer->Eventproposaltarget->recursive = 0;
        $eventproposaltargets = $this->Needcarer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $Needcarer_type = $this->Needcarer->Needcarertype->find('list');
        $Needcarertags = $this->Needcarer->Needcarertag->find('list', array('conditions'=>array('active'=>true)));
        $availability = $this->Needcarer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));
        $Needcarerunits = $this->Needcarer->Needcarerunit->find("list");

        $this->set('identitytypes', $this->Needcarer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("Needcarerunits", $Needcarerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('Needcarer_type', $Needcarer_type);
        $this->set('Needcarertags', $Needcarertags);
        $this->set('education_level', $education_level);
        $this->set('eventproposaltargets', $eventproposaltargets);
        $this->set('availability', $availability);

    }

    public function add(){


        if ($this->request->is('post')) {
            $this->Needcarer->begin();
            $this->Needcarer->create();
            if($this->Needcarer->saveAssociated($this->request->data, array("deep"=>true))){

                $code = configure::read("Needcarer.code_prefix").str_pad($this->Needcarer->id, 6, 0, STR_PAD_LEFT).configure::read("Needcarer.code_suffix");
                if(!$this->Needcarer->saveField('code',$code)){
                    $error = configure::read("error_prefix")."00006";
                }

                $this->Needcarer->commit();
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

        $this->Needcarer->Eventproposaltarget->recursive = 0;
        $Needcarer_type = $this->Needcarer->Needcarertype->find('list');
        $Needcarertags = $this->Needcarer->Needcarertag->find('list', array('conditions'=>array('active'=>true)));
        $eventproposaltargets = $this->Needcarer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $availability = $this->Needcarer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));

        $Needcarerunits = $this->Needcarer->Needcarerunit->find("list");

        $this->set('identitytypes', $this->Needcarer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("Needcarerunits", $Needcarerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('Needcarer_type', $Needcarer_type);
        $this->set('Needcarertags', $Needcarertags);
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
        if (!$this->Needcarer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Needcarer->Behaviors->load('Containable');

        $options = array(
            'recursive' => -1,
            'conditions' => array(
                'Needcarer.' . $this->Needcarer->primaryKey => $id
            ),
            'contain' => array(
                'Identitytype',
                'Needcarertype',
                'Gender.Selectionitem',
                'Employmentstatus.Selectionitem',
                'Educationlevel.Selectionitem',
                'Eventproposaltarget',
                'Availability',
                'ActivitiesNeedcarer.Activity.Eventproposal'
            ),
        );

        $availabilities = $this->Needcarer->Availability->find('all', array(
            'recursive' => -1
        ));
        $this->set('availabilities', $availabilities);

        $Needcarer = $this->Needcarer->find('first', $options);
        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);
        $this->set('Needcarer', $Needcarer);
//        $this->set("modal_title", $Needcarer['Needcarer']['chinese_name']);
    }

    public function ajax_matching(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $datasearch = array();
        $errormsg = "";

        if ($this->request->is('post') || $this->request->is('put')) {

            $datasearch['membercard'] = trim($this->request->data['Needcarer']['membercard']);
            $datasearch['code'] = trim($this->request->data['Needcarer']['code']);
            $datasearch['c_name'] = trim($this->request->data['Needcarer']['c_name']);
            $datasearch['e_name'] = trim($this->request->data['Needcarer']['e_name']);
            $datasearch['phone_main'] = trim($this->request->data['Needcarer']['phone_main']);

            $datasearch['from_age'] = trim($this->request->data['Needcarer']['from_age']);
            $datasearch['to_age'] = trim($this->request->data['Needcarer']['to_age']);
            $datasearch['Needcarerunit'] = trim($this->request->data['Needcarer']['Needcarerunit']);
            $datasearch['eventproposaltargets'] = $this->request->data['Needcarer']['eventproposaltarget'];
            $datasearch['Needcarertypes'] = $this->request->data['Needcarer']['Needcarertype'];
            $datasearch['availabilities'] = !empty($this->request->data['Needcarer']['availability']) ? $this->request->data['Needcarer']['availability'] : null;

            $this->Needcarer->virtualFields = array(
                'age' =>'(PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT('.$this->Needcarer->alias.'.dob, "%Y%m") )) DIV 12',
            );

            if(!array_filter($datasearch)){
                $errormsg = "必須至少填寫其中一個條件";
            }else{
                $condition_Needcarer = array();
                $condition_Needcarertype = array();
                $condition_eventproposaltarget = array();
                $condition_availability = array();

                if(!empty($datasearch['membercard'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".membercard"] = $datasearch['membercard'];
                }
                if(!empty($datasearch['code'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".code"] = $datasearch['code'];
                }
                if(!empty($datasearch['c_name'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".c_name LIKE"] = "%".$datasearch['c_name']."%";
                }
                if(!empty($datasearch['e_name'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".e_name LIKE"] = "%".$datasearch['e_name']."%";
                }
                if(!empty($datasearch['phone_main'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".phone_main"] = $datasearch['phone_main'];
                }
                //conditions for Eventproposaltarget
                if(!empty($datasearch['eventproposaltargets'])){
                    foreach($datasearch['eventproposaltargets'] as $eventproposaltarget){
                        $condition_eventproposaltarget['OR'][][$this->Needcarer->Eventproposaltarget->alias.'.id'] = $eventproposaltarget;
                    }
                }

                //conditions for Availability
                if(!empty($datasearch['availabilities'])){
                    foreach($datasearch['availabilities'] as $index=>$val){
                        if($val){
                            $condition_availability['OR'][][$this->Needcarer->Availability->alias.".id"] = $index;
                        }
                    }
                }

                //conditions for Needcarertype
                if(!empty($datasearch['Needcarertypes'])){
                    foreach($datasearch['Needcarertypes'] as $Needcarertype){
                        $condition_Needcarertype['OR'][][$this->Needcarer->Needcarertype->alias.'.id'] = $Needcarertype;
                    }
                }

                //conditions for Needcarer
                if(!empty($datasearch['Needcarerunit'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.'.Needcarerunit_id'] = $datasearch['Needcarerunit'];
                }
                if(!empty($datasearch['from_age'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".age >="] = $datasearch['from_age'];
                }
                if(!empty($datasearch['to_age'])){
                    $condition_Needcarer['AND'][$this->Needcarer->alias.".age <="] = $datasearch['to_age'];
                }

                if(!(empty($condition_Needcarer) && empty($condition_Needcarertype) && empty($condition_eventproposaltarget) && empty($condition_availability))){
                    $this->Needcarer->Behaviors->load('Containable');
                    $serachresult = $this->Needcarer->find("all", array(
                        "conditions"=> $condition_Needcarer,
                        "contain"=>array(
                            "Eventproposaltarget"=>array(
                                "conditions"=>$condition_eventproposaltarget
                            ),
                            "Needcarertype"=>array(
                                "conditions"=>$condition_Needcarertype,
                            ),
                            "Availability"=>array(
                                "conditions"=>$condition_availability
                            )
                        ),

                    ));

                    if(!empty($serachresult)){
                        foreach($serachresult as $key=>$val){
                            if(!empty($datasearch['Needcarertypes'])){
                                if($serachresult[$key]['Needcarertype'] == null){continue;}
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
