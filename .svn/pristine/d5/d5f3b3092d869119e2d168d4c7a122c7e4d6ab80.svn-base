<?php
App::uses('AppController', 'Controller');
/**
 * Agencies Controller
 *
 * @property Agency $Agency
 * @property PaginatorComponent $Paginator
 */
class AgenciesController extends AppController {

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
		$this->Agency->recursive = 0;
		$this->set('agencies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Agency->exists($id)) {
			throw new NotFoundException(__('Invalid agency'));
		}
		$options = array('conditions' => array('Agency.' . $this->Agency->primaryKey => $id));
		$this->set('agency', $this->Agency->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Agency->create();
			if ($this->Agency->save($this->request->data)) {
				$this->Session->setFlash(__('The ').__('agency').__(' has been saved.'), 'default', array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ').__('agency').__(' could not be saved. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
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
		if (!$this->Agency->exists($id)) {
			throw new NotFoundException(__('Invalid agency'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Agency->save($this->request->data)) {
				$this->Session->setFlash(__('The ').__('agency').__(' has been saved.'), 'default', array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ').__('agency').__(' could not be saved. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Agency.' . $this->Agency->primaryKey => $id));
			$this->request->data = $this->Agency->find('first', $options);
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
		$this->Agency->id = $id;
		if (!$this->Agency->exists()) {
			throw new NotFoundException(__('Invalid agency'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Agency->delete()) {
			$this->Session->setFlash(__('The ').__('agency').__(' has been deleted.'), 'default', array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The ').__('agency').__(' could not be deleted. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }
}
