<?php
App::uses('AppController', 'Controller');


class CaseenquiryformsController extends AppController
{
    public $components = array('Paginator', 'Search.Prg');


    public function view($id){
//        Configure::write('debug',2);
        if (!$this->Casereferralform->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $form = $this->Casereferralform->find("first", array(
            array(
                "conditions"=>array(
                    "Casereferralform.id"=>$id
                )
            )
        ));

        $this->set("form", $form);
    }

    public function addtype(){

    }

    public function delete($id = null) {
        $this->Casereferralform->id = $id;

        $form = $this->Casereferralform->read(null,$id);

        if (!$this->Casereferralform->exists()) {
            throw new NotFoundException(__('Invalid Casereferralform'));
        }
//        $this->request->allowMethod('post', 'delete');
        if ($this->Casereferralform->delete()) {

            $this->Casereferralform->Casemanagementform->id = $form['Casemanagementform']['id'];
            if($this->Casereferralform->Casemanagementform->exists()){
                $this->Casereferralform->Casemanagementform->delete();
            }
            $this->Session->setFlash(__('成功刪除會面記錄'), 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash(__('刪除會面記錄不成功'), 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array("controller" => "Casemanagements", "action" => "view", $form['Casemanagementform']['casemanagement_id']));
    }

    public function add($case_id=null){
//        Configure::write('debug',2);
        if (!$this->Casemanagement->exists($case_id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Casemanagement->id = $case_id;
        $case = $this->Casemanagement->find('first',array(
            'conditions'=>array(
                'Casemanagement.id'=>$case_id
            ),
            'recursive'=>-1
        ));

        if ($this->request->is(array('post', 'put'))) {

            $this->Caseenquiryform->create();

            $this->request->data['Caseenquiryform']['Casemanagementform'] = '';
            $this->request->data['Casemanagementform']['casemanagement_id'] = $case_id;
            $this->request->data['Casemanagementform']['form_type'] = $this->Caseenquiryform->alias;
            $this->request->data['Casemanagementform']['form_controller'] = $this->name;
            $this->request->data['Casemanagementform']['form_date'] = $this->request->data['Caseenquiryform']['date'];
            $this->request->data['Casemanagementform']['form_name'] = $this->Caseenquiryform->form_name;

            $this->Caseenquiryform->saveAll($this->request->data, array("deep" => true));
            $this->Caseenquiryform->Casemanagementform->saveField('form_id', $this->Caseenquiryform->id);

            $this->Session->setFlash(__('成功新增個案諮詢記錄'), 'default', array('class' => 'alert alert-success'));
            $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));
        }

        $types = $this->Casereferralform->interview_type;

        $this->set('case_id', $case_id);
        $this->set('case', $case);
        $this->set(compact("types"));
    }

    function edit($case_id, $id=null){

        if (!$this->Casemanagement->exists($case_id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if (!$this->Caseenquiryform->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if($this->Caseenquiryform->save($this->request->data)){
                $this->Session->setFlash(__('成功更新個案諮詢記錄'), 'default', array('class'=>'alert alert-success'));
            }else{
                $this->Session->setFlash(__('更新個案諮詢記錄不成功'), 'default', array('class'=>'alert alert-danger'));
            }
            return $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));

        }else{
            $this->request->data = $this->Caseenquiryform->find('first',array(
                'conditions'=>array(
                    'Caseenquiryform.id'=>$id
                ),
                'recursive'=>-1
            ));
        }

        $case = $this->Casemanagement->find('first',array(
            'conditions'=>array(
                'Casemanagement.id'=>$case_id
            ),
            'recursive'=>-1
        ));

        $this->set('case', $case);


    }

    public function beforeFilter(){
        $this->loadModel('Casemanagement');

    }

}