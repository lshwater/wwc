<?php
App::uses('AppController', 'Controller');

class VolunteerunitsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Volunteerunit->recursive = 0;
        $this->set('volunteerunits', $this->Volunteerunit->find('all'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
//        Configure::write('debug', 2);
        if (!$this->Volunteerunit->exists($id)) {
            throw new NotFoundException(__('Invalid Volunteerunit'));
        }
        $options = array('conditions' => array('Volunteerunit.' . $this->Volunteerunit->primaryKey => $id));
        $this->set('volunteerunit', $this->Volunteerunit->find('first', $options));

        $volunteers = $this->Volunteerunit->Volunteer->find("all", array(
           "conditions"=>array(
               "Volunteer.volunteerunit_id"=>$id
           )
        ));

        $this->Volunteerunit->ActivitiesVolunteer->virtualFields = array(
            'volunteer_count' => 'COUNT(ActivitiesVolunteer.id)'
        );

        $this->Volunteerunit->ActivitiesVolunteer->Behaviors->load('Containable');
        $activities = $this->Volunteerunit->ActivitiesVolunteer->find('all', array(
            'conditions' => array(
                'ActivitiesVolunteer.volunteerunit_id' => $id
            ),
            'group' => array(
                'ActivitiesVolunteer.activity_id'
            ),
            'contain'=>array(
                'Activity.Eventproposal'
            )
        ));

        $this->set('activities', $activities);
        $this->set('volunteers', $volunteers);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Volunteerunit->create();
            if ($this->Volunteerunit->save($this->request->data)) {
                $this->Session->setFlash("機構新增成功", 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("機構新增失敗", 'default', array('class'=>'alert alert-danger'));
            }
        }

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Volunteerunit->exists($id)) {
            throw new NotFoundException(__('Invalid unit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Volunteerunit->save($this->request->data)) {
                $this->Session->setFlash("機構更新成功", 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("機構更新失敗", 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Volunteerunit.' . $this->Volunteerunit->primaryKey => $id));
            $this->request->data = $this->Volunteerunit->find('first', $options);
        }

    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Volunteerunit->id = $id;
        if (!$this->Volunteerunit->exists()) {
            throw new NotFoundException(__('Invalid Volunteerunit'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Volunteerunit->delete()) {
            $this->Session->setFlash("機構已刪除", 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash('機構已刪除失敗', 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter() {
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }
}
