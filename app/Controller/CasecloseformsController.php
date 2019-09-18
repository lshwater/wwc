<?php
App::uses('AppController', 'Controller');


class CasecloseformsController extends AppController
{
    public $components = array('Paginator', 'Search.Prg');

    public function view($id){
        if (!$this->Casecloseform->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $form = $this->Casecloseform->find("first", array(
                "conditions"=>array(
                    $this->Casecloseform->alias.".id"=>$id
                )
        ));
        $this->set("form", $form);
    }

    public function delete($id = null) {
//        Configure::write('debug',2);
        $this->Casecloseform->id = $id;

        $form = $this->Casecloseform->findById($id);

        if (!$this->Casecloseform->exists()) {
            throw new NotFoundException(__('Invalid Casecloseform'));
        }
        $this->Casecloseform->begin();
//        $this->request->allowMethod('post', 'delete');
        if ($this->Casecloseform->delete()) {

            $this->Casecloseform->Casemanagementform->id = $form['Casemanagementform']['id'];
            if($this->Casecloseform->Casemanagementform->exists()){
                if($this->Casecloseform->Casemanagementform->delete()){
                    $this->Casecloseform->commit();
                    $this->Session->setFlash(__('成功刪除會面記錄'), 'default', array('class'=>'alert alert-success'));
                }
            }


        } else {
            $this->Session->setFlash(__('刪除會面記錄不成功'), 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array("controller" => "Casemanagements", "action" => "view", $form['Casemanagementform']['casemanagement_id']));
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
            $this->Casecloseform->begin();
            $this->Casecloseform->create();

            $this->request->data['Casecloseform']['Casemanagementform'] = '';
            $this->request->data['Casemanagementform']['casemanagement_id'] = $case_id;
            $this->request->data['Casemanagementform']['form_type'] = $this->Casecloseform->alias;
            $this->request->data['Casemanagementform']['form_controller'] = $this->name;
            $this->request->data['Casemanagementform']['form_date'] = $this->request->data['Casecloseform']['date'];
            $this->request->data['Casemanagementform']['form_name'] = $this->Casecloseform->form_name;

            if(!$this->Casecloseform->saveAll($this->request->data, array("deep" => true))){
                $error = true;
            }
            if(!$this->Casecloseform->Casemanagementform->saveField('form_id', $this->Casecloseform->id)){
                $error = true;
            }

            $this->Casemanagement->id = $case_id;
            if(!$this->Casemanagement->saveField('status', 9)){
                $error = true;
            }

            if(!$error){
                $this->Casecloseform->commit();
                $this->Session->setFlash(__('新增個案評估成功'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));
            }else{
                $this->Casecloseform->rollback();
                $this->Session->setFlash(__('新增個案評估失敗'), 'default', array('class' => 'alert alert-danger'));
                $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));
            }


        }

        $this->set('caseclosereasons', $this->Casecloseform->Caseclosereason->find('list', array('conditions' => array('active' => 1))));
        $this->set('case_id', $case_id);
        $this->set('case', $case);
        $this->set(compact("types"));
    }

    function edit($case_id, $id=null){

        if (!$this->Casemanagement->exists($case_id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if (!$this->Casecloseform->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if($this->Casecloseform->save($this->request->data)){
                $this->Session->setFlash(__('成功更新個案諮詢記錄'), 'default', array('class'=>'alert alert-success'));
            }else{
                $this->Session->setFlash(__('更新個案諮詢記錄不成功'), 'default', array('class'=>'alert alert-danger'));
            }
            return $this->redirect(array("controller" => "Casemanagements", "action" => "view", $case_id));

        }else{
            $this->request->data = $this->Casecloseform->find('first',array(
                'conditions'=>array(
                    'Casecloseform.id'=>$id
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

        $this->set('caseclosereasons', $this->Casecloseform->Caseclosereason->find('list', array('conditions' => array('active' => 1))));
        $this->set('case', $case);
    }
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->loadModel('Casemanagement');

    }

}