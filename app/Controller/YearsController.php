<?php
App::uses('AppController', 'Controller');
/**
 * Years Controller
 *
 * @property Year $Year
 * @property PaginatorComponent $Paginator
 */
class YearsController extends AppController {

    public $components = array('Paginator');
    public function index() {
        $this->Year->recursive = 0;
        $this->set('years', $this->Year->find("all"));
        $this->set("curyear", $this->Year->getcurrent());
    }

    public function add() {

        if ($this->request->is('post')) {
            if ($this->Year->save($this->request->data)) {
                $this->Session->setFlash(__('年度新增成功'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('年度新增失敗'), 'default', array('class' => 'alert alert-danger'));

            }
        }
    }

    public function edit($id = null) {
        if (!$this->Year->exists($id)) {
            throw new NotFoundException(__('Invalid Year'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Year->save($this->request->data)) {
                $this->Session->setFlash(__('年度更新成功'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('年度更新失敗'), 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Year.' . $this->Year->primaryKey => $id));
            $this->request->data = $this->Year->find('first', $options);
        }
    }



    public function beforeFilter() {
        parent::beforeFilter();
    }

}
