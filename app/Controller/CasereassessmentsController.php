<?php
App::uses('AppController', 'Controller');


class CasereassessmentsController extends AppController
{
    public $components = array('Paginator', 'Search.Prg');

    public function view($id){
        if (!$this->Casereassessment->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $form = $this->Casereassessment->find("first", array(
                "conditions"=>array(
                    $this->Casereassessment->alias.".id"=>$id
                )
        ));
        $this->set("form", $form);
    }

    public function delete($id = null) {
//        Configure::write('debug',2);
        $this->Casereassessment->id = $id;

        $form = $this->Casereassessment->findById($id);

        if (!$this->Casereassessment->exists()) {
            throw new NotFoundException(__('Invalid Casereassessment'));
        }
        $this->Casereassessment->begin();
//        $this->request->allowMethod('post', 'delete');
        if ($this->Casereassessment->delete()) {

            $this->Casereassessment->Casemanagementform->id = $form['Casemanagementform']['id'];
            if($this->Casereassessment->Casemanagementform->exists()){
                if($this->Casereassessment->Casemanagementform->delete()){
                    $this->Casereassessment->commit();
                    $this->Session->setFlash(__('成功刪除會面記錄'), 'default', array('class'=>'alert alert-success'));
                }
            }


        } else {
            $this->Session->setFlash(__('刪除會面記錄不成功'), 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array("controller" => "Casemanagements", "action" => "view", $form['Casemanagementform']['casemanagement_id']));
    }

    public function addtype(){

    }

    public function add($case_id=null){


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

            $error = false;
            $this->Casereassessment->begin();
            $this->Casereassessment->create();

            $this->request->data['Casereassessment']['Casemanagementform'] = '';
            $this->request->data['Casemanagementform']['casemanagement_id'] = $case_id;
            $this->request->data['Casemanagementform']['form_type'] = $this->Casereassessment->alias;
            $this->request->data['Casemanagementform']['form_controller'] = $this->name;
            $this->request->data['Casemanagementform']['form_date'] = $this->request->data['Casereassessment']['date'];
            $this->request->data['Casemanagementform']['form_name'] = $this->Casereassessment->form_name;

            if(!$this->Casereassessment->saveAll($this->request->data, array("deep" => true))){
                $error = true;
            }
            if(!$this->Casereassessment->Casemanagementform->saveField('form_id', $this->Casereassessment->id)){
                $error = true;
            }

            $this->Casemanagement->id = $case_id;
            if(!$this->Casemanagement->saveField('casenature_id', $this->request->data['Casereassessment']['casenature_id'])){
                $error = true;
            }
            if(!$this->Casemanagement->saveField('casetype_id', $this->request->data['Casereassessment']['casetype_id'])){
                $error = true;
            }

            if($this->request->data['Casereassessment']['nextreviewdate']){
                if(!$this->Casemanagement->saveField('nextreviewdate', $this->request->data['Casereassessment']['nextreviewdate'])){
                    $error = true;
                }
            }

            if(!$error){
                $this->Casereassessment->commit();
                $this->Session->setFlash(__('新增個案評估成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));
            }else{
                $this->Casereassessment->rollback();
                $this->Session->setFlash(__('新增個案評估失敗'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));
            }


        }

        $this->set('casenatures', $this->Casemanagement->Casenature->find('list', array('conditions' => array('active' => 1))));
        $casenature_list = $this->Casemanagement->Casenature->find('all', array('conditions' => array('active' => 1)));
        $casenature_list = Set::combine($casenature_list, "{n}.Casenature.id","{n}.Casenature");
        foreach($casenature_list as $k=>$list){
            if($list['nextreview']){
                $casenature_list[$k]['nextreview'] = date('Y-m-d',strtotime('now + '.$list['nextreview']));
            }
        }

        $this->set('casenatures_list', $casenature_list);
        $this->set('casetypes', $this->Casemanagement->Casetype->find('list', array('conditions' => array('active' => 1))));
        $this->set('case_id', $case_id);
        $this->set('case', $case);
        $this->set(compact("types"));
    }

    public function beforeFilter(){
        parent::beforeFilter();
        $this->loadModel('Casemanagement');

    }

}