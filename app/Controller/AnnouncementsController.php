<?php
App::uses('AppController', 'Controller');

class AnnouncementsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function index(){
        $this->Announcement->Group->Behaviors->load('Containable');
        $announcements = $this->Announcement->Group->find('first', array(
            'contain'=>array(
                'Announcement'=>array(
                    'Fromuser'=>array(
                        'fields'=>array(
                            'name'
                        )
                    ),
                    "AnnouncementUser"=>array(
                        "conditions"=>array(
                            "user_id"=>$this->Auth->user('id')
                        ),
                    ),
                    "order"=>array(
                        "Announcement.created"=>"DESC",
                    ),
                    'fields'=>array(
                        'id', 'title', 'created', 'modified', 'needconfirm'
                    )
                )
            ),
            'conditions'=>array(
                'Group.id'=>$this->Session->read('Auth.groupsusers')
            )
        ));
        $this->set('announcements', $announcements['Announcement']);
    }

    public function management(){
        $this->Announcement->recursive = 0;
        $this->set('announcements', $this->Announcement->find('all'));
    }

    public function view($id = null){
//        Configure::write('debug', 2);
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid Announcement'));
        }
        $this->Announcement->Behaviors->load('Containable');
        $options = array(
            'conditions' => array('Announcement.' . $this->Announcement->primaryKey => $id),
            'contain'=>array(
                'AnnouncementUser'=>array(
                    'conditions'=>array(
                        'user_id'=>$this->Auth->user('id')
                    )
                ),
                "Fromuser",
                "Group"
            )
        );
        $announcement = $this->Announcement->find('first', $options);

        if($announcement['Announcement']['needconfirm'] && $this->Session->read('Auth.superadmin')){
            $groups = array();
            if(!empty($announcement['Group'])){
                foreach($announcement['Group'] as $gp){
                    $groups[] = $gp['id'];
                }
            }
            $alluser = $this->Announcement->AnnouncementUser->User->getuserrolelist($groups, true);

            $this->Announcement->AnnouncementUser->Behaviors->load('Containable');
            $analyst = $this->Announcement->AnnouncementUser->find('list', array(
                'conditions'=>array(
                    'announcement_id'=>$id,
                ),
                "fields"=>array(
                    'user_id','created'
                ),
                "callbacks"=>false
            ));
//            print_R($analyst);exit();
            $this->set('alluser', $alluser);
            $this->set('analyst', $analyst);
        }


        $userneedconfirm = false;
        $groupsusers = $this->Session->read('Auth.groupsusers');
        if(!empty($announcement['Group'])){
            foreach($announcement['Group'] as $g){
                if(in_array($g['id'], $groupsusers)){
                    $userneedconfirm = true;
                }
            }
        }

        if(!empty($this->request->params['named']['redirect'])){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
        }else{
            $redirecturl = array('action'=>"index");
        }

        $this->set('announcement', $announcement);
        $this->set("userneedconfirm", $userneedconfirm);
        $this->set('redirecturl', $redirecturl);
    }

    public function add(){
        if ($this->request->is('post')) {
            if($this->Announcement->save($this->request->data)){
                $this->Session->setFlash(__('發佈成功'), 'default', array('class'=>'alert alert-success'));
                if(!empty($this->request->params['named']['redirect'])){
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                    $this->redirect($redirecturl);
                }else{
                    $this->redirect(array('action' => 'management'));
                }
            }else{
                $this->Session->setFlash(__('發佈失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
            }
        }
        $this->set("groups",  $this->Announcement->Group->find('list'));
    }

    public function edit($id = null){
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid Announcement'));
        }
        $options = array(
            'conditions' => array('Announcement.' . $this->Announcement->primaryKey => $id),

        );
        $announcement = $this->Announcement->find('first', $options);

        if ($this->request->is(array('post', 'put'))) {
            if($this->Announcement->save($this->request->data)){
                $this->Session->setFlash(__('更新成功'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'management'));
            }else{
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
            }
        }else{
            $this->request->data = $announcement;
        }
        $this->set("groups",  $this->Announcement->Group->find('list'));
    }

    public function ajax_toggletop($id = null){
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid Announcement'));
        }
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');

        $this->Announcement->updateAll(
            array($this->Announcement->alias.'.top' => '1 - '.$this->Announcement->alias.'.top' ),
            array(
                $this->Announcement->alias.'.id' => $id,
            )
        );
        echo json_encode(array('result'=>true));
    }

    public function readconfirm($id = null){
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid Announcement'));
        }
        if ($this->request->is('post')) {
            $data2save = array(
                'AnnouncementUser'=>array(
                    "announcement_id"=>$id,
                    'user_id'=>$this->Auth->user('id')
                )
            );
            $this->Announcement->AnnouncementUser->save($data2save);
        }
        if(!empty($this->request->params['named']['redirect'])){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            $this->redirect($redirecturl);
        }else{
            $this->redirect(array('action' => 'management'));
        }
    }

    public function delete($id = null) {
        $this->Announcement->id = $id;
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid Announcement'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Announcement->delete()) {
            $this->Session->setFlash("成功", 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash("失敗", 'default', array('class'=>'alert alert-danger'));
        }

        if(!empty($this->request->params['named']['redirect'])){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            $this->redirect($redirecturl);
        }else{
            $this->redirect(array('action' => 'management'));
        }
    }

    public function beforeFilter()
    {
        if($this->request['action'] == 'add'){
            $this->Security->unlockedFields = array('content');
        }
        if($this->request['action'] == 'edit'){
            $this->Security->unlockedFields = array('content');
        }
        $this->Security->unlockedActions[] = 'ajax_toggletop';
        parent::beforeFilter();
    }

}
