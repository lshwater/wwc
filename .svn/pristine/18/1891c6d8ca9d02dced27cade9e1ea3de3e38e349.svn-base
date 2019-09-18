<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 10/8/2019
 * Time: 5:04 PM
 */

App::uses('AppController', 'Controller');

class PaymentitemsController extends AppController {

    public function index(){
        $paymentitems = $this->Paymentitem->find("all");
        $this->set("paymentitems", $paymentitems);
    }

    public function add(){
        if ($this->request->is('post')) {
            $this->Paymentitem->create();
            if ($this->Paymentitem->save($this->request->data)) {
                $this->Session->setFlash(__('成功儲存'), 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('儲存失敗'), 'default', array('class'=>'alert alert-danger'));
            }
        }

        $paymentitemcategories = $this->Paymentitem->Paymentitemcategory->find("list", array(
            "conditions"=>array(
                "Paymentitemcategory.active"=>1
            )
        ));
        $this->set("paymentitemcategories", $paymentitemcategories);
    }

    public function edit($id = null) {
        if (!$this->Paymentitem->exists($id)) {
            throw new NotFoundException(__('Invalid unit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Paymentitem->save($this->request->data)) {
                $this->Session->setFlash(__('成功儲存'), 'default', array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('儲存失敗'), 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Paymentitem.' . $this->Paymentitem->primaryKey => $id));
            $this->request->data = $this->Paymentitem->find('first', $options);
        }

        $paymentitemcategories = $this->Paymentitem->Paymentitemcategory->find("list", array(
            "conditions"=>array(
                "Paymentitemcategory.active"=>1
            )
        ));
        $this->set("paymentitemcategories", $paymentitemcategories);
    }
}
?>