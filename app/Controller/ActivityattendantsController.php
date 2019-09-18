<?php
App::uses('AppController', 'Controller');


class ActivityattendantsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function takeatt($session_id = null, $activity_id = null){

//        Configure::write('debug', 2);
        $this->layout = "withoutmenu";
        if(!$activity_id || !$session_id || !$this->Activityattendant->Activitysession->exists($session_id)){
            throw new NotFoundException(__('Invalid'));
        }

        $this->Activityattendant->Activitysession->Behaviors->load('Containable');
        $activitysession = $this->Activityattendant->Activitysession->find("first",array(
            'conditions'=>array(
                'Activitysession.id'=>$session_id
            ),
            'contain' => array(
                'Activity'
            )
        ));

        //check CutOff Date
        $cutoffdatemsg = '';
        if($this->Cutoffdate->canchange($activitysession['Activitysession']['date'], $cutoffdatemsg)){
            $this->set('cutoffdatemsg', $cutoffdatemsg);
        }else{
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("cutoffdate_msg_title"));
            $this->set('errormsg', __("cutoff_time"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        //點名權限
        if(!$this->Activityattendant->Activitysession->Activity->Eventproposal->isAuth($activitysession['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        //Not Publish
        if(!$activitysession['Activity']['publish']){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("活動還未確認公開"));
            $this->set('errormsg', __("活動於公開後取得活動編號，才能點名。"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        if ($this->request->is(array('post', 'put'))) {
//            print_R($this->request->data);exit();
            $this->Session->setFlash(__('存儲失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00040".')', 'default', array('class'=>'alert alert-danger'));
            $this->Activityattendant->begin();
            if($this->Activityattendant->saveAll($this->request->data)) {
                    $this->Activityattendant->commit();
                    $this->Session->setFlash(__('已存儲'), 'default', array('class'=>'alert alert-success'));
            }
        }

        $this->Activityattendant->Activityapplicant->Behaviors->load('Containable');

        $attendees = $this->Activityattendant->Activityapplicant->find("all",array(
            'conditions'=>array(
                'Activityapplicant.activity_id'=>$activity_id,
                //'Activityapplicant.valid'=>1,
            ),
            "order"=>array(
                "Activityapplicant.valid DESC"
            ),
            'contain' => array(
                'Member',
            )
        ));

        //get atts taken
        $this->Activityattendant->Behaviors->load('Containable');
        $atts = $this->Activityattendant->find('all', array(
            "conditions"=>array(
                "Activityattendant.activitysession_id"=>$session_id
            ),
            "fields"=>array(
                'activityapplicant_id', 'attendant_id' ,"id"
            )
        ));

        $sorted_atts = array();
        if(!empty($atts)){
            foreach($atts as $val){
                $sorted_atts[$val['Activityattendant']['activityapplicant_id']] = $val['Activityattendant'];
            }
        }

        $attendantchoices = $this->Activityattendant->Attendant->find('list');


        $this->set('activitysession', $activitysession);
        $this->set('attendees', $attendees);
        $this->set('atts', $sorted_atts);
        $this->set("attendantchoices", $attendantchoices);
    }

    public function ajax_updateremarks(){
        $this->autoRender = false;
        $remarks = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->Activityattendant->Activitysession->id = $pk;
            $this->Activityattendant->Activitysession->saveField(
                "remarks",
                $remarks
            );
            echo "OK";
        }
    }

    public function update_extraattendant(){
        $this->autoRender = false;
        $extra_attendant = $this->request->data['Activityattendant']['extra_attendant'];
        if(empty($extra_attendant) || $extra_attendant < 0){
            $extra_attendant = 0;
        }
        $pk = $this->request->data['Activityattendant']['id'];

        $this->Activityattendant->Activitysession->Behaviors->load('Containable');
        $activitysession = $this->Activityattendant->Activitysession->find("first",array(
            'conditions'=>array(
                'Activitysession.id'=>$pk
            ),
            'contain' => array(
                'Activity'
            )
        ));

        //check CutOff Date
        $cutoffdatemsg = '';
        if(!$this->Cutoffdate->canchange($activitysession['Activitysession']['date'], $cutoffdatemsg)){
            $this->Session->setFlash(__('cutoff_time').' ('.configure::read("error_prefix")."00040".')', 'default', array('class'=>'alert alert-danger'));
            $this->redirect(array("action"=>"takeatt", $pk, $activitysession['Activity']['id']));
        }

        //點名權限
        if(!$this->Activityattendant->Activitysession->Activity->Eventproposal->isAuth($activitysession['Activity']['eventproposal_id'])){
            $this->Session->setFlash(__('你沒有權限行使用這功能').' ('.configure::read("error_prefix")."00040".')', 'default', array('class'=>'alert alert-danger'));
            $this->redirect(array("action"=>"takeatt", $pk, $activitysession['Activity']['id']));
        }

        if(!empty($pk)){
            $this->Activityattendant->Activitysession->id = $pk;
            $this->Activityattendant->Activitysession->saveField(
                "extra_attendant",
                $extra_attendant
            );
            $this->Session->setFlash(__('成功更新額外出席人數'), 'default', array('class'=>'alert alert-success'));
        }

        $this->redirect(array("action"=>"takeatt", $pk, $activitysession['Activity']['id']));
    }


    public function beforeFilter()
    {
        if($this->request['action'] == 'ajax_updateremarks'){
            $this->Security->unlockedActions[] = "ajax_updateremarks";
        }

        parent::beforeFilter();
    }

}
