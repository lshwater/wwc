<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class CustomlayoutsController extends AppController {



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
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}


	public function  test(){
	    configure::write('debug',2);
        $rst = $this->Customlayout->get_struct_with_group(1);
        debug($rst);exit();
        exit();
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id, $field_id) {
//
//        configure::write('debug',2);
        $this->Customlayout->Customtype->Behaviors->load('Containable');

        $type = $this->Customlayout->Customtype->find('first',array(
            'conditions'=>array(
                'Customtype.id'=>$id
            ),
            'contain'=>array(
                'Dbmodel'
            )
        ));

        $field = $this->Customlayout->Customfield->read(null, $field_id);

        $group = $this->Customlayout->Customgroup->find('list',array(
            'conditions'=>array(
                'Customgroup.type_id' => $type['Customtype']['id']
            ),
            'order'=>array(
                'Customgroup.display_order'=>'ASC'
            ),
            'fields'=>array(
                'id', 'display_name'
            )
        ));

		if ($this->request->is('post')) {


            $order = $this->Customlayout->find('count',array(
                'conditions'=>array(
                    'Customlayout.model_id'=>$this->request->data['Customlayout']['model_id'],
                    'Customlayout.type_id'=>$this->request->data['Customlayout']['type_id'],
                    'Customlayout.customgroup_id'=>$this->request->data['Customlayout']['customgroup_id'],
                ),
                'recursive'=>-1
            ));

            $this->request->data['Customlayout']['order'] = $order +1;
            $this->Customlayout->create();

			if($this->Customlayout->save($this->request->data)){
				$this->Session->setFlash(__('The Customlayout has been saved.'));
				return $this->redirect(array('controller'=>'customtypes','action' => 'preview',$this->request->data['Customlayout']['type_id']));

			}else{
				$this->Session->setFlash(__('The Customlayout failed to saved.'));
				return $this->redirect(array('controller'=>'customtypes','action' => 'preview',$this->request->data['Customlayout']['type_id']));
			}
		}
		$this->set('model_id',$id);
		$this->set('type', $type);
		$this->set('field', $field);
        $this->set('group', $group);


	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
//        configure::Write('debug',2);
//        debug($this->request->data);
//		if (!$this->Customlayout->exists($id)) {
//			throw new NotFoundException(__('Invalid group'));
//		}
//		$struct = $this->Customlayout->read(null,$id);

		if ($this->request->is(array('post', 'put'))) {

		    $old = $this->Customlayout->find('first',array(
		        'conditions'=>array(
		            'id'=>$this->request->data['Customlayout']['id']
                ),
                'recursive'=>-1
            ));

		    if($old['Customlayout']['customgroup_id'] != $this->request->data['Customlayout']['customgroup_id']){
                $order = $this->Customlayout->find('count',array(
                    'conditions'=>array(
                        'Customlayout.model_id'=>$this->request->data['Customlayout']['model_id'],
                        'Customlayout.type_id'=>$this->request->data['Customlayout']['type_id'],
                        'Customlayout.customgroup_id'=>$this->request->data['Customlayout']['customgroup_id'],
                    ),
                    'recursive'=>-1
                ));

                $this->request->data['Customlayout']['order'] = $order +1;

                //reorder old group
                if(!empty($old['Customlayout']['customgroup_id'])){
                    $all_field = $this->Customlayout->find('all',array(
                        'conditions'=>array(
                            'Customlayout.model_id'=>$this->request->data['Customlayout']['model_id'],
                            'Customlayout.type_id'=>$this->request->data['Customlayout']['type_id'],
                            'Customlayout.customgroup_id'=>$old['Customlayout']['customgroup_id']
                        ),
                        'order'=>array(
                            'order'=>'ASC'
                        ),
                        'recursive'=>-1
                    ));
                    foreach($all_field as $k=>$field){
                        $this->Customlayout->id = $field['Customlayout']['id'];
                        $this->Customlayout->saveField('order', $k+1);
                    }
                }
            }

			if ($this->Customlayout->save($this->request->data)) {
				$this->Session->setFlash(__('The Customlayout has been saved.'));
				return $this->redirect(array('controller'=>'customtypes','action' => 'preview',$this->request->data['Customlayout']['type_id']));
			} else {
				$this->Session->setFlash(__('The Customlayout could not be saved. Please, try again.'));
                return $this->redirect(array('controller'=>'customtypes','action' => 'preview',$this->request->data['Customlayout']['type_id']));

            }
		} else {
			$options = array('conditions' => array('Customlayout.' . $this->Customlayout->primaryKey => $id));
			$this->request->data = $this->Customlayout->find('first',$options);;

            $this->Customlayout->Customtype->Behaviors->load('Containable');

            $type = $this->Customlayout->Customtype->find('first',array(
                'conditions'=>array(
                    'Customtype.id'=>$this->request->data['Customlayout']['type_id']
            ),
                'contain'=>array(
                    'Dbmodel'
                )
            ));

            $field = $this->Customlayout->Customfield->read(null, $this->request->data['Customlayout']['field_id']);
            $group = $this->Customlayout->Customgroup->find('list',array(
                'conditions'=>array(
                    'Customgroup.type_id' => $type['Customtype']['id']
                ),
                'order'=>array(
                    'Customgroup.display_order'=>'ASC'
                ),
                'fields'=>array(
                    'id', 'display_name'
                )
            ));

            $this->set('type',$type);
            $this->set('field', $field);
            $this->set('group', $group);
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
		$this->Customlayout->id = $id;
		$struct = $this->Customlayout->read(null, $id);
		if (!$this->Customlayout->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customlayout->delete()) {

//			if(in_array($struct['Customlayout']['type'], array('image','array','select'))){
//				$this->Customlayout->deleteAll(array('main_struct_id' => $id));
//			}

			$this->Session->setFlash(__('The Customlayout has been deleted.'));

            $all_field = $this->Customlayout->find('all',array(
                'conditions'=>array(
                    'model_id'=>$struct['Customlayout']['model_id'],
                    'type_id'=>$struct['Customlayout']['type_id']
                ),
                'order'=>array(
                    'order'=>'ASC'
                ),
                'recursive'=>-1
            ));
            foreach($all_field as $k=>$field){
                $this->Customlayout->id = $field['Customlayout']['id'];
                $this->Customlayout->saveField('order', $k+1);
            }

		} else {
			$this->Session->setFlash(__('The Customlayout could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'customtypes','action' => 'preview',$struct['Customlayout']['type_id']));
	}

	public function moveup($id = null) {
		$this->Customlayout->id = $id;
		$struct = $this->Customlayout->read(null, $id);
		if (!$this->Customlayout->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$order = $struct['Customlayout']['order'];

        $options = array();
        $options['conditions']['type_id'] = $struct['Customlayout']['type_id'];
        $options['conditions']['model_id'] = $struct['Customlayout']['model_id'];
        $options['conditions']['customgroup_id'] = $struct['Customlayout']['customgroup_id'];
        $options['conditions']['order <'] = $struct['Customlayout']['order'];
        $options['recursive'] = -1;

        $options['order']['order'] = 'DESC';

		$upper = $this->Customlayout->find('first',$options);

        if(!empty($upper)){
            $this->Customlayout->id = $id;
            $this->Customlayout->saveField('order',$upper['Customlayout']['order']);

            $this->Customlayout->id = $upper['Customlayout']['id'];
            $this->Customlayout->saveField('order',$order);
        }

        $this->Session->setFlash(__('The Customlayout is updated.'));

		return $this->redirect(array('controller'=>'customtypes','action' => 'layout',$struct['Customlayout']['type_id']));
	}

    public function movedown($id = null) {

        $this->Customlayout->id = $id;
        $struct = $this->Customlayout->read(null, $id);
        if (!$this->Customlayout->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $order = $struct['Customlayout']['order'];
        $options = array();
        $options['conditions']['type_id'] = $struct['Customlayout']['type_id'];
        $options['conditions']['model_id'] = $struct['Customlayout']['model_id'];
        $options['conditions']['customgroup_id'] = $struct['Customlayout']['customgroup_id'];
        $options['conditions']['order >'] = $struct['Customlayout']['order'];
        $options['recursive'] = -1;


        $options['order']['order'] = 'ASC';

        $upper = $this->Customlayout->find('first',$options);

        if(!empty($upper)){
            $this->Customlayout->id = $id;
            $this->Customlayout->saveField('order',$upper['Customlayout']['order']);

            $this->Customlayout->id = $upper['Customlayout']['id'];
            $this->Customlayout->saveField('order',$order);
        }

        $this->Session->setFlash(__('The Customlayout is updated.'));

        return $this->redirect(array('controller'=>'customtypes','action' => 'layout',$struct['Customlayout']['type_id']));

    }





	public function beforeFilter(){
        $this->Auth->allow('test', 'test2');
    }
}
