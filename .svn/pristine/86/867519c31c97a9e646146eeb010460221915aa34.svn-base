<?php
App::uses('AppController', 'Controller');


class ActivitiesController extends AppController
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
    public function add($eventproposal_id = null, $clone_activity_id = null)
    {
        if(!$this->Activity->Eventproposal->isAuth($eventproposal_id)){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        $clone = $this->Activity->find("first", array(
           "conditions"=>array(
               $this->Activity->alias.".id"=>$clone_activity_id
           ),
            "recursive"=>-1
        ));

        if ($this->request->is('post')) {
        //Configure::write('debug', 2);
            $this->Activity->begin();
            $this->Activity->create();
            $this->request->data['Activity']['user_id'] = $this->Auth->user("id");

            if(!empty($this->request->data['Activityfee'])){
                foreach($this->request->data['Activityfee'] as $key=>$eachfee){
                    if(empty($eachfee['fee']) && $eachfee != 0){
                        $this->request->data['Activityfee'][$key]['fee'] = $this->request->data['Activity']['fee'];
                    }
                }
            }
            if($this->Activity->saveAssociated($this->request->data, array('deep'=>true))) {
                //$this->Activity->gencode($this->Activity->id);
                $this->Activity->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $eventproposal_id));
            }else{
                $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00041".')', 'default', array('class'=>'alert alert-danger'));
            }
        }

        $this->Activity->Eventproposal->recursive = -1;

        $eventproposal = $this->Activity->Eventproposal->find("first", array(
           "conditions"=>array(
                "Eventproposal.id"=>$eventproposal_id
           )
        ));

        $membertypes = $this->Activity->Activityfee->Membertype->find("list", array("conditions"=>array($this->Activity->Activityfee->Membertype->alias.".active"=>1)));
        $activitygroups = $this->Activity->Activitygroup->find("list");
        $activitytypes = $this->Activity->Activitytype->find("list");
        $countusers = $this->Activity->Eventproposal->getuserlist($eventproposal_id);
        $units = $this->Activity->Unit->find("list", array("conditions"=>array($this->Activity->Unit->alias.".active"=>1)));

        $this->set("clone", $clone);
        $this->set("units", $units);
        $this->set("countusers", $countusers);
        $this->set("activitytypes", $activitytypes);
        $this->set("activitygroups", $activitygroups);
        $this->set("membertypes",$membertypes);
        $this->set("eventproposal",$eventproposal);
    }

    public function edit($id = null)
    {
        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }

        $activity = $this->Activity->findById($id);

        if(!$this->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        $this->set('activity', $activity);

        if ($this->request->is(array('post', 'put'))) {
            if($this->Activity->saveAssociated($this->request->data, array('deep'=>true))) {
                $this->Session->setFlash(__('成功'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id'], "#"=>"tab".$id));
            }else{
                $this->Session->setFlash(__('失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00042".')', 'default', array('class'=>'alert alert-danger'));
            }
       }else{
            $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
            $this->request->data = $this->Activity->find('first', $options);
            if(!empty($this->request->data['Activityfee'])){
                $tmpfee = array();
                foreach($this->request->data['Activityfee'] as $fee){
                    $tmpfee[$fee['membertype_id']] = $fee;
                }
                $this->request->data['Activityfee'] = $tmpfee;
            }
        }
        $membertypes = $this->Activity->Activityfee->Membertype->find("list", array("conditions"=>array($this->Activity->Activityfee->Membertype->alias.".active"=>1)));
        $activitygroups = $this->Activity->Activitygroup->find("list");
        $activitytypes = $this->Activity->Activitytype->find("list");
        $issupervisor = $this->Activity->Eventproposal->issupervisor($activity['Activity']['eventproposal_id']);
        $countusers = $this->Activity->Eventproposal->getuserlist($activity['Activity']['eventproposal_id']);
        $units = $this->Activity->Unit->find("list", array("conditions"=>array($this->Activity->Unit->alias.".active"=>1)));

        $this->set("units", $units);
        $this->set("countusers", $countusers);
        $this->set("issupervisor", $issupervisor);
        $this->set("activitytypes", $activitytypes);
        $this->set("activitygroups", $activitygroups);
        $this->set("membertypes",$membertypes);
    }

    public function view($id = null)
    {
        //$this->layout = "ajax";

        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
//        Configure::write('debug', 2);
        $this->Activity->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Eventproposal",
                "User",
                "Activityfee.Membertype",
                "Activitysession"=>array(
                    "order"=>"Activitysession.date ASC"
                ),
                'Activityapplicant'=>array(
                    "fields"=>array(
                        "Activityapplicant.id"
                    ),
                    "conditions"=>array(
                        "Activityapplicant.valid"=>1
                    )
                ),
            ),
            "conditions"=>array(
                $this->Activity->alias.".id"=>$id
            )
        );
        $activity = $this->Activity->find('first', $options);
//        debug($activity);
        $volunteertypes = $this->Activity->ActivitiesVolunteer->Volunteer->Volunteertype->find("list");

        $this->set("volunteertypes", $volunteertypes);
        $this->set('ac', $activity);
    }

    public function enrolsearch(){
        //$this->layout = "withoutmenu";
//        Configure::write('debug',2);
        $this->Activity->Behaviors->load('Containable');
        $activities = $this->Activity->find("all", array(
            "conditions"=>array(
                "AND"=>array(
                    $this->Activity->alias.".enrolstart <= CURDATE()",
                    $this->Activity->alias.".enrolend >= CURDATE()",
                    $this->Activity->alias.".active"=>1,
                    $this->Activity->alias.".publish"=>1,
                    $this->Activity->alias.".closed"=>0
                )
            ),
            "fields"=>array(

            ),
            "contain"=>array(
                "Activityapplicant"=>array(
                    "fields"=>array(
                        "id"
                    ),
                    "conditions"=>array(
                        "Activityapplicant.valid"=>1
                    )
                )
            )
        ));
//        debug($activities);
        $volunteertypes = $this->Activity->ActivitiesVolunteer->Volunteer->Volunteertype->find("list");

        $this->set("volunteertypes", $volunteertypes);
        $this->set('activities', $activities);
    }

    public function alllist(){
        $volunteertypes = $this->Activity->ActivitiesVolunteer->Volunteer->Volunteertype->find("list");

        $this->set("volunteertypes", $volunteertypes);
    }

    public function mylist(){

    }

    public function publish($id = null){
        $this->autoRender = false;
        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activity->id = $id;
        $this->Activity->begin();
        if($this->Activity->saveField("publish", 1)){
            $this->Activity->gencode($this->Activity->id);
            $this->Activity->commit();
            $this->Session->setFlash(__('活動已公開'), 'default', array('class'=>'alert alert-success'));
        }else{
            $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
        }

        $activity = $this->Activity->findById($id);
        $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id'], "#"=>"tab".$id));
    }

    public function chactive($id = null, $status = 0){
        $this->autoRender = false;
        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activity->recursive = -1;
        $activity = $this->Activity->findById($id);
        if(!$this->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        if($status != 0 && $status != 1){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activity->id = $id;
        if($this->Activity->saveField("active", $status)){
            $this->Session->setFlash(__('活動成功更新'), 'default', array('class'=>'alert alert-success'));
        }else{
            $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
        }


        $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id'], "#"=>"tab".$id));
    }

    public function reopen($id = null){
        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Activity->recursive = -1;
        $activity = $this->Activity->findById($id);
        if(!$this->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        if ($this->request->is('post')) {
            $this->Activity->id = $id;
            $this->Activity->saveField("closed", 0);
            $this->Activity->saveField("issuccess", NULL);
            $this->Activity->saveField("closereason_id", NULL);
            $this->Activity->saveField("closereason", NULL);

            $this->Session->setFlash(__('取消完結成功'), 'default', array('class'=>'alert alert-success'));
            $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id'], "#"=>"tab".$id));
        }
    }

    public function close($id = null){
        if(!$this->Activity->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $activity = $this->Activity->findById($id);
        if(!$this->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        if ($this->request->is('post')) {
            if($this->Activity->save($this->request->data)) {
                $this->Session->setFlash(__('活動已完結'), 'default', array('class'=>'alert alert-success'));
            }else{
                $this->Session->setFlash(__('新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00041".')', 'default', array('class'=>'alert alert-danger'));
            }

            $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id'], "#"=>"tab".$id));
        }

        $closereasons = $this->Activity->Closereason->find("list", array(
                "order"=>array(
                    "Closereason.id ASC"
                ),
                "conditions"=>array(
                    "active"=>1
                )
            )
        );

        $this->set("closereasons", $closereasons);
        $this->set("activity", $activity);
    }

    public function ajax_search($me = ''){

        $cond = array();


        if($me == "me"){
            $publish = isset($this->request->params['named']['publish'])?$this->request->params['named']['publish']:1;
            if($publish === 1 || $publish === 0){
                $cond['publish'] = $publish;
            }

            $cond['countuser_id'] = $this->Auth->user('id');
        }else{
            $cond['publish'] = 1;
        }

        if($this->request->query['startdate'] && $this->request->query['enddate']){
            $startdate = date_parse($this->request->query['startdate']);
            $enddate = date_parse($this->request->query['enddate']);
            if (
                $startdate["error_count"] ===0 && checkdate($startdate["month"], $startdate["day"], $startdate["year"]) &&
                $enddate["error_count"] === 0 && checkdate($enddate["month"], $enddate["day"], $enddate["year"])
            ){
                $cond['startdate BETWEEN ? AND ?'] = array($this->request->query['startdate'], $this->request->query['enddate']);
             }
        }

        $this->autoRender = false;
        $this->paginate = array(
            'fields' => array(
                'Activity.id',
                'Activity.activity_code',
                "Activity.name",
                "Activity.startdate",
                "Activity.enddate",
                "Activity.eventproposal_id",
            ),
            "conditions"=>$cond,
            'order' => 'Activity.activity_code ASC',
        );
        $this->DataTable->mDataProp = true;
        echo json_encode($this->DataTable->getResponse());
    }

    public function delete($id = null)
    {
        $this->Activity->id = $id;
        if (!$this->Activity->exists()) {
            throw new NotFoundException(__('Invalid Activity'));
        }

        $activity = $this->Activity->findById($id);
        if(!$this->Activity->Eventproposal->isAuth($activity['Activity']['eventproposal_id'])){
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        if($activity['Activity']['publish']){
            $this->Session->setFlash(__('活動公開後不能刪除'), 'default', array('class' => 'alert alert-danger'));
        }else{
            $this->request->allowMethod('post', 'delete');
            $this->Activity->id = $id;
            if ($this->Activity->delete()) {
                $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $activity['Activity']['eventproposal_id']));
    }

    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "ajax_search";
        parent::beforeFilter();
    }

}
