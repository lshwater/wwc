<?php
App::uses('AppController', 'Controller');

class CutoffdatesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $cutoffdates = $this->Cutoffdate->find("all");
        $this->set('cutoffdates', $cutoffdates);
        $this->set("curcutoffdate", $this->Cutoffdate->getlastdate());
    }

    public function add(){
        if ($this->request->is('post')) {
            $this->Cutoffdate->create();
            if ($this->Cutoffdate->save($this->request->data)) {
                $this->Session->setFlash("新增成功", 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("新增失敗", 'default', array('class'=>'alert alert-danger'));
            }
        }
    }

    public function edit($id = null){
        if (!$this->Cutoffdate->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Cutoffdate->save($this->request->data)) {
                $this->Session->setFlash("更新成功", 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->layout = "default";
                $this->Session->setFlash("更新失敗", 'default', array('class'=>'alert alert-danger'));
            }
        }else {
            $options = array('conditions' => array('Cutoffdate.' . $this->Cutoffdate->primaryKey => $id));
            $this->request->data = $this->Cutoffdate->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->Cutoffdate->id = $id;
        if (!$this->Cutoffdate->exists()) {
            throw new NotFoundException(__('Invalid Cutoffdate'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Cutoffdate->delete()) {
            $this->Session->setFlash("成功", 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash("失敗", 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter() {
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }
}
