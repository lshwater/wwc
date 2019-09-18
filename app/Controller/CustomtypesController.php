<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class CustomtypesController extends AppController {



	public function test(){

        configure::write('debug',2);

        $object = $this->Customtype->get_struct(10);
		debug($object);

//		debug($this->Customtype->copy_model(1,4));

        exit();

	}

	public function preview($id){
//        configure::write('debug',2);

        $this->Customtype->id = $id;
		$object = $this->Customtype->Dbmodel->get_struct($this->Customtype->field('model_id'));

		$layout = $this->Customtype->Customlayout->get_struct($id);

		$group = $this->Customtype->Customgroup->find('all', array(
		    'conditions'=>array(
                'Customgroup.type_id'=>$id
            ),
            'order'=>array(
                'Customgroup.display_order'=>'ASC'
            ),
            'recursive'=>-1
        ));
//		debug($group);exit();
        $this->set('object',$object);
        $this->set('layout',$layout);
		$this->set('type', $this->Customtype->read(null, $id));
		$this->set('group', $group);

	}

    public function layout($id){

        $this->Customtype->id = $id;

        $layout = $object = $this->Customtype->Customlayout->get_struct_with_group($id);
        $this->set('layout',$layout);


        $this->set('type', $this->Customtype->read(null, $id));

    }

    public function previewlayout($id){

        $this->Customtype->id = $id;

        $layout = $object = $this->Customtype->Customlayout->get_struct_with_group($id);
        $this->set('layout',$layout);

        $this->set('type', $this->Customtype->read(null, $id));

    }


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
//	    configure::write('debug',2);
		$this->Customtype->recursive = 0;
		$this->set('objects', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Customtype->create();
			if ($this->Customtype->save($this->request->data)) {
				$this->Session->setFlash(__('The Customtype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Customtype could not be saved. Please, try again.'));
			}
		}else{
		    $this->set('model', $this->Customtype->Dbmodel->find('list',array('fields'=>array('id', 'oname'))));
        }

	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function copy($id) {
		if ($this->request->is('post')) {

//			configure::write('debug',2);
//			debug($id);exit();
			$this->Customtype->create();
			if ($this->Customtype->save($this->request->data)) {

				$model_id = $this->Customtype->getLastInsertID();
				$rst = $this->Customtype->copy_model($id,$model_id);
				if($rst){
					$this->Session->setFlash(__('The Customtype has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('The Customtype could not be saved. Please, try again.'));
					return $this->redirect(array('action' => 'index'));
				}

			} else {
				$this->Session->setFlash(__('The Customtype could not be saved. Please, try again.'));
			}
		}

//		$this->set('model_id',$id);
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Customtype->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
//			configure::write('debug',2);
			if ($this->Customtype->save($this->request->data)) {
				$this->Session->setFlash(__('The Customtype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Customtype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Customtype.' . $this->Customtype->primaryKey => $id));
			$this->request->data = $this->Customtype->find('first', $options);
            $this->set('model', $this->Customtype->Dbmodel->find('list',array('fields'=>array('id', 'oname'))));
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
		$this->Customtype->id = $id;
		if (!$this->Customtype->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customtype->delete()) {

			$this->Customtype->Customfield->deleteAll(
                array('model_id'=>$id)
			);
			$this->Session->setFlash(__('The Customtype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Customtype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter(){

		parent::beforeFilter();
	}
}
