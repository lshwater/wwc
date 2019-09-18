<?php
App::uses('AppController', 'Controller');

class EventfinalreportsController extends AppController {

    public function viewdetail($id = null){
        if (!$this->Eventfinalreport->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Eventfinalreport->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Eventproposal",
                "Eventarrangement",
                'Approvalrecordstatus',
                "Attachment.User",
                "Approvalrecord"=>array(
                    "Approvalrecordstatus",
                    "User",
                    "order"=>array(
                        "Approvalrecord.created DESC"
                    )
                ),
                'Financialbalance.User',
                'Financialbalance.Financialbalancedetail.Financialitem',
            ),
            "conditions"=>array(
                $this->Eventfinalreport->alias.".id"=>$id
            )
        );
        $eventfinalreport = $this->Eventfinalreport->find('first', $options);

        if(!empty($eventfinalreport['Eventarrangement'])){
            $tmp_array = array();
            foreach($eventfinalreport['Eventarrangement'] as $val){
                $tmp_array[$val['eventarrangementtype_id']] = $val;
            }
            $eventfinalreport['Eventarrangement'] = $tmp_array;
        }

        $issupervisor = $this->Eventfinalreport->Eventproposal->issupervisor($eventfinalreport['Eventfinalreport']['eventproposal_id']);
        $eventarrangementtypes = $this->Eventfinalreport->Eventarrangement->Eventarrangementtype->find('list', array('order'=>array("id ASC"), 'conditions'=>array('active'=>true)));

