<?php
App::uses('AppController', 'Controller');

class MessagesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    /**
     * index method
     *
     * @return void
     */
    public function inbox() {
        $page = $this->request->params['named']['page'];
        $this->Message->Recipient->Behaviors->load('Containable');
        $this->paginate = array(
            "Recipient"=>array(
                'limit' => 15,
                "order"=>array(
                    "created"=>"DESC"
                ),
                "contain"=>array(
                    "Message.Fromuser",
                ),
                "conditions"=>array(
                    "trash"=>0
                )
            )
        );
        try {
            $messages = $this->Paginator->paginate('Recipient');
        } catch (NotFoundException $e) {
            $this->redirect(array("action"=>"inbox", "page"=>$page-1));
        }

        $this->set('messages', $messages);
    }

    public function sent()
    {
        $page = $this->request->params['named']['page'];
        $this->Message->Behaviors->load('Containable');
        $this->paginate = array(
            "Message"=>array(
                'limit' => 15,
                "order"=>array(
                    "created"=>"DESC"
                ),
                "contain"=>array(
                    "Recipient.User",
                    "Fromuser"
                ),
                "conditions"=>array(
                    "Message.from_id"=>$this->Auth->user('id'),
                    "Message.active"=>1
                )
            )
        );
        try {
            $messages = $this->Paginator->paginate('Message');
        } catch (NotFoundException $e) {
            $this->redirect(array("action"=>"sent", "page"=>$page-1));
        }
        $this->set('messages', $messages);
    }

    public function viewsent($id = null){
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid Message'));
        }
        if(!$this->Message->checkhasright($id)){
            throw new NotFoundException(__('Invalid notification'));
        }
        $this->Message->Behaviors->load('Containable');
        $options = array(
            'conditions' => array(
                'Message.' . $this->Message->primaryKey => $id,
                "Message.active"=>1
            ),
            "contain"=>array(
                "Fromuser",
                "Recipient.User"
            )
        );
        $message = $this->Message->find('first', $options);

        $this->set('message', $message);
        if(!empty($this->request->params['named']['redirect'])){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            $this->set('redirecturl', $redirecturl);
        }
    }

    public function viewstarred(){
        $this->view = "inbox";
        $page = $this->request->params['named']['page'];
        $this->Message->Recipient->Behaviors->load('Containable');
        $this->paginate = array(
            "Recipient"=>array(
                'limit' => 15,
                "order"=>array(
                    "created"=>"DESC"
                ),
                "contain"=>array(
                    "Message.Fromuser",
                ),
                "conditions"=>array(
                    "Recipient.trash"=>0,
                    "Recipient.starred"=>1
                )
            )
        );
        try {
            $messages = $this->Paginator->paginate('Recipient');
        } catch (NotFoundException $e) {
            $this->redirect(array("action"=>"viewstarred", "page"=>$page-1));
        }
        $this->set('messages', $messages);
        $this->set("active_page_id", "email_menu_starred");
        $this->set("pagetitle", '<i class="fa fa-star"></i> '.__("已加上標記"));
    }

    public function trash(){
        $page = $this->request->params['named']['page'];
        $this->Message->Recipient->Behaviors->load('Containable');
        $this->paginate = array(
            "Recipient"=>array(
                'limit' => 15,
                "order"=>array(
                    "created"=>"DESC"
                ),
                "contain"=>array(
                    "Message.Fromuser",
                ),
                "conditions"=>array(
                    $this->Message->Recipient->alias.".trash"=>1,
                    $this->Message->Recipient->alias.".active"=>1
                )
            )
        );
        try {
            $messages = $this->Paginator->paginate('Recipient');
        } catch (NotFoundException $e) {
            $this->redirect(array("action"=>"trash", "page"=>$page-1));
        }
        $this->set('messages', $messages);
    }

    public function sendmsg(){
        $userids = array();
        $defaultmsg = "";
        $title = "";

        if(!empty($this->request->params['named']['replyid'])){
            $replyid = $this->request->params['named']['replyid'];
            if(!$this->Message->checkhasright($replyid)){
                throw new NotFoundException(__('Invalid notification'));
            }
            $this->Message->recursive = 0;
            $replymsg = $this->Message->find("first", array(
                "conditions"=>array(
                    "Message.id"=>$replyid
                )
            ));
            if(!empty($replymsg)){
                if($this->request->params['named']['forward']){
                    $defaultmsg = $replymsg['Message']['msg'];
                    $title = $replymsg['Message']['title'];
                }else{
                    $defaultmsg = "<br /><div style='border-left:3px solid #EEEEEE; padding-left:5px;'>".$replymsg['Message']['from_name']." 於 ".date("Y-m-d h:ia",strtotime($replymsg['Message']['created']))." 寫道： <br />".$replymsg['Message']['msg']."</div>";
                    $title = "RE:".$replymsg['Message']['title'];
                    $userids = $replymsg['Message']['from_id'];
                }
            }
        }
        else{
            $userids = $this->request->params['named']['userids'];
            $defaultmsg = base64_decode(urldecode($this->request->params['named']['defaultmsg']));
            $title = base64_decode(urldecode($this->request->params['named']['title']));
        }

        $this->layout = "withoutmenu";
        if ($this->request->is(array('post', 'put'))) {
//            Configure::write('debug',2);
//            debug($this->request->data);exit();
            $this->Message->create();
            $this->Message->begin();
            if(!empty($this->request->data['Message']['Recipients']) && $this->Message->save($this->request->data)){
                foreach($this->request->data['Message']['Recipients'] as $rcs){
                    $this->Message->Recipient->create();
                    $this->Message->Recipient->save(
                        array(
                            "user_id"=>$rcs,
                            "message_id"=>$this->Message->id,
                            'trash'=>0
                        )
                    );
                }
                $this->Message->commit();
                $this->set('sent', 1);

            }else{
                $this->Session->setFlash(__('發送失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
            }
        }
        $recipients = $this->Message->Recipient->User->find("list", array(
            $this->Message->Recipient->User->alias.'.active'=>1
        ));

        $this->set("defaultmsg", $defaultmsg);
        $this->set("title", $title);
        $this->set('userids', $userids);
        $this->set('recipients', $recipients);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid Message'));
        }
        if(!$this->Message->checkhasright($id)){
            throw new NotFoundException(__('Invalid notification'));
        }
        $this->Message->Behaviors->load('Containable');
        $options = array(
            'conditions' => array('Message.' . $this->Message->primaryKey => $id),
            "contain"=>array(
                "Fromuser",
                "Recipient"=>array(
                    "conditions"=>array(
                        "Recipient.user_id"=>$this->Auth->user("id")
                    )
                )
            )
        );
        $message = $this->Message->find('first', $options);

//        print_r($message);exit();
        $this->set('message', $message);

        $this->Message->Recipient->id = $message['Recipient'][0]['id'];
        $this->Message->Recipient->saveField("read", 1);
        if(!empty($this->request->params['named']['redirect'])){
            $redirecturl = urldecode($this->request->params['named']['redirect']);
            $this->set('redirecturl', $redirecturl);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    //回收
    public function toggletrash($id = null) {
        $this->autoRender = false;
        $ids = array();
        $redirecturl = array("action"=>"inbox");
        if ($this->request->is(array('post', 'put'))) {
            $ids = $this->request->data['messageid'];

            if(!empty($this->request->data['Message']['redirect'])){
                $redirecturl = urldecode($this->request->data['Message']['redirect']);
            }

        }else if(!empty($id)){
            $ids[] = $id;
            if(!empty($this->request->params['named']['redirect'])){
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            }
        }else{
            throw new NotFoundException(__('Invalid Action'));
        }
        //====loop
        foreach($ids as $msgid){
            if(!$this->Message->checkhasright($msgid)){
                throw new NotFoundException(__('Invalid Action'));
            }
            $this->Message->Recipient->updateAll(
                array($this->Message->Recipient->alias.'.trash' => '1 - '.$this->Message->Recipient->alias.'.trash' ),
                array(
                    $this->Message->Recipient->alias.'.message_id' => $msgid,
                    $this->Message->Recipient->alias.'.user_id' => $this->Auth->user("id"),
                )
            );
        }
        //====loop
        $this->redirect($redirecturl);

    }

    public function ajax_togglestarred($id = null) {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');

        if(!$this->Message->checkhasright($id)){
            throw new NotFoundException(__('Invalid notification'));
        }
        $this->Message->Recipient->updateAll(
            array($this->Message->Recipient->alias.'.starred' => '1 - '.$this->Message->Recipient->alias.'.starred' ),
            array(
                $this->Message->Recipient->alias.'.message_id' => $id,
                $this->Message->Recipient->alias.'.user_id' => $this->Auth->user("id"),
            )
        );
        echo json_encode(array('result'=>true));
    }

    //刪除已傳送的
    public function delete_sentmail($id = null){
        $this->autoRender = false;
        $ids = array();
        $redirecturl = array("action"=>"inbox");
        if ($this->request->is(array('post', 'put'))) {
            $ids = $this->request->data['messageid'];

            if(!empty($this->request->data['Message']['redirect'])){
                $redirecturl = urldecode($this->request->data['Message']['redirect']);
            }
        }else if(!empty($id)){
            $ids[] = $id;
            if(!empty($this->request->params['named']['redirect'])){
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            }
        }else{
            throw new NotFoundException(__('Invalid Action'));
        }

        //=======loop======
        foreach($ids as $msgid){
            if(!$this->Message->checkhasright($msgid)){
                throw new NotFoundException(__('Invalid Action'));
            }
            $this->Message->id = $msgid;
            $this->Message->saveField("active", 0);
        }
        //======loop=======
        $this->redirect($redirecturl);
    }

    //永久刪除收件
    public function unlinkmsg($id = null){
        $this->autoRender = false;
        $ids = array();
        $redirecturl = array("action"=>"inbox");
        if ($this->request->is(array('post', 'put'))) {
            $ids = $this->request->data['messageid'];

            if(!empty($this->request->data['Message']['redirect'])){
                $redirecturl = urldecode($this->request->data['Message']['redirect']);
            }
        }else if(!empty($id)){
            $ids[] = $id;
            if(!empty($this->request->params['named']['redirect'])){
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            }
        }else{
            throw new NotFoundException(__('Invalid Action'));
        }
        //=======loop======
        foreach($ids as $msgid){
            if(!$this->Message->checkhasright($msgid)){
                throw new NotFoundException(__('Invalid Action'));
            }
            $this->Message->Recipient->updateAll(
                array($this->Message->Recipient->alias.'.active' => 0 ),
                array(
                    $this->Message->Recipient->alias.'.message_id' => $msgid,
                    $this->Message->Recipient->alias.'.user_id' => $this->Auth->user("id"),
                )
            );
        }
        //======loop=======
        $this->redirect($redirecturl);
    }

    public function ajax_getunmsgs(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        if ($this->request->is(array('post', 'put'))) {
            $timestamp = $this->request->data['timestamp'];
            $rs = $this->Message->getunreadmsgs($timestamp);
            if(!$rs){
                echo json_encode(array('update'=>false));
            }else{
                App::uses('CakeTime', 'Utility');
                for($i = 0; $i < sizeof($rs); $i++){
                    $rs[$i]['Message']['created'] = CakeTime::timeAgoInWords($rs[$i]['Message']['created'],  array(
                        'format' => __('time_format'),
//                        'format' => 'F jS, Y',
                        'accuracy' => array('hour' => 'hour'),
                        'end' => '2 hour'
                    ));
                }
                $return = array(
                    'lastupdatetime'=>time(),
                    'update'=>true,
                    'unread'=>sizeof($rs),
                    'msg'=>$rs
                );
                echo json_encode($return);
            }
        }
    }

    public function beforeFilter() {
        if($this->request['action'] == 'sendmsg'){
            $this->Security->unlockedFields = array('msg');
        }
        if($this->request['action'] == 'toggletrash'){
            $this->Security->unlockedFields = array('messageid');
        }
        if($this->request['action'] == 'unlinkmsg'){
            $this->Security->unlockedFields = array('messageid');
        }
        if($this->request['action'] == 'delete_sentmail'){
            $this->Security->unlockedFields = array('messageid');
        }

        $this->Security->unlockedActions[] = 'ajax_getunmsgs';
        $this->Security->unlockedActions[] = 'ajax_togglestarred';
        $this->Security->unlockedActions[] = 'delete';
        parent::beforeFilter();
    }
}
