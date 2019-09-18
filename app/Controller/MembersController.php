<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class MembersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function popupsearch($membership_mode = 0){
        $this->layout = "ajax";

        $this->set('membership_mode', $membership_mode);
    }


    public function matching($activity_id = null)
    {
        $this->layout = "withoutmenu";

//        $this->layout = "withoutmenu";
//        if (!$this->Member->Activity->exists($activity_id)) {
//            throw new NotFoundException(__('Invalid'));
//        }

        $this->set('membertypes', $this->Member->Membertype->find('list', array("conditions" => array($this->Member->Membertype->alias . ".active" => 1))));
        $this->set('eventproposaltargets', $this->Member->Eventproposaltarget->find('list', array('conditions' => array('active' => true))));

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


        $this->set('district',$this->district);
        $this->set('education_level',$education_level);
        $this->set('gender',$gender);
        $this->set('employment_status',$employment_status);
    }



    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
//        Configure::write('debug',2);
        $this->Member->recursive = 0;

        $this->loadModel('Dbmodel');
        $this->Dbmodel->Behaviors->load('Containable');
        $model = $this->Dbmodel->find('first',array(
            'conditions'=>array(
                'Dbmodel.name'=>$this->Member->alias,
            ),
            'contain'=>array(
                'Dbfield'=>array(
                    'conditions'=>array(
//                        'Dbfield.sync'=>1,
                        'Dbfield.connected'=>1,
//                        'Dbfield.default_filter'=>1
                    ),
                    'order'=>array(
                        'Dbfield.order'=>'ASC'
                    )
                ),
                'Dbfield.Dbfielddropdown'=>array(
                    'order'=>array(
                        'Dbfielddropdown.order'=>'ASC'
                    )
                )
            )
        ));

        $struct = $this->Dbmodel->get_struct(14);

