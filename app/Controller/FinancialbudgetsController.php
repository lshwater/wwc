<?php
App::uses('AppController', 'Controller');

class FinancialbudgetsController extends AppController {

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
    public function add($id = null, $model = null){
//        Configure::write('debug',2);
        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if($this->Financialbudget->hasAny(array('model'=> $model, 'model_id' =>$id))){
            $this->Session->setFlash(__('新增失敗, 找到現存的財政預算'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect($redirecturl);
        }

        if ($this->request->is(array('post', 'put'))) {
//            Configure::write('debug', 2);
            $this->request->data['Financialbudget']['model'] = $model;
            $this->request->data['Financialbudget']['model_id'] = $id;

            $this->Financialbudget->begin();
            $this->Financialbudget->create();
            if ($this->Financialbudget->saveAssociated($this->request->data, array("deep" => true))) {
                $this->Financialbudget->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect($redirecturl);
            } else {
                $this->Financialbudget->rollback();
                $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00022".')', 'default', array('class' => 'alert alert-danger'));
            }

        }

        $income = $this->Financialbudget->Financialbudgetdetail->Financialitem->find('list',array(
            'conditions' => array('Financialitem.type' => 'income', 'active'=>true)
        ));
        $expense = $this->Financialbudget->Financialbudgetdetail->Financialitem->find('list',array(
            'conditions' => array('Financialitem.type' => 'expense', 'active'=>true)
        ));

        $this->set('income', $income);
        $this->set('expense', $expense);


    }

    public function edit($id = null, $model = null){

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        $this->Financialbudget->Behaviors->load('Containable');
        $budgetdetail =$this->Financialbudget->find('first',array(
            'conditions'=>array(
                'Financialbudget.model' => $model,
                'Financialbudget.model_id' => $id
            ),
            'contain'=>array(
                'Financialbudgetincome.Financialitem',
                'Financialbudgetexpense.Financialitem'
            )
        ));

        $this->set('budgetdetail', $budgetdetail);

        if(!$budgetdetail['Financialbudget']['editable']){
            $this->Session->setFlash(__('紀錄已鎖定，更新失敗'), 'default', array('class'=>'alert alert-danger'));
            return $this->redirect($redirecturl);
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Financialbudget']['model'] = $model;
            $this->request->data['Financialbudget']['model_id'] = $id;

            if (!$this->Financialbudget->exists($budgetdetail['Financialbudget']['id'])) {
                throw new NotFoundException(__('Invalid'));
            }
            $this->Financialbudget->begin();

            if(!$this->Financialbudget->Financialbudgetdetail->deleteAll(array('financialbudget_id' => $budgetdetail['Financialbudget']['id']),false)){
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00023".')', 'default', array('class'=>'alert alert-danger'));
                return;
            }

            if ($this->Financialbudget->saveAssociated($this->request->data, array("deep" => true))) {
                $this->Financialbudget->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect($redirecturl);
            } else {
                $this->Financialbudget->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00024".')', 'default', array('class' => 'alert alert-danger'));
            }

        }
        $income = $this->Financialbudget->Financialbudgetdetail->Financialitem->find('list',array(
            'conditions' => array('Financialitem.type' => 'income', 'active'=>true)
        ));
        $expense = $this->Financialbudget->Financialbudgetdetail->Financialitem->find('list',array(
            'conditions' => array('Financialitem.type' => 'expense', 'active'=>true)
        ));

        $this->set('income', $income);
        $this->set('expense', $expense);

    }

    public function view($id = null, $model = null){

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if(!$this->Financialbudget->hasAny(array('Financialbudget.model'=> $model, 'Financialbudget.model_id' =>$id))){
            $this->Session->setFlash(__('找不到現存的財政預算'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect($redirecturl);
        }
        $this->Financialbudget->Behaviors->load('Containable');
        $budgetdetail =$this->Financialbudget->find('first',array(
            'conditions'=>array(
                'Financialbudget.model' => $model,
                'Financialbudget.model_id' => $id
            ),
            'contain'=>array(
                'Financialbudgetincome.Financialitem',
                'Financialbudgetexpense.Financialitem',
                'Prepayment'
            )
        ));

        $this->set('budgetdetail', $budgetdetail);
        $this->set('id', $id);
        $this->set('model', $model);

    }

    public function viewsimplify($id = null, $model = null){

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if(!$this->Financialbudget->hasAny(array('Financialbudget.model'=> $model, 'Financialbudget.model_id' =>$id))){
            $this->Session->setFlash(__('找不到現存的財政預算'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect($redirecturl);
        }
        $this->Financialbudget->Behaviors->load('Containable');
        $budgetdetail =$this->Financialbudget->find('first',array(
            'conditions'=>array(
                'Financialbudget.model' => $model,
                'Financialbudget.model_id' => $id
            ),
            'contain'=>array(
                'Financialbudgetincome.Financialitem',
                'Financialbudgetexpense.Financialitem',
                'Prepayment'
            )
        ));

        $this->set('budgetdetail', $budgetdetail);
        $this->set('id', $id);
        $this->set('model', $model);

    }

    public function delprepayment($prepayment_id=null, $id=null, $model=null){

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if (!$this->Financialbudget->Prepayment->exists($prepayment_id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Financialbudget->Prepayment->begin();

            if ($this->Financialbudget->Prepayment->delete($prepayment_id)) {
                $this->Financialbudget->Prepayment->commit();
                $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect($redirecturl);
            } else {
                $this->Financialbudget->Prepayment->rollback();
                $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00025".')', 'default', array('class' => 'alert alert-danger'));
            }

        }

    }

    public function editprepayment($prepayment_id=null, $id=null, $model=null){
        Configure::write('debug', 2);

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if (!$this->Financialbudget->Prepayment->exists($prepayment_id)) {
            throw new NotFoundException(__('Invalid'));
        }


        $prepayment =$this->Financialbudget->Prepayment->find('first',array(
            'conditions'=>array(
                'Prepayment.id' => $prepayment_id
            )
        ));

        $this->set('prepayment', $prepayment);

        if ($this->request->is(array('post', 'put'))) {

            $this->Financialbudget->Prepayment->begin();
            $this->Financialbudget->Prepayment->id = $prepayment_id;

            if ($this->Financialbudget->Prepayment->save($this->request->data, array("deep" => true))) {
                $this->Financialbudget->Prepayment->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect($redirecturl);
            } else {
                $this->Financialbudget->Prepayment->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00026".')', 'default', array('class' => 'alert alert-danger'));
            }

        }
    }

    public function addprepayment($financialbudget_id=null, $id=null, $model=null){

        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);

        if (!$this->Financialbudget->exists($financialbudget_id)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Financialbudget->Prepayment->begin();
            $this->Financialbudget->Prepayment->create();

            if ($this->Financialbudget->Prepayment->save($this->request->data, array("deep" => true))) {
                $this->Financialbudget->Prepayment->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class' => 'alert alert-success'));

                return $this->redirect($redirecturl);
            } else {
                $this->Financialbudget->Prepayment->rollback();
                $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00027".')', 'default', array('class' => 'alert alert-danger'));
            }

        }

        $this->set('financialbudget_id', $financialbudget_id);

    }

    public function beforeFilter()
    {
//        if($this->request['action'] == 'add' || $this->request['action'] == 'edit'){
//            $this->Security->unlockedFields = array('Eventproposalprocedure');
//        }

        if ($this->request['action'] == 'add' ) {

            $this->Security->csrfUseOnce = false;
            $this->Security->validatePost = false;
//            $this->Security->unlockedActions[] = 'add';
        }

        if ($this->request['action'] == 'edit' ) {
            $this->Security->csrfUseOnce = false;
            $this->Security->validatePost = false;
//            $this->Security->unlockedActions[] = 'edit';
        }

        parent::beforeFilter();
    }
}
