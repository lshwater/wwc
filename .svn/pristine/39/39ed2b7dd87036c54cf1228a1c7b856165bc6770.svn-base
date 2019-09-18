<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class DbfielddropdownsController extends AppController {


/**
 * Components
 *
 *
 * @var array
 */
	public $components = array('Paginator');

    public function view($dbfield_id = null){

        if(!$this->Dbfielddropdown->Dbfield->exists($dbfield_id)){
            throw new NotFoundException(__('Invalid Dbfield'));
        }

//        configure::write('debug',2);
        $list = $this->Dbfielddropdown->find('all', array(
            'conditions'=>array(
                'Dbfielddropdown.dbfield_id' => $dbfield_id
            ),
            'order'=>array(
                'Dbfielddropdown.order'=>'ASC'
            )
        ));

//        debug($list);exit();


        $this->set('list', $list);
        $this->set('field', $this->Dbfielddropdown->Dbfield->read(null, $dbfield_id));

    }

/**
 * add method
 *
 * @return void
 */
	public function add($dbfield_id = null) {
        if (!$this->Dbfielddropdown->Dbfield->exists($dbfield_id)) {
            throw new NotFoundException(__('Invalid group'));
        }

		if ($this->request->is('post')) {

            $last = $this->Dbfielddropdown->find('first',array(
                'conditions'=>array(
                    'Dbfielddropdown.dbfield_id'=>$dbfield_id,
                ),
                'order'=>array(
                    'Dbfielddropdown.order'=>"DESC"
                ),
                'recursive'=>-1
            ));

            $this->request->data['Dbfielddropdown']['order'] = $last['Dbfielddropdown']['order'] + 1;

            $this->Dbfielddropdown->create();
			if ($this->Dbfielddropdown->save($this->request->data)) {

			    $this->Session->setFlash(__('The Dbfielddropdown has been saved.'));
                if(!empty($redirecturl)){
                    $this->redirect($redirecturl);
                }else{
                    $this->redirect(array('controller'=>'Dbfielddropdowns', 'action'=>'view', $this->request->data['Dbfielddropdown']['dbfield_id']));
                }
			} else {
				$this->Session->setFlash(__('The Dbfielddropdowns could not be saved. Please, try again.'));
			}
		}
		$this->set('dbfield_id', $dbfield_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dbfielddropdown->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}


		if ($this->request->is(array('post', 'put'))) {

//		    if($this->request->data['Dbfield']['default_value'] == ''){
////		        debug('here');
//                $this->request->data['Dbfield']['default_value'] = null;
//            }
//
//            if($this->request->data['Dbfield']['hidden']){
//                $this->request->data['Dbfield']['required'] = 0;
//            }

			if ($this->Dbfielddropdown->save($this->request->data)) {

                $this->Session->setFlash(__('The Dbfielddropdown has been saved.'));
                $redirecturl = urldecode($this->request->params['named']['redirect']);
                if(!empty($redirecturl)){
                    $this->redirect($redirecturl);
                }else{
                    $this->redirect(array('controller'=>'Dbfielddropdown', 'action'=>'view', $this->request->data['Dbfielddropdown']['dbfield_id']));
                }
			} else {
				$this->Session->setFlash(__('The Dbfielddropdown could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dbfielddropdown.' . $this->Dbfielddropdown->primaryKey => $id));
			$this->request->data = $this->Dbfielddropdown->find('first', $options);
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
		$this->Dbfielddropdown->id = $id;
		if (!$this->Dbfielddropdown->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		$field = $this->Dbfielddropdown->find('first',array(
		    'conditions'=>array(
		        'Dbfielddropdown.id'=>$id
            )
        ));
		if ($this->Dbfielddropdown->delete()) {

			$this->Session->setFlash(__('The Dbfielddropdown has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Dbfielddropdown could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'Dbfielddropdowns', 'action'=>'view', $field['Dbfielddropdown']['dbfield_id']));

    }

    public function moveup($id = null) {
        if (!$this->Dbfielddropdown->exists($id)) {
            throw new NotFoundException(__('Invalid Dbfielddropdown'));
        }
        $struct = $this->Dbfielddropdown->read(null, $id);

        $order = $struct['Dbfielddropdown']['order'];

        $options = array();
        $options['conditions']['Dbfielddropdown.dbfield_id'] = $struct['Dbfielddropdown']['dbfield_id'];
        $options['conditions']['Dbfielddropdown.order <'] = $struct['Dbfielddropdown']['order'];
        $options['conditions']['Dbfielddropdown.order !='] = 0;

        $options['order']['Dbfielddropdown.order'] = 'DESC';
        $options['recursive'] = -1;

        $upper = $this->Dbfielddropdown->find('first',$options);

        if(!empty($upper)){
            $this->Dbfielddropdown->id = $id;
            $this->Dbfielddropdown->saveField('order',$upper['Dbfielddropdown']['order']);

            $this->Dbfielddropdown->id = $upper['Dbfielddropdown']['id'];
            $this->Dbfielddropdown->saveField('order',$order);
        }

        $this->Session->setFlash(__('The Dbfielddropdown is updated.'));

        return $this->redirect(array('controller'=>'dbfielddropdowns','action' => 'view',$struct['Dbfielddropdown']['dbfield_id']));
    }


    public function movedown($id = null) {

        if (!$this->Dbfielddropdown->exists($id)) {
            throw new NotFoundException(__('Invalid Dbfielddropdown'));
        }
        $struct = $this->Dbfielddropdown->read(null, $id);

        $order = $struct['Dbfielddropdown']['order'];

        $options = array();
        $options['conditions']['Dbfielddropdown.dbfield_id'] = $struct['Dbfielddropdown']['dbfield_id'];
        $options['conditions']['Dbfielddropdown.order >'] = $struct['Dbfielddropdown']['order'];

        $options['order']['Dbfielddropdown.order'] = 'ASC';

        $upper = $this->Dbfielddropdown->find('first',$options);

        if(!empty($upper)){
            $this->Dbfielddropdown->id = $id;
            $this->Dbfielddropdown->saveField('order',$upper['Dbfielddropdown']['order']);

            $this->Dbfielddropdown->id = $upper['Dbfielddropdown']['id'];
            $this->Dbfielddropdown->saveField('order',$order);
        }

        $this->Session->setFlash(__('The Dbfielddropdown is updated.'));

        return $this->redirect(array('controller'=>'dbfielddropdowns','action' => 'view',$struct['Dbfielddropdown']['dbfield_id']));

    }
    
	public function beforeFilter(){

		parent::beforeFilter();
	}
}