//        configure::Write('debug',2);
//        debug($struct);exit();
        $this->set('struct', $struct);

        $this->set('model', $model);

    }

    public function add($membertype_id = null, $member_id = null){

        if($membertype_id && !$this->Member->Membership->Membertype->exists($membertype_id)){
            throw new NotFoundException(__('Invalid member type'));
        }
        if($member_id){
            $this->Member->Behaviors->load('Containable');
            $member = $this->Member->find("first", array(
                "conditions"=>array("Member.id"=>$member_id),
                "contain"=>array(
                    "Membertype",
                    "Membership.Membertype",
                    "Membershiprecord.Membertype",
                    "Membershiprecord.Membership",
                    "Identitytype",
                    'Parentmember.Parentmember.Membership.Membertype',
                    'Parentmember.Memberrelation',
                    'Childmember.Childmember',
                    'Childmember.Memberrelation.Membership.Membertype'
                )
            ));
            $this->set('member', $member);

            $relationship = $this->Member->find('first', array(
                'conditions' => array(
                    'Member.' . $this->Member->primaryKey => $member_id
                ),
                'contain' => array(
                    'Parentmember.Parentmember.Membership.Membertype',
                    'Parentmember.Memberrelation',
                    'Childmember.Childmember',
                    'Childmember.Memberrelation.Membership.Membertype'
                )
            ));

            foreach ($relationship['Parentmember'] as $key => $val) {
                $relationship['Parentmember'][$key]['Relatedmember'] = $val['Childmember'];
            }

            foreach ($relationship['Childmember'] as $key => $val) {
                $relationship['Childmember'][$key]['Relatedmember'] = $val['Parentmember'];
            }
//        Configure::write('debug', 2);
//        debug(array_merge($relationship['Parentmember'], $relationship['Childmember']));exit();
            $this->set('relationship', array_merge($relationship['Parentmember'], $relationship['Childmember']));
        }
        if($membertype_id){
            $membertype = $this->Member->Membership->Membertype->find("first", array(
                'conditions' => array(
                    'Membertype.id' => $membertype_id
                ),
                "recursive"=>-1
            ));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->loadModel("Membernextcode");
            $error = false;
            $this->Member->begin();

            $member2save = $this->request->data['Member'];
            if(empty($member)){
                $this->Member->create();
            }else{
                $member2save['id'] = $member['Member']['id'];
            }
            if(!$this->Member->save($member2save)){
                $error = true;
                $this->Session->setFlash(__('會員資料存儲失敗 #EMA01'), 'default', array('class' => 'alert alert-danger'));

            }
            if($membertype_id){
                if($membertype['Membertype']['default_period'] == 0){
                    $this->request->data['Membership']['startdate'] = date("Y-m-d");
                    $this->request->data['Membership']['enddate'] = "2099-12-31";
                    $this->request->data['Membership']['period_d'] = 9999;
                    $this->request->data['Membership']['period'] = 99;
                }
                $this->request->data['Membership']['membershiprecordtype_id'] = 1;
                if(!empty($member['Membership'])) {
                    foreach ($member['Membership'] as $ms) {
                        if($ms['membertype_id'] == $membertype['Membertype']['id']){
                            $this->request->data['Membership']['membershiprecordtype_id'] = 2;
                        }
                    }
                }

                //Membership save
                $membership2save = $this->request->data['Membership'];


                if(empty($current_membership)){
                    $this->Member->Membership->create();
                }else{
                    $membership2save['id'] = $current_membership['Membership']['id'];
                }

                $membership2save['member_id'] = $this->Member->id;
                $membership2save['membertype_id'] = $membertype_id;
                $membership2save['code'] = $this->Membernextcode->getnextcode($membertype_id);
                while ($this->Member->Membership->find("count", array("conditions"=>array("code"=>$membership2save['code'])))){
                    $membership2save['code'] = $this->Membernextcode->getnextcode($membertype_id);
                }

                if(!$this->Member->Membership->save($membership2save)){
                    $error = true;
                    $this->Session->setFlash(__('會藉資料存儲失敗 #EMA03'), 'default', array('class' => 'alert alert-danger'));

                }

                //Membership Record save
                $membershiprecord2save = $this->request->data['Membership'];
                $membershiprecord2save['member_id'] = $this->Member->id;
                $membershiprecord2save['membership_id'] = $this->Member->Membership->id;
                $membershiprecord2save['membertype_id'] = $membertype_id;
                $membershiprecord2save['user_id'] = $this->Auth->user('id');

                $this->Member->Membershiprecord->create();

                if(!$this->Member->Membershiprecord->save($membershiprecord2save)){
                    $error = true;
                    $this->Session->setFlash(__('會藉記錄新增失敗 #EMA02'), 'default', array('class' => 'alert alert-danger'));

                }
            }

            if(!empty($this->request->data['Parentmember'])){
                foreach($this->request->data['Parentmember'] as $pm){
                    if(!empty($pm['id'])){
                        $this->Member->Parentmember->id = $pm['id'];
                        $this->Member->Parentmember->savefield("relationship_id", $pm['relationship_id']);
                    }else{
                        $this->Member->Parentmember->saverelation($this->Member->id, $pm['member_child'],  $pm['relationship_id']);
                    }
                }
            }

            if(!$error){
                $this->Member->commit();
                $this->Session->setFlash(__('新增成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array("action"=>"view", $this->Member->id));
            }else{
                $this->Member->rollback();
            }
        }else if(!empty($member)) {
            $this->request->data = $member;
//            Configure::write('debug', 2);
//            debug($this->request->data);
//            exit();
        }

        $memberrelations = $this->Member->Parentmember->Memberrelation->find("list", array("conditions"=>array("active"=>1)));
        $this->set("memberrelations", $memberrelations);
        $this->set("membertype", $membertype);
        $this->set("genders", $this->Member->gender);
        $this->set('identitytypes', $this->Member->Identitytype->find('list', array('conditions' => array('active' => true))));
    }



    public function payment(){

    }

    public function reissuecard($id = null)
    {
        $this->layout = "withoutmenu";

        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $error = false;
            $this->Member->begin();
            if (!$this->Member->saveAssociated($this->request->data, array("deep" => true))) {
                $error = configure::read("error_prefix") . "00064";
            }

            if ($error) {
                $this->Member->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試') . ' (' . $error . ')', 'default', array('class' => 'alert alert-danger'));
            } else {
                $this->Member->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                echo "<script>window.close();</script>";
            }
        } else {
            $options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
            $this->request->data = $this->Member->find('first', $options);
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
//        Configure::write('debug', 2);
        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->Member->Behaviors->load('Containable');

        $options = array(
            'conditions' => array(
                'Member.' . $this->Member->primaryKey => $id,
            ),
            'contain' => array(
                "Membertype",
                "Membership.Membertype",
                "Membershiprecord.User",
                "Membershiprecord.Membertype",
                "Membershiprecord.Membership",
                "Membershiprecord.Membershiprecordtype",
                "Identitytype",
                "Activity.Eventproposal",
                "Activity.Activityapplication"
            ),
        );
        $member = $this->Member->find('first', $options);

        $this->set('member', $member);
        $this->set("modal_title", $member['Member']['name']);

        $relationship = $this->Member->find('first', array(
            'conditions' => array(
                'Member.' . $this->Member->primaryKey => $id
            ),
            'contain' => array(
                'Parentmember.Parentmember.Membership.Membertype',
                'Parentmember.Memberrelation',
                'Childmember.Childmember',
                'Childmember.Memberrelation.Membership.Membertype'
            )
        ));

        foreach ($relationship['Parentmember'] as $key => $val) {
            $relationship['Parentmember'][$key]['Relatedmember'] = $val['Childmember'];
        }

        foreach ($relationship['Childmember'] as $key => $val) {
            $relationship['Childmember'][$key]['Relatedmember'] = $val['Parentmember'];
        }
//        Configure::write('debug', 2);
//        debug(array_merge($relationship['Parentmember'], $relationship['Childmember']));exit();
        $this->set('relationship', array_merge($relationship['Parentmember'], $relationship['Childmember']));
        $this->set("genders", $this->Member->gender);

        $layout = $this->Customlayout->get_struct_with_group(2);

        $this->set('layout', $layout);
        $custom_field = $this->Customfield->retrieve_from_model(14, $id);

        $this->set('custom_field', $custom_field);

    }

    public function view2($id = null)
    {
//        Configure::write('debug', 2);
        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->Member->Behaviors->load('Containable');

        $options = array(
            'conditions' => array(
                'Member.' . $this->Member->primaryKey => $id,
            ),
            'contain' => array(
                "Membertype",
                "Membership.Membertype",
                "Membershiprecord.Membertype",
                "Membershiprecord.Membership",
                "Membershiprecord.Membershiprecordtype",
                "Identitytype",
                "Activity.Eventproposal",
                "Activity.Activityapplication"
            ),
        );
        $member = $this->Member->find('first', $options);
//        Configure::write('debug', 2);
//        debug($member);exit();
        $this->set('member', $member);
        $this->set("modal_title", $member['Member']['name']);

        $relationship = $this->Member->find('first', array(
            'conditions' => array(
                'Member.' . $this->Member->primaryKey => $id
            ),
            'contain' => array(
                'Parentmember.Parentmember',
                'Parentmember.Memberrelation',
                'Childmember.Childmember',
                'Childmember.Memberrelation'
            )
        ));

        foreach ($relationship['Parentmember'] as $key => $val) {
            $relationship['Parentmember'][$key]['Relatedmember'] = $val['Childmember'];
        }

        foreach ($relationship['Childmember'] as $key => $val) {
            $relationship['Childmember'][$key]['Relatedmember'] = $val['Parentmember'];
        }

        $this->set('relationship', array_merge($relationship['Parentmember'], $relationship['Childmember']));
        $this->set("genders", $this->Member->gender);

        $custom_field = $this->Customfield->retrieve_from_model(14, $id);

        $this->set('custom_field', $custom_field);
    }

    public function newmembertype()
    {
//        Configure::write('debug', 2);
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Member']['membercard'])) {
                $membership = $this->Member->Membership->find("first", array(
                    "conditions" => array(
                        $this->Member->Membership->alias . ".membercard" => $this->request->data['Member']['membercard']
                    ),
                    ''
                ));
                if (!empty($membership)) {
                    $this->redirect(array('action' => 'add', $this->request->data['Member']['membertype_id'], $membership['Membership']['member_id']));
                } else {
                    unset($this->request->data);
                    $this->Session->setFlash(__('會員卡不正確'), 'default', array('class' => 'alert alert-warning'));
                }
            }else if (!empty($this->request->data['Member']['membercode'])) {
                $membership = $this->Member->Membership->find("first", array(
                    "conditions" => array(
                        $this->Member->Membership->alias . ".code" => $this->request->data['Member']['membercode']
                    ),
                    ''
                ));
                if (!empty($membership)) {
                    $this->redirect(array('action' => 'add', $this->request->data['Member']['membertype_id'], $membership['Membership']['member_id']));
                } else {
                    unset($this->request->data);
                    $this->Session->setFlash(__('會員號碼不正確'), 'default', array('class' => 'alert alert-warning'));
                }
            }

            else {
                $this->redirect(array('action' => 'add', $this->request->data['Member']['membertype_id']));
            }

        }

        $membertypes = $this->Member->Membership->Membertype->find("list", array("conditions"=>array("active"=>1)));

        $this->set("membertypes", $membertypes);
    }

    public function newmembertest()
    {
//

        if ($this->request->is(array('post', 'put'))) {
//            configure::write('debug',2);
//            debug($this->request->data);exit();
//
            foreach($this->request->data['Customtype'] as $cusfield){
                $rst = $this->Customfield->savecusfield_by_field_id($cusfield['field_id'], 3,$cusfield['value']);
                if(!$rst['success']){
                    $this->Session->setFlash($rst['errormsg'], 'default', array('class' => 'alert alert-danger'));
                    break;
                }
            }
        }
        $layout = $this->Customlayout->get_struct_with_group(1);

        $this->set('layout', $layout);

//        debug($fieldlist);exit();


    }

    public function test($id){



        configure::write('debug',2);
        $field = $this->Customfield->retrieve_value_by_alias(14, 4, 'member_cname');
        debug($field);
        exit();


    }

    public function editasnew($id = null)
    {

        $this->layout = "withoutmenu";
//        Configure::write('debug', 2);

        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $error = false;

            $this->Member->begin();
            if ($this->Member->saveAssociated($this->request->data, array("deep" => true))) {

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }

                if ($this->Member->Parentmember->deleteAll(array('Parentmember.member_parent' => $id), false)) {
                    foreach ($this->request->data['Parentmember'] as $relatedmember) {
                        if ($this->Member->Parentmember->create()) {
                            $error = configure::read("error_prefix") . "00058";
                        }
                        if (!$this->Member->Parentmember->save($relatedmember)) {
                            $error = configure::read("error_prefix") . "00059";
                        }
                    }
                } else {
                    $error = configure::read("error_prefix") . "00060";
                }
            } else {
                $error = configure::read("error_prefix") . "00061";
            }

            if ($error) {
                $this->Member->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試') . ' (' . $error . ')', 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Member->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                echo "<script>window.close();</script>";
            }

        } else {
            $options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
            $this->request->data = $this->Member->find('first', $options);
            $this->request->data['MemberCustomField'] = Set::combine($this->request->data['MemberCustomField'], '{n}.memberinputfield_id', "{n}");

        }
        $this->Member->MemberCustomField->Memberinputfield->Behaviors->load('Containable');
        $memberinputfields = $this->Member->MemberCustomField->Memberinputfield->find('all', array(
                'contain' => array(
                    'Inputtype' => array('fields' => array('htmltype', 'type')),
                    'Selectionlist',
                    'Selectionlist.Selectionitem'
                ),
                'order' => array('required' => 'DESC', 'order' => 'ASC')
            )
        );
        $memberinputfields = Set::combine($memberinputfields, '{n}.Memberinputfield.id', "{n}");
        $membertypes = $this->Member->Membertype->find('list', array("conditions" => array($this->Member->Membertype->alias . ".active" => 1)));
        $eventproposaltargets = $this->Member->Eventproposaltarget->find('list', array('conditions' => array('active' => true)));
        $this->set(compact('memberinputfields', 'membertypes', 'eventproposaltargets'));

        $this->Member->Behaviors->load('Containable');

        $relationship = $this->Member->find('first', array(
            'conditions' => array(
                'Member.' . $this->Member->primaryKey => $id
            ),
            'contain' => array(
                'Parentmember.Parentmember',
                'Parentmember.Memberrelation',
                'Childmember.Childmember',
                'Childmember.Memberrelation'
            )
        ));

        foreach ($relationship['Parentmember'] as $key => $val) {
            $relationship['Parentmember'][$key]['Relatedmember'] = $val['Childmember'];
        }

        foreach ($relationship['Childmember'] as $key => $val) {
            $relationship['Childmember'][$key]['Relatedmember'] = $val['Parentmember'];
        }

        $this->set('relationship', array_merge($relationship['Parentmember'], $relationship['Childmember']));
        $this->set('relations', $this->Member->Parentmember->Memberrelation->find('list', array('conditions' => array('active' => true))));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
