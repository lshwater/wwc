<?php
App::uses('AppController', 'Controller');


class ActivitysessionsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg', "DataTable");

    /**
     * index method
     *
     * @return void
     */
    public function addsession($activivty_id = null){
        if(!$this->Activitysession->Activity->exists($activivty_id)){
            throw new NotFoundException(__('Invalid'));
        }
        $activity = $this->Activitysession->Activity->findById($activivty_id);
        //check right
        if(!$this->Activitysession->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("禁止"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        if ($this->request->is('post')) {
            if($this->request->data['Activitysession']['repeat']
                && !empty($this->request->data['Activitysession']['repeatuntil'])
                && (strtotime($this->request->data['Activitysession']['repeatuntil']) > strtotime($this->request->data['Activitysession']['date']))
            ){
                //repeat create
                $this->Activitysession->begin();
                date_default_timezone_set('Etc/UTC');
                $startDateTime = $this->request->data['Activitysession']['date'];
                $repeatEndDate = $this->request->data['Activitysession']['repeatuntil'];
                $unit  = $this->request->data['Activitysession']['repeat'];
                $repeatStart = new DateTime($startDateTime);
                $repeatEnd   = new DateTime($repeatEndDate." 23:59:59");
                $interval = new DateInterval("P1{$unit}");
                $period   = new DatePeriod($repeatStart, $interval, $repeatEnd);
                $count = 0;
                foreach ($period as $key => $date ) {
                    if($count < 30){
                        $data2save = array();
                        $this->Activitysession->create();
                        $data2save = $this->request->data;
                        $data2save['Activitysession']['user_id'] = $this->Auth->user("id");
                        $data2save['Activitysession']['date'] = $date->format('Y-m-d');
                        if(!$this->Activitysession->save($data2save)){
                            $this->Session->setFlash(__('成功失敗'), 'default', array('class'=>'alert alert-danger'));
                            $this->redirect(array("controller"=>"eventproposals","action"=>'view', $activity['Eventproposal']['id'], "#"=>"tab".$activivty_id));
                        }
                        $count++;
                    }
                    else{
                        break;
                    }
                }
                $this->Activitysession->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("controller"=>"eventproposals","action"=>'view', $activity['Eventproposal']['id'], "#"=>"tab".$activivty_id));

            }else{
                $data2save = array();
                $this->Activitysession->create();
                $data2save = $this->request->data;
                $data2save['Activitysession']['user_id'] = $this->Auth->user("id");
                if($this->Activitysession->save($data2save)){
                    $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                    $this->redirect(array("controller"=>"eventproposals","action"=>'view', $activity['Eventproposal']['id'], "#"=>"tab".$activivty_id));
                }else{
                    $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00037".')', 'default', array('class'=>'alert alert-danger'));
                }
            }
        }

        $this->set("countusers", $this->Activitysession->Activity->Eventproposal->getuserlist($activity['Activity']['eventproposal_id']));
        $this->set("activity", $activity);
    }

    public function edit($id = null){
        if(!$this->Activitysession->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activitysession->Behaviors->load('Containable');
        $activitysession = $this->Activitysession->find('first', array(
            "conditions"=>array(
                'Activitysession.id'=>$id
            ),
            'contain'=>array(
                'Activity.Eventproposal'
            )
        ));

        //check right
        if(!$this->Activitysession->Activity->Eventproposal->isAuth($activitysession['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        $cutoffdatemsg = '';
        if($this->Cutoffdate->canchange($activitysession['Activitysession']['date'], $cutoffdatemsg)){
            $this->set('cutoffdatemsg', $cutoffdatemsg);
        }else{
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("cutoffdate_msg_title"));
            $this->set('errormsg', __("cutoff_time"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        if ($this->request->is(array('post', 'put'))) {
            if($this->Activitysession->save($this->request->data)){
                $this->Session->setFlash(__('成功'), 'default', array('class'=>'alert alert-success'));
                if($this->request->params['named']['redirect']){
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                }else{
                    $this->redirect(array("controller"=>"eventproposals","action"=>'view', $activitysession['Activity']['eventproposal_id'], "#"=>"tab".$activitysession['Activity']['id']));
                }
                return $this->redirect($redirecturl);

            }else{
                $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00038".')', 'default', array('class'=>'alert alert-danger'));
            }
        }else{
            $options = array('conditions' => array('Activitysession.' . $this->Activitysession->primaryKey => $id));
            $this->request->data = $this->Activitysession->find('first', $options);
        }
        $this->set("countusers", $this->Activitysession->Activity->Eventproposal->getuserlist($activitysession['Activity']['eventproposal_id']));
        $this->set("activitysession", $activitysession);
    }


    public function lists(){
        $this->set('users',$this->Activitysession->Countuser->find("list", array("conditions"=>array("active"=>1))));

    }

    public function ajax_search(){
        $cond = array();

        if(!empty($this->request->query['countuserid'])){
            $cond['Activitysession.countuser_id'] = $this->request->query['countuserid'];
        }

        if($this->request->query['startdate'] && $this->request->query['enddate']){
            $startdate = date_parse($this->request->query['startdate']);
            $enddate = date_parse($this->request->query['enddate']);
            if (
                $startdate["error_count"] ===0 && checkdate($startdate["month"], $startdate["day"], $startdate["year"]) &&
                $enddate["error_count"] === 0 && checkdate($enddate["month"], $enddate["day"], $enddate["year"])
            ){
                $cond['Activitysession.date BETWEEN ? AND ?'] = array($this->request->query['startdate'], $this->request->query['enddate']);
            }
        }
        $this->autoRender = false;
        $this->paginate = array(
            'link' => array(
                'Activity',
                'Countuser'
            ),
            'fields' => array(
                'Activitysession.id',
                "Activitysession.date",
                "Activitysession.starttime",
                "Activitysession.endtime",
                "Activitysession.session",
                "Activity.name",
                "Activity.activity_code"
            ),
            "conditions"=>$cond,
            'order' => 'Activitysession.date ASC',
        );
        $this->DataTable->mDataProp = true;
        echo json_encode($this->DataTable->getResponse());
    }

    public function delete($id = null) {
        $this->Activitysession->id = $id;
        if (!$this->Activitysession->exists()) {
            throw new NotFoundException(__('Invalid'));
        }
        $activitysession = $this->Activitysession->findById($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Activitysession->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00039".')', 'default', array('class'=>'alert alert-danger'));
        }

        if($this->request->params['named']['redirect']){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
        }else{
            $redirecturl = array("controller"=>"eventproposals","action"=>'view', $activitysession['Activity']['eventproposal_id'], "#"=>"tab".$activitysession['Activity']['id']);
        }
        return $this->redirect($redirecturl);

    }

    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "ajax_search";
        parent::beforeFilter();
    }

}
