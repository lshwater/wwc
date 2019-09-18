<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Search.Prg');

/**
 * index method
 *
 * @return void
 */
	public function index() {
//        Configure::write('debug', 2);
        $this->User->recursive = 0;
		$this->set('users', $this->User->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->User->Behaviors->load('Containable');
		$options = array(
			'conditions' => array(
				'User.' . $this->User->primaryKey => $id
			),
			'contain'=>array(
                'Group',
                'Unit',
				'CustomField',
                'CustomField.Userinputfield',
                'CustomField.Userinputfield.Inputtype',
                'CustomField.Userinputfield.Selectionlist',
                'CustomField.Userinputfield.Selectionlist.Selectionitem'
			),
		);
        $user = $this->User->find('first', $options);
		$this->set('user', $user);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
            $orgcode = $this->request->data['User']['code'];
            $this->User->begin();
			if ($this->User->saveAssociated($this->request->data, array('deep'=>true))) {
                if($this->User->UsersPassword->changepasswordrecord($this->User->id, $this->request->data['User']['password'])){
                    $this->User->commit();
                    $this->Session->setFlash(__('The users has been saved'), 'default', array('class'=>'alert alert-success'));
                    $this->redirect(array('action'=>'index'));
                }

			} else {
                $this->request->data['User']['code'] = $orgcode;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
			}
                $this->User->rollback();
		}
		$groups = $this->User->Group->find('list', array('conditions'=>array('cancreate'=>1)));
        $units = $this->User->Unit->find('list');
		$this->User->CustomField->Userinputfield->Behaviors->load('Containable');
		$customfields = $this->User->CustomField->Userinputfield->find('all', array(
				'contain'=>array(
					'Inputtype'=>array('fields'=>array('htmltype', 'type')), 
					'Selectionlist',
					'Selectionlist.Selectionitem'
				)
			)
		);

		$this->set(compact('groups', 'units', 'customfields'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {


		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->saveAssociated($this->request->data, array('deep'=>true))) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array('class'=>'alert alert-success'));

                if($this->request->params['named']['redirect']){
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                }else{
                    $redirecturl = array('action'=>'index');
                }

				return $this->redirect($redirecturl);
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
			}
		} else {

            $this->User->Behaviors->load('containable');
			$options = array(
                'conditions' => array('User.' . $this->User->primaryKey => $id),
                'contain'=>array(
                    'CustomField',
                    'Group',
                    'Unit',
                    'Viewunit'
                )
            );
			$this->request->data = $this->User->find('first', $options);
            $this->request->data['CustomField'] = Set::combine($this->request->data['CustomField'], '{n}.userinputfield_id', "{n}");
		}

        if(!$this->request->data['User']['editable']){
            $this->redirect(array('action' => 'index'));
        }

        $this->User->CustomField->Userinputfield->Behaviors->load('Containable');
        $customfields = $this->User->CustomField->Userinputfield->find('all', array(
                'contain'=>array(
                    'Inputtype'=>array('fields'=>array('htmltype', 'type')),
                    'Selectionlist',
                    'Selectionlist.Selectionitem'
                )
            )
        );
        $customfields = Set::combine($customfields, '{n}.Userinputfield.id', "{n}");

		$groups = $this->User->Group->find('list', array('conditions'=>array('cancreate'=>1)));
		$units = $this->User->Unit->find('list');

		$this->set(compact('groups', 'units', 'customfields'));
	}

    public function login() {
//        Configure::write('debug',2);
        $this->layout = "blank";
        if ($this->Auth->loggedIn()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            $this->loadModel('Protect');
            if($this->Protect->access($this->request->data['User']['username'],'login',3)){
                if ($this->Auth->login()) {
//                    $clientrd = $this->User->findById($this->Auth->user('id'));
//                    $lstpwd = new DateTime($clientrd['UsersPassword'][0]['created']);
//                    $date1 = new DateTime("now");
//                    $interval = $lstpwd->diff($date1)->days+1;
//                    if($interval > 90){
//                        $this->Session->setFlash(__('你己經有'.$interval."日未更改密碼，請盡快更新密碼！"), 'default', array('class'=>'alert alert-warning'));
//                        return $this->redirect(array('action'=>'chpass'));
//                    }

                    return $this->redirect($this->Auth->redirectUrl());

                } else {
                    $this->Protect->fail($this->request->data['User']['username'],'login',"5m");
                    $this->Session->setFlash(
                        __('Username or password is incorrect'),
                        'default',
                        array() ,
                        'auth'
                    );
                }
            }
            else{
                $this->Session->setFlash(
                    "連續3次輸入密碼錯誤, 請5分鐘後再試。",
                    'default',
                    array('class'=>'alert alert-warning'),
                    'auth'
                );
            }

        }
    }
	
	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

    public function chpass(){
        if ($this->request->is('post')) {
            $this->User->id  = $this->Auth->user('id');
            $this->User->begin();
            if ($this->User->save($this->data)) {
                if($this->User->UsersPassword->changepasswordrecord($this->User->id, $this->data['User']['password'])){
                    $this->User->commit();
                    $this->Session->setFlash(__('Password has been changed.'), 'default', array('class'=>'alert alert-success'));
                    $this->redirect($this->Auth->redirect());
                }

            }
            $this->User->rollback();
        }
    }

    public function myaccount() {
//        Configure::write('debug', 2);
        $this->User->Behaviors->load('Containable');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];

        $options = array(
            'conditions' => array('User.' . $this->User->primaryKey => $user_id),
            'contain'=>array(
                "Unit", "Group", "UsersPassword"
            )
        );
        $user = $this->User->find('first', $options);
        $this->set('user', $user);

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
        $this->request->data = $this->User->find('first', $options);
    }

    public function updatehorn(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        if ($this->request->is('post') || $this->request->is('put')) {
            //checking
            $HttpSocket = new HttpSocket();

            $user = $this->User->findById($this->Auth->user("id"));
            $old_horn_clientid = $user['User']["horn_clientid"];
            $this->request->data['User']['id'] = $this->Auth->user("id");

            if(!empty($this->request->data['User']['horn_clientid'])){
                //addSubscription
                if(empty($old_horn_clientid) && $this->request->data['User']['horn_clientid'] != $old_horn_clientid){
                    $url = "http://pushapps.hypoidea.com/subscriptions/api_addSubscription";
                    $data = array(
                        "sender_token"=>configure::read("PushApps.token"),
                        "user_name"=>$this->request->data['User']['horn_clientid'],
                        "user_account"=>$this->Auth->user('username')
                    );
                    $results = $HttpSocket->post($url, json_encode($data), array(
                        "header"=>array(
                            "Content-Type"=>"application/x-www-form-urlencoded"
                        )
                    ));
                    $body = json_decode($results->body(), true);
                    if(!$body['result']['success']){
                        echo json_encode(
                            array(
                                "result"=>false,
                                "msg"=>"更新失敗，請稍後嘗試。"
                            )
                        );
                        exit();
                    }
                }
                //changeSubscription
                else if(!empty($old_horn_clientid) && $this->request->data['User']['horn_clientid'] != $old_horn_clientid){
                    $url = "http://pushapps.hypoidea.com/subscriptions/api_changeSubscription";
                    $data = array(
                        "sender_token"=>configure::read("PushApps.token"),
                        "old_username"=>$old_horn_clientid,
                        "new_username"=>$this->request->data['User']['horn_clientid'],
                        "user_account"=>$this->Auth->user('username')
                    );
                    $results = $HttpSocket->post($url, json_encode($data), array(
                        "header"=>array(
                            "Content-Type"=>"application/x-www-form-urlencoded"
                        )
                    ));
                    $body = json_decode($results->body(), true);
                    if(!$body['result']['success']){
                        echo json_encode(
                            array(
                                "result"=>false,
                                "msg"=>"Error02:更新失敗，請稍後嘗試。"
                            )
                        );
                        exit();
                    }
                }
            }else{
                $this->request->data['User']['horn_pushnotifications'] = 0;
                $this->request->data['User']['horn_pushmessages'] = 0;
                //removeSubscriber
                if(!empty($old_horn_clientid)){
//                    $url = "http://pushapps.hypoidea.com/subscriptions/api_removeSubscriber";
//                    $data = array(
//                        "sender_token"=>configure::read("PushApps.token"),
//                        "user_name"=>$old_horn_clientid,
//                        "user_account"=>$this->Auth->user('username')
//                    );
//                    $results = $HttpSocket->post($url, json_encode($data), array(
//                        "header"=>array(
//                            "Content-Type"=>"application/x-www-form-urlencoded"
//                        )
//                    ));
//                    $body = json_decode($results->body(), true);
                }
            }

            if ($this->User->save($this->request->data)) {
                echo json_encode(
                    array(
                        "result"=>true,
                        "msg"=>"更新成功"
                    )
                );
            }else{
                echo json_encode(
                    array(
                        "result"=>false,
                        "msg"=>"更新失敗，請再檢查後嘗試"
                    )
                );
            }


        }
    }

    public function resetpassword($id = null){
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->User->id  = $id;

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->begin();
            if ($this->User->save($this->data)) {
                if($this->User->UsersPassword->changepasswordrecord($this->User->id, $this->data['User']['password'])){
                    $this->User->commit();
                    $this->Session->setFlash(__('Password has been changed.'), 'default', array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'view', $this->User->id));
                }
            }
            $this->User->rollback();
        }
        $this->User->recursive = 0;
        $options = array('conditions' => array($this->User->alias.'.'.$this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    public function reissuecard($id=null) {
        $this->layout = "withoutmenu";

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $error = false;
            $this->User->begin();
            if(!$this->User->save($this->request->data)) {
                $error =  configure::read("error_prefix")."00064";
            }

            if($error){
                $this->User->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.$error.')', 'default', array('class' => 'alert alert-danger'));
            }else{
                $this->User->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                echo "<script>window.close();</script>";
            }
        }else{
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    public function changeactive(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $msg = array('result'=>false);
        if ($this->request->is('post') || $this->request->is('put')) {
            $id = $this->request->data['user_id'];
            $active = $this->request->data['active'];
            if(!$this->User->exists($id)){
                throw new NotFoundException(__('Invalid user'));
            }
            $this->User->id = $id;
            if($this->User->saveField('active', $active)){
                $msg = array('result'=>true, 'active'=>$active, 'posted'=>$this->request->data);
            }
        }

        echo json_encode($msg);
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'), 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'default', array('class'=>'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function dashboard()
    {
//        Configure::write('debug', 2);
        $this->User->Group->Behaviors->load('Containable');
        $announcements = $this->User->Group->find('first', array(
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
                   ),
                   'limit' => 5
               )
           ),
            'conditions'=>array(
                'Group.id'=>$this->Session->read('Auth.groupsusers')
            ),

        ));
//        //Get message and notifications
        $this->User->NotificationUser->Notification->Recipient->Behaviors->load('Containable');
        $options = array(
            'limit' => 10,
            "order"=>array(
                "Recipient.created"=>"DESC",
            ),
            "contain"=>array(
                "Notification.Fromuser",
            ),
            "conditions"=>array(
                "Recipient.trash"=>0
            )
        );
        $notifications = $this->User->NotificationUser->Notification->Recipient->find('all', $options);

        $options = array(
            "conditions"=>array(
                "Recipient.read"=>0,
                "Recipient.trash"=>0
            )
        );
        $unread_notifications = $this->User->NotificationUser->Notification->Recipient->find('count', $options);
//
        $this->User->MessagesUser->Message->Recipient->Behaviors->load('Containable');
        $options = array(
            'limit' => 10,
            "order"=>array(
                "Recipient.created"=>"DESC"
            ),
            "contain"=>array(
                "Message.Fromuser",
            ),
            "conditions"=>array(
                "trash"=>0
            )
        );

        $messages = $this->User->MessagesUser->Message->Recipient->find('all', $options);

        $options = array(
            "conditions"=>array(
                "read"=>0,
                "trash"=>0
            )
        );
        $unread_messages = $this->User->MessagesUser->Message->Recipient->find('count', $options);

        $this->set('announcements', $announcements['Announcement']);
        $this->set('notifications', $notifications);
        $this->set('unread_notifications', $unread_notifications);
        $this->set('messages', $messages);
        $this->set('unread_messages', $unread_messages);
        $this->set('systemversion', $this->systemversion);
    }

    public function insight(){
        $this->loadModel('Activitysession');
        Configure::write('debug', 2);

        $user_id = $start_date = $end_date = $attendant_id = $activitygroup_id = $unit_id = $session_id = $activity_id = null;
        $start_date = date("Y-m-d",strtotime('first day of ' . date( 'F Y')));
        $end_date = date("Y-m-d",strtotime('last day of ' . date( 'F Y')));
        $user_id = $this->Auth->user('id');

        //count sessions
        $this->set('session_count', $this->Activitysession->session_count($user_id, $start_date, $end_date, $activitygroup_id, $unit_id));

        //count applicant attendance
        $this->set('applicant_count',$this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id));

        //count applicant attendance
        $this->set('volunteer_count',$this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id));

    }

    public function ajax_insight(){

        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg ='';

        $start_date = $this->request->data['start_date'];
        $end_date = $this->request->data['end_date'];


        $this->loadModel('Activitysession');
        //count sessions
        $tmp = $this->Activitysession->session_count($this->Auth->user('id'),$start_date,$end_date);
        $result['session_count'] = (!$tmp)?"0":$tmp;

        //count applicant attendance
        $tmp = $this->Activitysession->Activityattendant->applicant_count($this->Auth->user('id'),$start_date,$end_date,"2");
        $result['applicant_count'] = (!$tmp)?"0":$tmp;


        //count volunteer attendance
        $tmp = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($this->Auth->user('id'),$start_date,$end_date,"2");
        $result['volunteer_count'] = (!$tmp)?"0":$tmp;

        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );

    }

    public function beforeFilter() {
        $this->Auth->allow('ajax_checkislogin');
        $this->Security->unlockedActions[] = 'changeactive';
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        $this->Security->unlockedActions[] = 'ajax_insight';
        $this->Security->unlockedActions[] = 'updatehorn';
//
        parent::beforeFilter();
    }
}