//        Configure::write('debug', 2);
        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $error = false;

            $this->Member->begin();
            if ($this->Member->saveAssociated($this->request->data, array("deep" => true))) {

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }


            } else {
                $error = configure::read("error_prefix") . "00061";
            }

            foreach($this->request->data['Customtype'] as $cusfield){
                $rst = $this->Customfield->savecusfield_by_field_id($cusfield['field_id'], $this->request->data['Member']['id'],$cusfield['value']);
                if(!$rst['success']){
                    $error = true;
                    $this->Session->setFlash($rst['errormsg'], 'default', array('class' => 'alert alert-danger'));
                    break;
                }
            }


            if ($error) {
                $this->Member->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試') . ' (' . $error . ')', 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Member->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect($redirecturl);
            }

        } else {
            $options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
            $this->request->data = $this->Member->find('first', $options);
            $this->request->data['MemberCustomField'] = Set::combine($this->request->data['MemberCustomField'], '{n}.memberinputfield_id', "{n}");

        }
        $this->set("genders", $this->Member->gender);
        $this->set('identitytypes', $this->Member->Identitytype->find('list', array('conditions' => array('active' => true))));

        $layout = $this->Customlayout->get_struct_with_group(2);

        $this->set('layout', $layout);


        $custom_field = $this->Customfield->retrieve_from_model(14, $id);

        $this->set('custom_field', $custom_field);


    }

    public function edit2($id = null)
    {
        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {
//            Configure::write('debug', 2);
//        debug($this->request->data);exit();
            $error = false;

            $this->Member->begin();
            if ($this->Member->saveAssociated($this->request->data, array("deep" => true))) {

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }


            } else {
                $error = configure::read("error_prefix") . "00061";
            }

            foreach($this->request->data['Customtype'] as $cusfield){
                $rst = $this->Customfield->savecusfield_by_field_id($cusfield['field_id'], $this->request->data['Member']['id'],$cusfield['value']);
                if(!$rst['success']){
                    $this->Session->setFlash($rst['errormsg'], 'default', array('class' => 'alert alert-danger'));
                    break;
                }
            }


            if ($error) {
                $this->Member->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試') . ' (' . $error . ')', 'default', array('class' => 'alert alert-danger'));

            } else {
                $this->Member->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect($redirecturl);
            }

        } else {
            $options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
            $this->request->data = $this->Member->find('first', $options);
            $this->request->data['MemberCustomField'] = Set::combine($this->request->data['MemberCustomField'], '{n}.memberinputfield_id', "{n}");

        }
        $this->set("genders", $this->Member->gender);
        $this->set('identitytypes', $this->Member->Identitytype->find('list', array('conditions' => array('active' => true))));

        $layout = $this->Customlayout->get_struct_with_group(1);

        $this->set('layout', $layout);


        $custom_field = $this->Customfield->retrieve_from_model(14, $id);

        $this->set('custom_field', $custom_field);

    }

    public function advsearch()
    {
        $this->layout = "withoutmenu";
    }

    public function sendconfirmmail($id)
    {
        if (configure::read("member_username") == "email") {
            $this->autoRender = false;
            $this->Member->recursive = 0;
            $rs = $this->Member->find('first', array(
                    'conditions' => array(
                        'Member.id' => $id,
                        'Member.active' => 0
                    )
                )
            );
            if (!empty($rs)) {
                $hashstring = uniqid() . $this->Member->generatepassword(20);
                $this->Member->id = $rs['Member']['id'];
                if ($this->Member->saveField('hashstring', $hashstring)) {
                    $Email = new CakeEmail('default');
                    $Email->template('sendconfirmmail', 'membermail');
                    $Email->emailFormat('html');
                    $Email->subject("TESTING");
                    $Email->to($rs['Member']['username']);
                    $Email->helpers(array('Html'));
                    $Email->viewVars(array('hashstring' => $hashstring));
                    $Email->send();
                    echo "OK";
                }
            }
        }
    }

    public function sendresetpwdmail($id)
    {
        if (configure::read("member_username") == "email") {
            $this->autoRender = false;
            $this->Member->recursive = 0;
            $rs = $this->Member->find('first', array(
                    'conditions' => array(
                        'Member.id' => $id,
                        'Member.active' => 1
                    )
                )
            );
            if (!empty($rs)) {
                $this->Member->id = $rs['Member']['id'];
                $verifystring = md5(uniqid(rand()));
                $this->Member->id = $rs['Member']['id'];
                if ($this->Member->saveField('resetpwd_hashstring', $verifystring)) {
                    $Email = new CakeEmail('default');
                    $Email->template('sendresetpwdmail', 'membermail');
                    $Email->emailFormat('html');
                    $Email->subject("TESTING");
                    $Email->to($rs['Member']['username']);
                    $Email->helpers(array('Html'));
                    $Email->viewVars(array('hashstring' => $verifystring));
                    $Email->send();
                    echo "OK";
                }
            }
        }
    }

    public function addrelation($id = null){
        $this->Member->id = $id;
        if (!$this->Member->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $member = $this->Member->find('first', array(
            "conditions"=>array(
                "Member.id"=>$id,
            ),
            "fields"=>array(
                "displayname"
            )
        ));

        if ($this->request->is(array('post', 'put'))) {
            if($this->Member->Parentmember->saverelation($id, $this->request->data['Member']['member_child'], $this->request->data['Member']['relationship_id'])){
                $this->Session->setFlash(__('新增成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('action' => 'view', $id));
            }else{
                $this->Session->setFlash(__('新增關係失敗'), 'default', array('class' => 'alert alert-warning'));
            }
        }

        $memberrelations = $this->Member->Parentmember->Memberrelation->find("list", array("conditions"=>array("active"=>1)));
        $this->set("memberrelations", $memberrelations);
        $this->set("member", $member);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Member->id = $id;
        if (!$this->Member->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Member->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function changeinvalid($id = null)
    {

        if (!$this->Member->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
//            Configure::write('debug',2);
            $this->Member->id = $id;
            $member = $this->Member->read();

            $member['Member']['valid'] = false;
            $member['Member']['membershipdate'] = date("Y-m-d");
            $member['Member']['last_memberapplication_id'] = 0;


            if ($this->Member->save($member)) {
                $this->Session->setFlash(__('成功退會'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class' => 'alert alert-danger'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function changeactive()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $msg = array('result' => false);
        if ($this->request->is('post') || $this->request->is('put')) {
            $id = $this->request->data['member_id'];
            $active = $this->request->data['active'];
            if (!$this->Member->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->Member->id = $id;
            if ($this->Member->saveField('active', $active)) {
                $msg = array('result' => true, 'active' => $active, 'posted' => $this->request->data);
            }
        }

        echo json_encode($msg);
    }

    public function checkinfo_extend()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');

        $result = "success";

        $options = array(
            'recursive' => -1,
            'conditions' => array(
                'Member.code' => $this->request->data['code']
            )
        );

        $member = $this->Member->find('first', $options);

        $relationship = $this->Member->find('first', array(
            'conditions' => array(
                'Member.id' => $member['Member']['id']
            ),
            'contain' => array(
                'Parentmember.Parentmember' => array(
                    'conditions' => array(
                        'Parentmember.id' => $this->request->data['mainmember_id']
                    )
                ),
                'Parentmember.Memberrelation',
                'Childmember.Childmember' => array(
                    'conditions' => array(
                        'Childmember.id' => $this->request->data['mainmember_id']
                    )
                ),
                'Childmember.Memberrelation'
            )
        ));

        foreach ($relationship['Parentmember'] as $key => $val) {
            $relationship['Parentmember'][$key]['Relatedmember'] = $val['Childmember'];
        }

        foreach ($relationship['Childmember'] as $key => $val) {
            $relationship['Childmember'][$key]['Relatedmember'] = $val['Parentmember'];
        }

        if (empty($member)) {
            $result = "找不到會員資料";
            $response = array(
                "status" => $result,
                "member" => $member,
            );
            echo json_encode($response);
            return;
        }

//        $membership_renew_days = configure::read("membership_renew_days");
//        $caltime = strtotime("+".$membership_renew_days.'days');
//        $beforetimesp = strtotime(date("Y-m-d",$caltime));
//        if($beforetimesp < strtotime($member['Member']['membershipdate'])){
//            $result = __('會籍到期日是'.$member['Member']['membershipdate']."。還未能續期。");
//        }

//        if (!($member['Member']['valid'])) {
//            $result = __('無效會員');
//        }

        $response = array(
            "status" => $result,
            "member" => $member,
            "relationship" => array_merge($relationship['Parentmember'], $relationship['Childmember'])
        );
        echo json_encode($response);
    }

    public function ajax_matching()
    {

        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg = "";

        if ($this->request->is('post') || $this->request->is('put')) {
//            configure::write('debug',2);

            $from_age = trim($this->request->data['Member']['from_age']);
            $to_age = trim($this->request->data['Member']['to_age']);
            $idle_period = trim($this->request->data['Member']['idle_period']);
            $membertypes = $this->request->data['Member']['membertype'];
            $eventproposaltargets = $this->request->data['Member']['eventproposaltarget'];
            $gender = $this->request->data['Member']['gender'];
            $educationlevel = $this->request->data['Member']['educationlevel'];
            $employmentstatus = $this->request->data['Member']['employmentstatus'];
            $district = $this->request->data['Member']['district'];


//            echo json_encode($eventproposaltargets);exit();


            $this->Member->virtualFields = array(
                'age' => '(PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT(' . $this->Member->alias . '.dob, "%Y%m") )) DIV 12',
            );

            //If month_ago less idle period, activity will be retrieve, which means during the desired idle period, the member participated in at least one activity
            $this->Member->Activity->virtualFields = array(
                'month_ago' => '(PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT(' . $this->Member->Activity->alias . '.enddate, "%Y%m") )) MOD 12',
            );

            if (empty($from_age) && empty($to_age) && empty($idle_period) && empty($membertypes) && empty($eventproposaltargets) && empty($gender) && empty($educationlevel) && empty($employmentstatus) && empty($district)) {
                $errormsg = "必須至少填寫其中一個條件";
            } else {
                $condition_member = array();
                $condition_activity = array();
                $condition_eventproposaltarget = array();


                //conditions for Eventproposaltarget
                if (!empty($eventproposaltargets)) {
                    $condition_member['AND'][$this->Member->alias . ".eventproposaltarget_id"] = $eventproposaltargets;
                }

                if (!empty($employmentstatus)) {
                    $condition_member['AND'][$this->Member->alias . ".employmentstatus_id"] = $employmentstatus;
                }

                if (!empty($district)) {
                    $condition_member['AND'][$this->Member->alias . ".district_id"] = $district;
                }


                //conditions for Member
                if (!empty($membertypes)) {
                    foreach ($membertypes as $membertype) {
                        $condition_member['AND']['OR'][][$this->Member->alias . '.membertype_id'] = $membertype;
                    }
                }

                $condition_member['AND'][$this->Member->alias . '.active'] = true;
                $condition_member['AND'][$this->Member->alias . '.valid'] = true;

                if (!empty($from_age)) {
                    $condition_member['AND'][$this->Member->alias . ".age >="] = $from_age;
                }
                if (!empty($to_age)) {
                    $condition_member['AND'][$this->Member->alias . ".age <="] = $to_age;
                }

                if (!empty($gender)) {
                    $condition_member['AND'][$this->Member->alias . ".gender_id"] = $gender;
                }

                if (!empty($eeducationlevel)) {
                    $condition_member['AND'][$this->Member->alias . ".educationlevel_id"] = $educationlevel;
                }


                //conditions for Activity
                if (!empty($idle_period)) {
                    $condition_activity['AND']['((PERIOD_DIFF( DATE_FORMAT(CURDATE(), "%Y%m") , DATE_FORMAT(Activity.enddate, "%Y%m") )) MOD 12) <='] = $idle_period;
                }

                if (!(empty($condition_member) && empty($condition_activity) && empty($condition_eventproposaltarget))) {
                    $this->Member->Behaviors->load('Containable');
                    $serachresult = $this->Member->find("all", array(
                        "conditions" => $condition_member,
                        "contain" => array(
//                            "Eventproposaltarget" => array(
//                                "conditions" => $condition_eventproposaltarget
//                            ),
                            "MemberCustomField.Memberinputfield",
                            "Activity" => array(
                                "conditions" => $condition_activity,
                                "fields" => array("month_ago"),
                            )
                        ),
                        'limit'=>20

                    ));

                    if (!empty($serachresult)) {
                        foreach ($serachresult as $key => $val) {
                            $serachresult[$key]['Member']['hkid'] = substr($serachresult[$key]['Member']['hkid'], 0, -4) . 'xxxx';
                            $serachresult[$key]['MemberCustomField'] = Set::combine($serachresult[$key]['MemberCustomField'], '{n}.Memberinputfield.id', "{n}");
                            if (!empty($idle_period)) {
                                if ($serachresult[$key]['Activity'] != null) {
                                    continue;
                                }
                            }
//                            if (!empty($eventproposaltargets)) {
//                                if ($serachresult[$key]['Eventproposaltarget'] == null) {
//                                    continue;
//                                }
//                            }

                            $result[] = $serachresult[$key];
                        }
                    }
                }

                if (empty($result)) {
                    $errormsg = "沒有記錄";
                }
            }

            echo json_encode(
                array(
                    "result" => $result,
                    "errormsg" => $errormsg
                )
            );
        }
    }

//需要整張FORM 連token post過來
    public function ajax_checkinfo()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg = "";

        if ($this->request->is('post') || $this->request->is('put')) {
            $membercard = trim($this->request->data['Member']['membercard']);
            $code = trim($this->request->data['Member']['code']);
            $c_name = trim($this->request->data['Member']['c_name']);
            $e_name = trim($this->request->data['Member']['e_name']);
            $phone_main = trim($this->request->data['Member']['phone_main']);
            $identity = trim(strtoupper($this->request->data['Member']['identity']));
            if (!empty($identity)) {
                $identityhash = $this->Member->datahash($identity);
            }


            if (empty($c_name) && empty($e_name) && empty($phone_main) && empty($identityhash) && empty($code) && empty($membercard)) {
                $errormsg = "必須至少填寫其中一個條件";
            } else {
                $conditions = array();
                if (!empty($membercard)) {
                    $conditions['AND'][$this->Member->alias . ".membercard"] = $membercard;
                }
                if (!empty($c_name)) {
                    $conditions['AND'][$this->Member->alias . ".c_name LIKE"] = "%" . $c_name . "%";
                }
                if (!empty($e_name)) {
                    $conditions['AND'][$this->Member->alias . ".e_name LIKE"] = "%" . $e_name . "%";
                }
                if (!empty($identityhash)) {
                    $conditions['OR'][$this->Member->alias . ".identityhash"] = $identityhash;
                }
                if (!empty($code)) {
                    $conditions['AND'][$this->Member->alias . ".code"] = $code;
                }
                if (!empty($conditions)) {
                    $this->Member->recursive = -1;
                    $serachresult = $this->Member->find("all", array(
                        "conditions" => $conditions,
                        'fields' => array(
                            "id", "code", "e_name", "c_name", "identity"
                        ),
                        "contain" => array(
                            "MemberCustomField"
                        )
                    ));

                    if (!empty($serachresult)) {
                        foreach ($serachresult as $key => $val) {
//                                $serachresult[$key]['Member']['hkid'] = substr($serachresult[$key]['Member']['hkid'], 0, -4) . 'xxxx';
                            $result[$serachresult[$key]['Member']['id']]['Member'] = $serachresult[$key]['Member'];
                        }
                    }
                }
                if (!empty($phone_main)) {
                    $conditions['AND'] = array(
                        'MemberCustomField.memberinputfield_id' => configure::read("Memberinputfield.phone_main_index"),
                        'MemberCustomField.value' => $phone_main
                    );

                    $serachresult = $this->Member->MemberCustomField->find("all", array(
                        "conditions" => array(
                            $conditions
                        ),
                        "fields" => array(
                            "DISTINCT Member.id", "Member.code", "Member.e_name", "Member.c_name", "Member.identity"
                        )
                    ));
                    if (!empty($serachresult)) {
                        foreach ($serachresult as $key => $val) {
//                                $serachresult[$key]['Member']['hkid'] = substr($serachresult[$key]['Member']['hkid'], 0, -4) . 'xxxx';
                            $result[$serachresult[$key]['Member']['id']]['Member'] = $serachresult[$key]['Member'];
                        }
                    }
                }
                if (empty($result)) {
                    $errormsg = "沒有記錄";
                }
            }

            echo json_encode(
                array(
                    "result" => $result,
                    "errormsg" => $errormsg
                )
            );
        }
    }

    public function ajax_checkidentity(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        if($this->request->is('post') || $this->request->is('put')) {
            $hkid = trim(strtoupper($this->request->data['hkid']));

            if (!preg_match('/^[a-zA-Z]{1,2}\d{6}\([0-9a-zAZ-Z]\)$/', $hkid))
            {
                echo json_encode(false);;
            }
            else{
                App::import('Vendor', 'hkid');
                $obj_hkid = new HKID();
                $obj_hkid->set($hkid);

                if(!$obj_hkid->validate()){
                    echo json_encode(false);;
                }else{
                    echo json_encode(true);
                }
            }

        }
    }

    public function export(){
        if($this->request->is('post') || $this->request->is('put')) {
ini_set('memory_limit', '51200M');
            ini_set('max_execution_time', 1000);
//            Configure::write('debug', 2);
            $this->MemberComponent = $this->Components->load(Configure::read("Member.Component"));
            $this->MemberComponent->initialize($this);

            $this->view = "export_xsl";

            $start = $this->request->data['Member']['start'];
            $end = $this->request->data['Member']['end'];

            $this->MemberComponent->start = $start;
            $this->MemberComponent->end = $end;
            $this->MemberComponent->export();

            $xlsxdata = $this->MemberComponent->xlsxdata;


            $this->set(compact("start","end",'xlsxdata'));
            $this->response->type(array('xls' => 'application/vnd.ms-excel'));
            $this->response->type('xls');
        }
    }

    public function exportaddrlabel(){
        if($this->request->is('post') || $this->request->is('put')) {
ini_set('memory_limit', '51200M');
            ini_set('max_execution_time', 1000);
//            Configure::write('debug', 2);
            $this->MemberComponent = $this->Components->load(Configure::read("Member.Component"));
            $this->MemberComponent->initialize($this);

            if($this->request->data['Member']['noadvertise']){
                $this->MemberComponent->cus_conditions = array(
                    $this->Member->alias.".noadvertise"=>1,
                );
            }

            $this->view = "export_xsl";

            $start = $this->request->data['Member']['start'];
            $end = $this->request->data['Member']['end'];

            $this->MemberComponent->start = $start;
            $this->MemberComponent->end = $end;
            $this->MemberComponent->exportaddrlabel();

            $xlsxdata = $this->MemberComponent->xlsxdata;

            $filename = "address_label";


            $this->set(compact("start","end",'xlsxdata', 'filename'));
            $this->response->type(array('xls' => 'application/vnd.ms-excel'));
            $this->response->type('xls');
        }
    }

    public function ajax_list(){

        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $output = array();

        $options = array();

        $input =& $_GET;

// Number of columns being displayed (useful for getting individual column search info)
        $iColumns = $input['iColumns'];

// Get mDataProp values assigned for each table column
        $dataProps = array();
        for ($i = 0; $i < $iColumns; $i++) {
            $var = 'mDataProp_'.$i;
            if (!empty($input[$var]) && $input[$var] != 'null') {
                $dataProps[$i] = $input[$var];
//                $options['fields'][] = $input[$var];
            }
        }


        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];

            $options['conditions']['OR']["Member.c_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Member.e_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Member.code LIKE"] = '%' . $input['sSearch'] . '%';
        }

        /**
         * Ordering
         */
        if ( isset($input['iSortCol_0']) ) {
            $sort_fields = array();
            for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
                if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
                    $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];

                    $order = ( $input['sSortDir_'.$i]=='desc' ? "DESC" : "ASC" );


                    if($field == "code_type"){
                        $options['order'][] = array('Member.membertype_id'=>$order);
                        $options['order'][] = array('Member.code'=>$order);
                    }else if($field == "c_name"){
                        $options['order'][] = array('Member.c_name'=>$order);
                    }else if($field == "membershipdate"){
                        $options['order'][] = array('Member.membershipdate'=>$order);
                    }else if($field == "modified"){
                        $options['order'][] = array('Member.modified'=>$order);
                    }else if($field == "status"){
                        $options['order'][] = array('Member.valid'=>$order);
                        $options['order'][] = array('Member.active'=>$order);
                    }
                }
            }
        }

        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['limit'] = $input['iDisplayLength'];
            $options['offset'] = $input['iDisplayStart'];
        }

        //Filter
        if(!empty($input['status'])){
            if($input['status'] == 1){
                $options['conditions']['Member.valid'] = 0;
            }else if($input['status'] == 2){
                $options['conditions']['Member.valid'] = 1;
                $options['conditions']['Member.active'] = 0;
            }else{
                $options['conditions']['Member.valid'] = 1;
                $options['conditions']['Member.active'] = 1;
            }
        }

        if(!empty($input['membertype'])){

            $options['conditions']['Member.membertype_id'] = $input['membertype'];
        }

        if(!empty($input['filter'])){

            foreach($input['filter'] as $k=>$filter){
                $options['conditions']['Member.'.$k." LIKE"] = '%' . $filter . '%';
            }

        }

        $this->loadModel('Dbmodel');
        $this->Dbmodel->Behaviors->load('Containable');
        $model = $this->Dbmodel->find('first',array(
            'conditions'=>array(
                'Dbmodel.name'=>$this->Member->alias,
            ),
            'contain'=>array(
                'Dbfield'=>array(
                    'conditions'=>array(
//                        'Dbfield.sync'=>1,
                        'Dbfield.connected'=>1,
//                        'Dbfield.default_filter'=>1
                    ),
                    'order'=>array(
                        'Dbfield.order'=>'ASC'
                    )
                ),
                'Dbfield.Dbfielddropdown'=>array(
                    'order'=>array(
                        'Dbfielddropdown.order'=>'ASC'
                    )
                )
            )
        ));

        foreach($model['Dbfield'] as $field){
            if(!empty($input[$field['db_field']])) {

                if ($field['is_dropdown']) {
                    $options['conditions']['Member.' . $field['db_field']] = $input[$field['db_field']];
                } else {
                    $options['conditions']['Member.' . $field['db_field'] . " LIKE"] = "%" . $input[$field['db_field']] . "%";
                }
            }
        }




        $struct = $this->Dbmodel->get_struct(14);

        $search_member = array();
        foreach($struct as $field){
            if(!empty($input[$field['alias']])) {
                $search_member[] = $this->Dbmodel->Customfield->searchcusfield_by_alias(14, $field['alias'], $input[$field['alias']]);
            }
        }

        if(!empty($search_member)){
            $members = $search_member[0];
            foreach($search_member as $search){
                $members = array_intersect($members, $search);
            }

            $options['conditions']['Member.id'] = $members;

        }




        $this->Member->Behaviors->load('Containable');
        $options['contain'] = array(
            "Membership.Membertype",
        );


        $result = $this->Member->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Member->find('count',$options);
        $all_count = $this->Member->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        foreach ( $result as $doc ) {
            $doc['Memberoutput'] = array();
            $doc['Memberoutput']['id'] = $doc['Member']['id'];
            $doc['Memberoutput']['c_name'] = $doc['Member']['c_name'];
            $doc['Memberoutput']['e_name'] = $doc['Member']['e_name'];

            $doc['Memberoutput']['displayname'] = $doc['Member']['displayname'];
            $doc['Memberoutput']['identity'] = $doc['Member']['identity'];
            $doc['Memberoutput']['contact_tel_home'] = $doc['Member']['contact_tel_home'];
            $doc['Memberoutput']['contact_tel_mobile'] = $doc['Member']['contact_tel_mobile'];
            $doc['Memberoutput']['gender'] = $this->Member->gender[$doc['Member']['gender']];

            $doc['Memberoutput']['membership'] = "";
            foreach($doc['Membership'] as $ms){
                if(!$ms['expired']){
                    $doc['Memberoutput']['membership'] .=  ' <span class="'.$ms['Membertype']['labelclass'].'">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                }else{
                    $doc['Memberoutput']['membership'] .=  ' <span class="label label-danger">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                }

            }


            if (!$doc['Member']['valid']) {
                $doc['Memberoutput']['status'] = "無效";
            } else {
                $doc['Memberoutput']['status'] = "有效";
            }
            $doc['Memberoutput']['modified'] = $doc['Member']['modified']."<br>".$doc['User']['name'];

            $doc['Memberoutput']['action'] = "";

            App::import('Helper', 'Html');
            $html = new HtmlHelper(new View());
            App::import('Helper','Form');
            $form = new FormHelper(new View());

//            $doc['Memberoutput']['action'] = $html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-eye"></i></button>', array('action' => 'view', $doc['Member']['id'], 'ajax' => true), array('class' => ' modalbtn', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#modal'));

            $doc['Memberoutput']['action'] = " ".$html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $doc['Member']['id']), array('class' => '', 'escape' => false));

            $doc['Memberoutput']['action'] .= " ".$html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $doc['Member']['id']), array('class' => 'btn btn-sm btn-warning', 'escape' => false));

            //$doc['Memberoutput']['action'] .= " ".$html->link('<button class="btn btn-sm btn-success" style="width: 32px;"><i class="fa fa-wifi"></i></button>', array('action' => 'reissuecard', $doc['Member']['id']), array("class" => 'openasnew', 'escape' => false));

            if ($doc['Member']['valid'] && $doc['Member']['active']) {
                $doc['Memberoutput']['action'] .= " ".$form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-dot-circle-o"></i></button>', array('action' => 'changeinvalid', $doc['Member']['id']), array('escape' => false), __('確定要退會嗎?'));
            }

            $output['aaData'][] = $doc['Memberoutput'];
        }

        echo json_encode( $output );
    }

    public function ajax_newmembershiplist(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $output = array();

        $options = array();

        $input =& $_GET;

// Number of columns being displayed (useful for getting individual column search info)
        $iColumns = $input['iColumns'];

// Get mDataProp values assigned for each table column
        $dataProps = array();
        for ($i = 0; $i < $iColumns; $i++) {
            $var = 'mDataProp_'.$i;
            if (!empty($input[$var]) && $input[$var] != 'null') {
                $dataProps[$i] = $input[$var];
//                $options['fields'][] = $input[$var];
            }
        }


        if ( !empty($input['sSearch']) ) {
            $sSearch = $input['sSearch'];

            $options['conditions']['OR']["Member.c_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Member.e_name LIKE"] = '%' . $input['sSearch'] . '%';
            $options['conditions']['OR']["Member.code LIKE"] = '%' . $input['sSearch'] . '%';
        }

        /**
         * Ordering
         */
        if ( isset($input['iSortCol_0']) ) {
            $sort_fields = array();
            for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
                if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
                    $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];

                    $order = ( $input['sSortDir_'.$i]=='desc' ? "DESC" : "ASC" );


                    if($field == "displayname"){
                        $options['order'][] = array('Member.displayname'=>$order);
                    }else if($field == "gender"){
                        $options['order'][] = array('Member.gender'=>$order);
                    }else if($field == "membershipdate"){
                        $options['order'][] = array('Member.membershipdate'=>$order);
                    }else if($field == "modified"){
                        $options['order'][] = array('Member.modified'=>$order);
                    }else if($field == "status"){
                        $options['order'][] = array('Member.valid'=>$order);
                        $options['order'][] = array('Member.active'=>$order);
                    }
                }
            }
        }

        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['limit'] = $input['iDisplayLength'];
            $options['offset'] = $input['iDisplayStart'];
        }

        //Filter
        if(!empty($input['code'])){
            $codefilter_ids = $this->Member->Membership->find("list", array(
                "conditions"=>array(
                    "Membership.code Like"=>"%".trim($input['code'])."%"
                ),
                "fields"=>array("member_id", "member_id")
            ));
            $options['conditions']['Member.id'] = $codefilter_ids;
        }

        if(!empty($input['identity'])){
            $options['conditions']['identityhashkey Like'] = "%".$this->Member->datahash(strtoupper(trim($input['identity'])))."%";
        }

        if(!empty($input['name'])){
            $options['conditions']['Member.displayname Like'] = "%".trim($input['name'])."%";
        }

        if(!empty($input['tel'])){
            $options['conditions']['AND']['OR']['Member.contact_tel_home Like'] = "%".trim($input['tel'])."%";
            $options['conditions']['AND']['OR']['Member.contact_tel_mobile Like'] = "%".trim($input['tel'])."%";
        }

        if(!empty($input['membercard'])){
            $codefilter_ids = $this->Member->Membership->find("list", array(
                "conditions"=>array(
                    "Membership.membercard"=>trim($input['membercard'])
                ),
                "fields"=>array("member_id", "member_id")
            ));
            if(!empty($options['conditions']['Member.id'])){
                $options['conditions']['Member.id'] = array_merge($options['conditions']['Member.id'], $codefilter_ids);
            }else{
                $options['conditions']['Member.id'] = $codefilter_ids;
            }

        }

        $this->Member->Behaviors->load('Containable');
        $options['contain'] = array(
            "Membership.Membertype",
        );


        $result = $this->Member->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Member->find('count',$options);
        $all_count = $this->Member->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        foreach ( $result as $doc ) {
            $doc['Memberoutput'] = array();
            $doc['Memberoutput']['id'] = $doc['Member']['id'];
            $doc['Memberoutput']['displayname'] = $doc['Member']['displayname'];
            $doc['Memberoutput']['identity'] = $doc['Member']['identity'];
            $doc['Memberoutput']['contact_tel_home'] = $doc['Member']['contact_tel_home'];
            $doc['Memberoutput']['contact_tel_mobile'] = $doc['Member']['contact_tel_mobile'];
            $doc['Memberoutput']['gender'] = $this->Member->gender[$doc['Member']['gender']];

            $doc['Memberoutput']['membership'] = "<span class='membershiplabel'>";
            foreach($doc['Membership'] as $ms){
                if(!$ms['expired']){
                    $doc['Memberoutput']['membership'] .=  ' <span class="'.$ms['Membertype']['labelclass'].'">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                }else{
                    $doc['Memberoutput']['membership'] .=  ' <span class="label label-danger">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                }

            }
            $doc['Memberoutput']['membership'] .= "</span>";


            if (!$doc['Member']['valid']) {
                $doc['Memberoutput']['status'] = "無效";
            } else {
                $doc['Memberoutput']['status'] = "有效";
            }
            $doc['Memberoutput']['modified'] = $doc['Member']['modified']."<br>".$doc['User']['name'];

            $doc['Memberoutput']['action'] = "";

            App::import('Helper', 'Html');
            $html = new HtmlHelper(new View());
            App::import('Helper','Form');
            $form = new FormHelper(new View());


            $doc['Memberoutput']['action'] = " ".$html->link('<button class="btn btn-info btn-sm">選擇</button>', "javascript:void(0)", array('class' =>'selectmember', 'data-identity'=>h($doc['Member']['identity']), 'data-displayname'=>h($doc['Member']['displayname']), 'data-mid'=>$doc['Member']['id'], 'escape' => false));


            $output['aaData'][] = $doc['Memberoutput'];
        }

        echo json_encode( $output );
    }


    public function beforeFilter()
    {

        $this->Auth->allow('test1');
        if ($this->request['action'] == 'sendconfirmmail' || $this->request['action'] == 'sendresetpwdmail') {
            $this->allowtoken();
            $this->Security->unlockedActions[] = 'sendresetpwdmail';
            $this->Security->unlockedActions[] = 'sendconfirmmail';
        }
        if ($this->request['action'] == 'ajax_checkinfo') {
            $this->Security->csrfUseOnce = false;
        }
        if ($this->request['action'] == 'ajax_matching') {
            $this->Security->csrfUseOnce = false;
        }
        if ($this->request['action'] == 'newmemberfamily') {
            $this->Security->unlockedFields = array('ExistingMember');
        }
        if ($this->request['action'] == 'extendindividual') {
            $this->Security->unlockedFields = array('Member.Member' ,"Member.membershipdate");
        }
        if ($this->request['action'] == 'extendfamily') {
            $this->Security->unlockedFields = array('Member.Member' ,"Member.membershipdate" ,"Parentmember", "Membership");
        }
        if ($this->request['action'] == 'edit') {
            $this->Security->unlockedFields = array('Parentmember');
        }
        $this->Security->unlockedActions[] = 'export';
        $this->Security->unlockedActions[] = 'exportaddrlabel';
        $this->Security->unlockedActions[] = 'checkinfo_extend';
        $this->Security->unlockedActions[] = 'ajax_checkidentity';
        $this->Security->unlockedActions[] = 'changeactive';
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }

}
