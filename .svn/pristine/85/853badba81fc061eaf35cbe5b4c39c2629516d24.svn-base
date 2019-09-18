<?php
App::uses('AppController', 'Controller');
/**
 * Parameters Controller
 *
 * @property Parameter $Parameter
 * @property PaginatorComponent $Paginator
 */
class ParametersController extends AppController {

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
//        Configure::write('debug', 2);
		$this->Parameter->recursive = 0;
		$this->set('parameters', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($model=null, $model_name=null) {
        if (!$this->loadModel($model)) {
            throw new NotFoundException(__('Invalid'));
        }
//        Configure::write('debug', 2);
        //        debug($test);exit;

        $key_list = array_keys($this->{$model}->getColumnTypes());
        unset($key_list[array_search('id', $key_list)]);
        unset($key_list[array_search('active', $key_list)]);
        unset($key_list[array_search('editable', $key_list)]);
        unset($key_list[array_search('created', $key_list)]);
        unset($key_list[array_search('modified', $key_list)]);

		$this->set('para_list', $this->{$model}->find('all'));
		$this->set('key_list', $key_list);
		$this->set('model_name', $model_name);
		$this->set('model', $model);
	}

    public function viewonly($model=null, $model_name=null) {
        if (!$this->loadModel($model)) {
            throw new NotFoundException(__('Invalid'));
        }

        $key_list = array_keys($this->{$model}->getColumnTypes());
        unset($key_list[array_search('id', $key_list)]);
        unset($key_list[array_search('active', $key_list)]);
        unset($key_list[array_search('editable', $key_list)]);
        unset($key_list[array_search('created', $key_list)]);
        unset($key_list[array_search('modified', $key_list)]);

        $this->set('para_list', $this->{$model}->find('all'));
        $this->set('key_list', $key_list);
        $this->set('model_name', $model_name);
        $this->set('model', $model);
    }

/**
 * add method
 *
 * @return void
 */
	public function add($model=null, $model_name=null) {
        if (!$this->loadModel($model)) {
            throw new NotFoundException(__('Invalid'));

        }

        $key_list = array_keys($this->{$model}->getColumnTypes());
        unset($key_list[array_search('id', $key_list)]);
        unset($key_list[array_search('active', $key_list)]);
        unset($key_list[array_search('editable', $key_list)]);
        unset($key_list[array_search('created', $key_list)]);
        unset($key_list[array_search('modified', $key_list)]);

        $this->set('key_list', $key_list);
        $this->set('model_name', $model_name);
        $this->set('model', $model);

		if ($this->request->is('post')) {
            $this->{$model}->create();
			if ($this->{$model}->save($this->request->data)) {
				$this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
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
	public function edit($model=null, $model_name=null) {
        if (!$this->loadModel($model)) {
            throw new NotFoundException(__('Invalid'));

        }

        $key_list = array_keys($this->{$model}->getColumnTypes());
        unset($key_list[array_search('id', $key_list)]);
        unset($key_list[array_search('active', $key_list)]);
        unset($key_list[array_search('editable', $key_list)]);
        unset($key_list[array_search('created', $key_list)]);
        unset($key_list[array_search('modified', $key_list)]);

        $this->set('key_list', $key_list);
        $this->set('para_list', $this->{$model}->find('all'));
        $this->set('model_name', $model_name);
        $this->set('model', $model);

        if ($this->request->is('post')) {
//
//            Configure::write('debug', 2);
//            debug($this->request->data); exit();
            $error = false;
            $this->{$model}->begin();
            foreach($this->request->data[$model] as $para){
                if($this->{$model}->exists($para['id'])){
                    if (!$this->{$model}->save($para)) {
                        $error = configure::read("error_prefix")."00063";
                    }
                }else{
                    $error = configure::read("error_prefix")."00062";
                }
            }

            if(!$error){
                $this->{$model}->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }else{
                $this->{$model}->rollback();
                $this->Session->setFlash(__("續期不成功。").' ('.$error.')', 'default', array('class' => 'alert alert-danger'));
            }
        }
	}

    public function changeactive()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $msg = array('result' => false);
        if ($this->request->is('post') || $this->request->is('put')) {
            $id = $this->request->data['id'];
            $model = $this->request->data['model'];
            $active = $this->request->data['active'];
            if (!$this->loadModel($model)) {
                throw new NotFoundException(__('Invalid user'));
            }else{
                if (!$this->{$model}->exists($id)) {
                    throw new NotFoundException(__('Invalid'));
                }
            }


            $this->{$model}->id = $id;
            if ($this->{$model}->saveField('active', $active)) {
                $msg = array('result' => true, 'active' => $active, 'posted' => $this->request->data);
            }
        }

        echo json_encode($msg);
    }

    public function beforeFilter() {
//        $this->Security->unlockedActions[] = 'view';
//        $this->Security->unlockedActions[] = 'add';
//        $this->Security->unlockedActions[] = 'edit';
//        $this->Security->unlockedActions[] = 'viewonly';
        $this->Security->unlockedActions[] = 'changeactive';
        parent::beforeFilter();
    }
}
