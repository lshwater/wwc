<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class DbmodelsController extends AppController {




	public function preview($id){

		$object = $this->Dbmodel->get_struct($id);
        $model = $this->Dbmodel->read(null, $id);
		$this->set('object',$object);
		$this->set('model',$model);

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
		$this->Dbmodel->recursive = 0;
		$this->set('models', $this->Paginator->paginate());
	}

	public function workflow($id){

        $model = $this->Dbmodel->read(null, $id);

        $workflows = $this->Dbmodel->Workflow->find('all',array(
            'conditions'=>array(
                'Workflow.model_id'=>$id
            )
        ));

        $this->set('model',$model);
        $this->set('workflows',$workflows);

    }



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->Dbmodel->create();
			if ($this->Dbmodel->save($this->request->data)) {

			    $id = $this->Dbmodel->getLastInsertID();

                $this->loadModel($this->request->data['Dbmodel']['name']);
                $sql = $this->{$this->request->data['Dbmodel']['name']}->query("SHOW COLUMNS FROM `".$this->request->data['Dbmodel']['db_table']."`;");

                if(!empty($sql)){
                    foreach($sql as $column){
                        if(!in_array($column['COLUMNS']['Field'], array('id', 'modified', 'created'))){
                            $field = array();
                            $field['connected'] = 1;
                            $field['sync'] = 1;
                            $field['model_id'] = $id;
                            $field['is_dropdown'] = 0;
                            $field['is_date'] = 0;
                            $field['is_time'] = 0;
                            $field['is_dropdown'] = 0;
                            $field['db_field'] = $column['COLUMNS']['Field'];
                            $field['type'] = $column['COLUMNS']['Type'];

                            if($field['type'] == "date"){
                                $field['is_date'] = 1;
                            }

                            if($field['type'] == 'time'){
                                $field['is_time'] = 1;
                            }

                            $str = $column['COLUMNS']['Type'];
                            $start  = strpos($str, '(');
                            $end    = strpos($str, ')', $start + 1);
                            $length = $end - $start;
                            if($start && $end){
                                $field['type'] = substr($str, 0, $start);
                                $field['length'] = intval(substr($str, $start + 1, $length - 1));
                            }

                            if($column['COLUMNS']['Null'] == 'NO'){
                                $field['required'] = 1;
                            }

                            if($column['COLUMNS']['Default'] != null){
                                $field['default_value'] = $column['COLUMNS']['Default'];
                            }



                            $this->Dbmodel->Dbfield->create();
                            $this->Dbmodel->Dbfield->save($field);
                        }
                    }
                }

                $this->Session->setFlash(__('The Dbmodel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Dbmodel could not be saved. Please, try again.'));
			}
		}
	}

	public function reload($id){
//        configure::write('debug',2);

	    $model = $this->Dbmodel->read(null, $id);
//        debug($model);
        $this->Dbmodel->Dbfield->deleteAll(
            array('model_id'=>$id)
        );
        $this->loadModel($model['Dbmodel']['name']);
        $sql = $this->{$model['Dbmodel']['name']}->query("SHOW COLUMNS FROM `".$model['Dbmodel']['db_table']."`;");

        if(!empty($sql)){
            foreach($sql as $column){
                if(!in_array($column['COLUMNS']['Field'], array('id', 'modified', 'created'))){
                    $field = array();
                    $field['connected'] = 1;
                    $field['sync'] = 1;
                    $field['model_id'] = $id;
                    $field['is_dropdown'] = 0;
                    $field['is_date'] = 0;
                    $field['is_time'] = 0;
                    $field['is_dropdown'] = 0;
                    $field['db_field'] = $column['COLUMNS']['Field'];
                    $field['type'] = $column['COLUMNS']['Type'];

                    if($field['type'] == "date"){
                        $field['is_date'] = 1;
                    }

                    if($field['type'] == 'time'){
                        $field['is_time'] = 1;
                    }

                    $str = $column['COLUMNS']['Type'];
                    $start  = strpos($str, '(');
                    $end    = strpos($str, ')', $start + 1);
                    $length = $end - $start;
                    if($start && $end){
                        $field['type'] = substr($str, 0, $start);
                        $field['length'] = intval(substr($str, $start + 1, $length - 1));
                    }

                    if($column['COLUMNS']['Null'] == 'NO'){
                        $field['required'] = 1;
                    }

                    if($column['COLUMNS']['Default'] != null){
                        $field['default_value'] = $column['COLUMNS']['Default'];
                    }



                    $this->Dbmodel->Dbfield->create();
                    $this->Dbmodel->Dbfield->save($field);
                }
            }
        }
//        exit();
        $this->Session->setFlash(__('The Dbmodel has been saved.'));
        return $this->redirect(array('action' => 'index'));
    }

    public function view($id = null) {
        if (!$this->Dbmodel->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }

        $this->Dbmodel->Behaviors->load('Containable');
        $model = $this->Dbmodel->find('first',array(
            'conditions'=>array(
                'Dbmodel.id'=>$id,
            ),
            'contain'=>array(
                'Dbfield'=>array(
                    'order'=>array(
                        'Dbfield.order'=>'ASC'
                    )
                )
            )
        ));

        $this->set('model', $model);

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
			$this->Dbmodel->create();
			if ($this->Dbmodel->save($this->request->data)) {

				$model_id = $this->Dbmodel->getLastInsertID();
				$rst = $this->Dbmodel->copy_model($id,$model_id);
				if($rst){
					$this->Session->setFlash(__('The Dbmodel has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('The Dbmodel could not be saved. Please, try again.'));
					return $this->redirect(array('action' => 'index'));
				}

			} else {
				$this->Session->setFlash(__('The Dbmodel could not be saved. Please, try again.'));
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
		if (!$this->Dbmodel->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
//			configure::write('debug',2);
			if ($this->Dbmodel->save($this->request->data)) {
				$this->Session->setFlash(__('The Dbmodel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Dbmodel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dbmodel.' . $this->Dbmodel->primaryKey => $id));
			$this->request->data = $this->Dbmodel->find('first', $options);
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
		$this->Dbmodel->id = $id;
		if (!$this->Dbmodel->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dbmodel->delete()) {

			$this->Session->setFlash(__('The Dbmodel has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Dbmodel could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



	public function beforeFilter(){

		parent::beforeFilter();
	}
}
