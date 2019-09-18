<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class VolunteersController extends AppController
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

    public function test(){
	    configure::write('debug',2);
//	    $this->Member->Behaviors->load('Containable');


//        $options = array(
//            'conditions' => array(
////                'Member.' . $this->Member->primaryKey => 5668,
//            ),
//            'contain' => array(
////                "Membertype",
////                "Identitytype",
//                'MemberCustomField'=>array(
//                    'conditions'=>array(
//                        'MemberCustomField.memberinputfield_id'=>15
//                    )
//                ),
//                'MemberCustomField.Memberinputfield',
////                'MemberCustomField.Memberinputfield.Inputtype',
////                'MemberCustomField.Memberinputfield.Selectionlist',
////                'MemberCustomField.Memberinputfield.Selectionlist.Selectionitem',
////                "Eventproposaltarget",
//            ),
////            'limit'=>10
//        );
////        $member = $this->Member->find('all', $options);

        $member = $this->Volunteer->find('all', array('recursive'=>-1));


        foreach($member as $m){
//            debug($m);
            if(!empty($m['Volunteer']['e_name'])){
//                debug(mb_substr($m['Member']['c_name'],0,2));
                $this->Volunteer->id = $m['Volunteer']['id'];
                $this->Volunteer->saveField('e_name', mb_substr($m['Volunteer']['e_name'],0,3)." XXX".mb_substr($m['Volunteer']['e_name'],6));
            }

        }
//	    debug($member);



        exit();
    }


    public function index(){
//        Configure::write('debug', 2);
        $this->Volunteer->recursive = 0;
        $this->set('volunteers', $this->Volunteer->find('all'));
    }

    public function advsearch($withoutmenu = false, $voluntertype = 1)
    {
        if($withoutmenu){
            $this->layout = "withoutmenu";
        }
        $volunteertype = $this->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        $this->set('volunteertype', $volunteertype);
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
//            $membercard = trim($this->request->data['Volunteer']['membercard']);
//            $code = trim($this->request->data['Volunteer']['code']);
//            $c_name = trim($this->request->data['Volunteer']['c_name']);
//            $e_name = trim($this->request->data['Volunteer']['e_name']);
//            $phone_main = trim($this->request->data['Volunteer']['phone_main']);
//            $volunteertypes = $this->request->data['Volunteer']['volunteertype'];
//
//            if(empty($c_name) && empty($e_name) && empty($phone_main) && empty($code) && empty($membercard) && empty($volunteertypes) ){
//                $errormsg = "必須至少填寫其中一個條件";
//            }else{
//                $conditions = array();
//                if(!empty($membercard)){
//                    $conditions['OR'][$this->Volunteer->alias.".membercard"] = $membercard;
//                }
//                if(!empty($c_name)){
//                    $conditions['OR'][$this->Volunteer->alias.".c_name"] = $c_name;
//                }
//                if(!empty($e_name)){
//                    $conditions['OR'][$this->Volunteer->alias.".e_name"] = $e_name;
//                }
//                if(!empty($code)){
//                    $conditions['OR'][$this->Volunteer->alias.".code"] = $code;
//                }
//                if(!empty($phone_main)){
//                    $conditions['OR'][$this->Volunteer->alias.".phone_main"] = $phone_main;
//                }
//                if(!empty($volunteertypes)){
//                    foreach($volunteertypes as $volunteertype){
//                        $conditions['OR'][][$this->Volunteer->Volunteertype->alias.'.id'] = $volunteertype;
//                    }
//                }
//                if(!empty($conditions)){
//                    $serachresult = $this->Volunteer->find("all", array(
//                        "conditions"=> $conditions,
//                        'fields'=>array(
//                            "Volunteer.code", "Volunteer.e_name","Volunteer.c_name","Volunteer.phone_main","Volunteer.id","Volunteer.email"
//                        )
//                    ));
//
//                    if(!empty($serachresult)){
//                        foreach($serachresult as $key=>$val){
//                            $result[]['Volunteer'] = $serachresult[$key]['Volunteer'];
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
        $volunteertype = $this->Volunteer->Volunteertype->find("first", array(
            "conditions"=>array(
                $this->Volunteer->Volunteertype->alias.".id"=>$voluntertype
            ),
            "recursive"=>-1
        ));

        if(empty($volunteertype)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->set('volunteertype', $volunteertype);

        $availability = $this->Volunteer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));


        $this->set('availability', $availability);
        $this->set('volunteerunits', $this->Volunteer->Volunteerunit->find("list"));
        $this->set('eventproposaltargets', $this->Volunteer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true))));
        $this->set('volunteer_type', $this->Volunteer->Volunteertype->find('list'));
    }

    public function delete($id = null){
        $this->Volunteer->id = $id;
        if (!$this->Volunteer->exists()) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Volunteer->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00043".')', 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function edit($id = null){
//        Configure::write('debug', 2);
        $this->loadModel('Selectionlist');
        if (!$this->Volunteer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Volunteer->begin();
            if($this->Volunteer->saveAssociated($this->request->data, array("deep"=>true))){
                $this->Volunteer->commit();
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
            $options = array('conditions' => array('Volunteer.' . $this->Volunteer->primaryKey => $id));
            $this->request->data = $this->Volunteer->find('first', $options);
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

        $this->Volunteer->Eventproposaltarget->recursive = 0;
        $eventproposaltargets = $this->Volunteer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $volunteer_type = $this->Volunteer->Volunteertype->find('list');
        $volunteertags = $this->Volunteer->Volunteertag->find('list', array('conditions'=>array('active'=>true)));
        $availability = $this->Volunteer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));
        $volunteerunits = $this->Volunteer->Volunteerunit->find("list");

        $this->set('identitytypes', $this->Volunteer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("volunteerunits", $volunteerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('volunteer_type', $volunteer_type);
        $this->set('volunteertags', $volunteertags);
        $this->set('education_level', $education_level);
        $this->set('eventproposaltargets', $eventproposaltargets);
        $this->set('availability', $availability);

    }

    public function add(){


        if ($this->request->is('post')) {
            $this->Volunteer->begin();
            $this->Volunteer->create();
            if($this->Volunteer->saveAssociated($this->request->data, array("deep"=>true))){

                $code = configure::read("Volunteer.code_prefix").str_pad($this->Volunteer->id, 6, 0, STR_PAD_LEFT).configure::read("Volunteer.code_suffix");
                if(!$this->Volunteer->saveField('code',$code)){
                    $error = configure::read("error_prefix")."00006";
                }

                $this->Volunteer->commit();
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

        $this->Volunteer->Eventproposaltarget->recursive = 0;
        $volunteer_type = $this->Volunteer->Volunteertype->find('list');
        $volunteertags = $this->Volunteer->Volunteertag->find('list', array('conditions'=>array('active'=>true)));
        $eventproposaltargets = $this->Volunteer->Eventproposaltarget->find('list',array('conditions'=>array('active'=>true)));
        $availability = $this->Volunteer->Availability->find('list', array(
            'fields' => array('id','day', 'session')
        ));

        $volunteerunits = $this->Volunteer->Volunteerunit->find("list");

        $this->set('identitytypes', $this->Volunteer->Identitytype->find('list', array('conditions' => array('active' => true))));
        $this->set("volunteerunits", $volunteerunits);
        $this->set('employment_status', $employment_status);
        $this->set('gender', $gender);
        $this->set('volunteer_type', $volunteer_type);
        $this->set('volunteertags', $volunteertags);
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
        if (!$this->Volunteer->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Volunteer->Behaviors->load('Containable');

        $options = array(
            'recursive' => -1,
            'conditions' => array(
                'Volunteer.' . $this->Volunteer->primaryKey => $id
            ),
            'contain' => array(
                'Identitytype',
                'Volunteertype',
                'Gender.Selectionitem',
                'Employmentstatus.Selectionitem',
                'Educationlevel.Selectionitem',
                'Eventproposaltarget',
                'Availability',
                'ActivitiesVolunteer.Activity.Eventproposal'
            ),
        );

        $availabilities = $this->Volunteer->Availability->find('all', array(
            'recursive' => -1
        ));
        $this->set('availabilities', $availabilities);

        $volunteer = $this->Volunteer->find('first', $options);
        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);
        $this->set('volunteer', $volunteer);
//        $this->set("modal_title", $volunteer['Volunteer']['chinese_name']);
    }

    public function ajax_matching(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $datasearch = array();
        $errormsg = "";

        if ($this->request->is('post') || $this->request->is('put')) {

            $datasearch['membercard'] = trim($this->request->data['Volunteer']['membercard']);
            $datasearch['code'] = trim($this->request->data['Volunteer']['code']);
            $datasearch['c_name'] = trim($this->request->data['Volunteer']['c_name']);
            $datasearch['e_name'] = trim($this->request->data['Volunteer']['e_name']);
            $datasearch['phone_main'] = trim($this->request->data['Volunteer']['phone_main']);

            $datasearch['from_age'] = trim($this->request->data['Volunteer']['from_age']);
            $datasearch['to_age'] = trim($this->request->data['Volunteer']['to_age']);
            $datasearch['volunteerunit'] = trim($this->request->data['Volunteer']['volunteerunit']);
            $datasearch['eventproposaltargets'] = $this->request->data['Volunteer']['eventproposaltarget'];
            $datasearch['volunteertypes'] = $this->request->data['Volunteer']['volunteertype'];
            $datasearch['availabilities'] = !empty($this->request->data['Volunteer']['availability']) ? $this->request->data['Volunteer']['availability'] : null;

            $this->Volunteer->virtualFields = array(
                'age' =>'(PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT('.$this->Volunteer->alias.'.dob, "%Y%m") )) DIV 12',
            );

            if(!array_filter($datasearch)){
                $errormsg = "必須至少填寫其中一個條件";
            }else{
                $condition_volunteer = array();
                $condition_volunteertype = array();
                $condition_eventproposaltarget = array();
                $condition_availability = array();

                if(!empty($datasearch['membercard'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".membercard"] = $datasearch['membercard'];
                }
                if(!empty($datasearch['code'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".code"] = $datasearch['code'];
                }
                if(!empty($datasearch['c_name'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".c_name LIKE"] = "%".$datasearch['c_name']."%";
                }
                if(!empty($datasearch['e_name'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".e_name LIKE"] = "%".$datasearch['e_name']."%";
                }
                if(!empty($datasearch['phone_main'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".phone_main"] = $datasearch['phone_main'];
                }
                //conditions for Eventproposaltarget
                if(!empty($datasearch['eventproposaltargets'])){
                    foreach($datasearch['eventproposaltargets'] as $eventproposaltarget){
                        $condition_eventproposaltarget['OR'][][$this->Volunteer->Eventproposaltarget->alias.'.id'] = $eventproposaltarget;
                    }
                }

                //conditions for Availability
                if(!empty($datasearch['availabilities'])){
                    foreach($datasearch['availabilities'] as $index=>$val){
                        if($val){
                            $condition_availability['OR'][][$this->Volunteer->Availability->alias.".id"] = $index;
                        }
                    }
                }

                //conditions for Volunteertype
                if(!empty($datasearch['volunteertypes'])){
                    foreach($datasearch['volunteertypes'] as $volunteertype){
                        $condition_volunteertype['OR'][][$this->Volunteer->Volunteertype->alias.'.id'] = $volunteertype;
                    }
                }

                //conditions for Volunteer
                if(!empty($datasearch['volunteerunit'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.'.volunteerunit_id'] = $datasearch['volunteerunit'];
                }
                if(!empty($datasearch['from_age'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".age >="] = $datasearch['from_age'];
                }
                if(!empty($datasearch['to_age'])){
                    $condition_volunteer['AND'][$this->Volunteer->alias.".age <="] = $datasearch['to_age'];
                }

                if(!(empty($condition_volunteer) && empty($condition_volunteertype) && empty($condition_eventproposaltarget) && empty($condition_availability))){
                    $this->Volunteer->Behaviors->load('Containable');
                    $serachresult = $this->Volunteer->find("all", array(
                        "conditions"=> $condition_volunteer,
                        "contain"=>array(
                            "Eventproposaltarget"=>array(
                                "conditions"=>$condition_eventproposaltarget
                            ),
                            "Volunteertype"=>array(
                                "conditions"=>$condition_volunteertype,
                            ),
                            "Availability"=>array(
                                "conditions"=>$condition_availability
                            )
                        ),

                    ));

                    if(!empty($serachresult)){
                        foreach($serachresult as $key=>$val){
                            if(!empty($datasearch['volunteertypes'])){
                                if($serachresult[$key]['Volunteertype'] == null){continue;}
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