        $this->set("issupervisor", $issupervisor);
        $this->set("eventarrangementtypes",$eventarrangementtypes);
        $this->set('eventfinalreport', $eventfinalreport);

    }

    public function add($eventproposal_id = null){
        if (!$this->Eventfinalreport->Eventproposal->exists($eventproposal_id)) {
            throw new NotFoundException(__('Invalid'));
        }
        //check eventproposal is approved
        $eventproposal_check = $this->Eventfinalreport->Eventproposal->find("count", array(
            "conditions"=>array(
                "AND"=>array(
                    $this->Eventfinalreport->Eventproposal->alias.".id"=>$eventproposal_id,
                    $this->Eventfinalreport->Eventproposal->alias.".approved"=>1
                )
            )
        ));
        if($eventproposal_check == 0){
            $this->Session->setFlash(__('活動必須先核閲。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array("controller"=>"eventproposals", "action"=>"view", $eventproposal_id));
        }

        //check unique
        $check = $this->Eventfinalreport->find("count", array(
           "conditions"=>array(
                "eventproposal_id"=>$eventproposal_id
           )
        ));
        if($check != 0){
            $this->Session->setFlash(__('活動報告書已經存在。'), 'default', array('class' => 'alert alert-danger'));
            $this->redirect(array("controller"=>"eventproposals", "action"=>"view", $eventproposal_id));
        }else{
            $this->Eventfinalreport->create();
            $this->Eventfinalreport->save(
                array("eventproposal_id"=>$eventproposal_id)
            );
            $this->Session->setFlash(__('新增成功'), 'default', array('class'=>'alert alert-success'));
            $this->redirect(array("controller"=>"eventfinalreports", "action"=>"edit", $this->Eventfinalreport->id));
        }
    }

    public function edit($id = null){
        if (!$this->Eventfinalreport->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Eventfinalreport->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Eventproposal.User",
                "Eventproposal.Supervisors",
                'Approvalrecordstatus',
                "Eventarrangement"
            ),
            "conditions"=>array(
                $this->Eventfinalreport->alias.".id"=>$id
            )
        );
        $eventfinalreport = $this->Eventfinalreport->find('first', $options);

        if ($this->request->is('post') || $this->request->is('put')) {
//            Configure::write('debug', 2);
            $this->Eventfinalreport->begin();
            // update proposal status
            //如已批閱
            if($eventfinalreport['Approvalrecordstatus']['needrequest'] != 1 && $eventfinalreport['Approvalrecordstatus']['needalert'] != 1){
                $this->request->data['Eventfinalreport']['approvalrecordstatus_id'] = 5;
                $supervisor_ids = array();
                foreach($eventfinalreport['Eventproposal']['Supervisors'] as $su){
                    $supervisor_ids[] = $su['id'];
                }
                $requesttime = date("Y-m-d G:i");
                $urllink = Router::url(array('action'=>'viewdetail', $id), true);
                $this->loadModel("Notification");
                $msg = <<<HTML
活動報告書批閱要求

活動計劃書名稱︰{$eventfinalreport['Eventproposal']['name']}
負責人︰{$eventfinalreport['Eventproposal']['User']['name']}
要求時間︰{$requesttime}
有關活動計劃書的連結︰{$urllink}
HTML;
                $this->Notification->addnotices($msg, "活動報告書 [".h($eventfinalreport['Eventproposal']['name'])."]: 批閱要求", $supervisor_ids, array("from_name"=>"系統"));

            }

//            $this->Eventproposal->Eventproposalprocedure->deleteAll(array('eventproposal_id' => $id),false);
            if($this->Eventfinalreport->saveAssociated($this->request->data)){
                $this->Eventfinalreport->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("action"=>'viewdetail', $this->Eventfinalreport->id));
            }else{
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00035".')', 'default', array('class'=>'alert alert-danger'));
            }
        }else{

            $this->request->data = $eventfinalreport;

        }
        $eventarrangementtypes = $this->Eventfinalreport->Eventarrangement->Eventarrangementtype->find('list', array('order'=>array("id ASC"), 'conditions'=>array('active'=>true)));

        if(!empty($this->request->data['Eventarrangement'])){
            $tmp_array = array();
            foreach($this->request->data['Eventarrangement'] as $val){
                $tmp_array[$val['eventarrangementtype_id']] = $val;
            }
            $this->request->data['Eventarrangement'] = $tmp_array;
        }
//        Configure::write('debug', 2);
//        debug($this->request->data['Eventarrangement']);
        $this->set("eventarrangementtypes",$eventarrangementtypes);
        $this->set("eventfinalreport", $eventfinalreport);
    }

    public function requestapproval($id = null){
        if (!$this->Eventfinalreport->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        if ($this->request->is('post')) {
            $this->Eventfinalreport->id = $id;
            $this->Eventfinalreport->saveField("approvalrecordstatus_id", 2);
            if ($this->request->params['named']['redirect']) {
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            } else {
                $redirecturl = array('action' => 'viewdetail', $id);
            }
            return $this->redirect($redirecturl);

        }
    }

    public function doapproval($id = null){
        if(!$this->Eventfinalreport->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }

        $eventfinalreport = $this->Eventfinalreport->findById($id);
        if($eventfinalreport['Approvalrecordstatus']['needalert'] != 1){
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is('post')) {
            $error = false;
            $this->request->data['Approvalrecord']['model'] = "Eventfinalreport";
            $this->request->data['Approvalrecord']['model_id'] = $id;
            $this->request->data['Approvalrecord']['user_id'] = $this->Auth->user("id");
            $this->request->data['Approvalrecord']['approvaldate'] = date('Y-m-d');

            $this->Eventfinalreport->begin();
            $this->Eventfinalreport->Approvalrecord->create();
            if($this->Eventfinalreport->Approvalrecord->save($this->request->data['Approvalrecord'])){
                $this->Eventfinalreport->id = $id;

                if(!$this->Eventfinalreport->saveField("approvalrecordstatus_id", $this->request->data['Approvalrecord']['approvalrecordstatus_id'])){
                    $error = true;
                }
                $sts = $this->Eventfinalreport->Approvalrecordstatus->findById($this->request->data['Approvalrecord']['approvalrecordstatus_id']);
                if(!$this->Eventfinalreport->saveField("approved", $sts['Approvalrecordstatus']['changeapprovalstatusto'])){
                    $error = true;
                }

                if(!$error){
                    $this->Eventfinalreport->commit();
                    $this->Session->setFlash(__('成功回應'), 'default', array('class'=>'alert alert-success'));
                    if ($this->request->params['named']['redirect']) {
                        $redirecturl = urldecode($this->request->params['named']['redirect']);
                    } else {
                        $redirecturl = array("controller"=>"Eventproposal", 'action' => 'view', $id);
                    }
                    return $this->redirect($redirecturl);
                }
            }
            if($error){
                $this->Session->setFlash(__('回應失敗').' ('.configure::read("error_prefix")."00036".')', 'default', array('class'=>'alert alert-danger'));
            }
        }

        $approvalrecordstatuses = $this->Eventfinalreport->Approvalrecordstatus->find('list', array(
            'conditions'=>array(
                "canapprove"=>1,
            )
        ));
        $this->set('approvalrecordstatuses', $approvalrecordstatuses);
        $this->set("eventfinalreport_id", $id);
    }

    public function beforeFilter(){
        parent::beforeFilter();
    }

}
