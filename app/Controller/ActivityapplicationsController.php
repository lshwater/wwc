<?php
App::uses('AppController', 'Controller');


class ActivityapplicationsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg', 'DataTable');

    public function histories(){
        $activityapplications = $this->Activityapplication->find("all");
        $this->set("activityapplications", $activityapplications);
    }

    public function edit($id = null){
//        Configure::write('debug',2);
        if(!$this->Activityapplication->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
//        $this->set("paymentmethods", $this->Activityapplication->Paymentmethod->find("list", array("order"=>array("id"=>"ASC"))));
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Activityapplication->save($this->request->data)) {
                $this->Session->setFlash("資料已成功更新", 'default', array('class'=>'alert alert-success'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'histories');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash(__('資料更新失敗'), 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Activityapplication.' . $this->Activityapplication->primaryKey => $id));
            $this->request->data = $this->Activityapplication->find('first', $options);
        }

        $this->Activityapplication->Behaviors->load('Containable');
        $activityapplication = $this->Activityapplication->find("first", array(
            "conditions"=>array(
                $this->Activityapplication->alias.".id"=>$id
            ),
            "contain"=>array(
                "Activityapplicant",
                "Paymentmethod"
            )
        ));

        $this->set("activityapplication", $activityapplication);
    }

    public function ajax_histories()
    {
//        Configure::write('debug',2);
        $this->autoRender = false;
        $this->Activityapplication->Behaviors->load('Containable');
        $this->paginate = array(
            'fields' => array(
                'Activityapplication.id',
                'Activityapplication.code',
                "Activityapplication.created",
                "Activityapplication.payment_code",
                "Activityapplication.totalcost",
            ),
            'order' => 'Activityapplication.code DESC',

        );
        $this->DataTable->mDataProp = true;
        echo json_encode($this->DataTable->getResponse());
    }

    public function receipt($id = null){
        if(!$this->Activityapplication->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->Activityapplication->Behaviors->load('Containable');
        $activityapplication = $this->Activityapplication->find("first", array(
           "conditions"=>array(
               $this->Activityapplication->alias.".id"=>$id
           ),
           "contain"=>array(
               "Activityapplicant",
               "Activityapplicant.Member.Membertype",
               "Activityapplicant.Activity",
               "User"
           )
        ));

        $this->Activityapplication->id = $id;
        $this->Activityapplication->saveField("printed", 1);

        $this->set("activityapplication", $activityapplication);
    }

    public function ajax_updateremarks(){
        $this->autoRender = false;
        $remarks = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->Activityapplication->id = $pk;
            $this->Activityapplication->saveField(
                "remarks",
                $remarks
            );
            echo "OK";
        }
    }

    public function export_histories(){
        $users = $this->Activityapplication->User->find("list");
        $this->set("users", $users);


    }

    public function export_histories_excel(){
//        Configure::write('debug',2);
        if ($this->request->is('post')) {
            $startdate = $this->request->data['Activityapplication']['startdate'];
            $enddate = $this->request->data['Activityapplication']['enddate'];
            $paymentcodecolor = $this->request->data['Activityapplication']['paymentcodecolor'];
            $user_id = $this->request->data['Activityapplication']['user_id'];

            $options = array();
            if(!empty($user_id)){
                $options['conditions']['user_id'] = $user_id;
            }
            if(!empty($paymentcodecolor)){
                $PaymentCodePrefix = configure::read("PaymentCodePrefix");
                $paycodeprefix = $PaymentCodePrefix[$paymentcodecolor];
                $options['conditions']['payment_code like'] = $paycodeprefix."%";
            }

            $options['conditions']['date BETWEEN ? AND ?'] = array($startdate, $enddate);

            $options['contain'] = array(
                "Activityapplicant.Member",
                'Activity',
//                "Paymentmethod",
                "User"
            );
            $this->Activityapplication->Behaviors->load('Containable');
            $results = $this->Activityapplication->find("all", $options);
//            Configure::write('debug',2);
//            debug($rs);exit();
//            exit();
            $this->set(compact('startdate', 'enddate', "results"));
            $this->response->type(array('xls' => 'application/vnd.ms-excel'));
            $this->response->type('xls');
        }
    }

    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "ajax_histories";
        $this->Security->unlockedActions[] = "ajax_updateremarks";
        parent::beforeFilter();
    }

}
