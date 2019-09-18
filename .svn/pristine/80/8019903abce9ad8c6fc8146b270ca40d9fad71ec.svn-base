<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 */
class NotificationsController extends AppController {

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
	public function index() {

		$this->Notification->Recipient->Behaviors->load('Containable');
        $this->paginate = array(
            "Recipient"=>array(
                'limit' => 15,
                "order"=>array(
                    "created"=>"DESC"
                ),
                "contain"=>array(
                    "Notification.Fromuser",
                    "Notification.Notificationtype",
                ),
                "conditions"=>array(
                    "Recipient.trash"=>0
                )
            )
        );
        $notifications = $this->Paginator->paginate('Recipient');
		$this->set('notifications', $notifications);

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
        $notification = $this->Notification->find('first', $options);
        if(in_array($this->Auth->user("id"),$notification['Notification']['Recipient'])){
            throw new NotFoundException(__('Invalid notification'));
        }
		$this->set('notification', $notification);
        $Recipient = $this->Notification->Recipient->find('first', array(
            "conditions"=>array(
                "notification_id"=>$id,
                "user_id"=>$this->Auth->user("id")
            )
        ));



        $this->Notification->Recipient->id = $Recipient['Recipient']['id'];
        $this->Notification->Recipient->saveField("read", 1);

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');

		$this->Notification->Recipient->id = $id;
		if (!$this->Notification->Recipient->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
        $options = array('conditions' => array('Recipient.' . $this->Notification->Recipient->primaryKey => $id));
        $notification = $this->Notification->Recipient->find('first', $options);
        if($notification['Recipient']['user_id'] != $this->Auth->user("id")){
            throw new NotFoundException(__('Invalid Recipient'));
        }
		$this->request->allowMethod('post', 'delete');
		if ($this->Notification->Recipient->delete()) {
            echo json_encode(true);
		} else {
            echo json_encode(false);
		}

	}

    public function ajax_getunreadnotices(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        if ($this->request->is(array('post', 'put'))) {
            $timestamp = $this->request->data['timestamp'];
            $rs = $this->Notification->getunreadnotices($timestamp);
            if(!$rs){
                echo json_encode(array('update'=>false));
            }else{
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
        $this->Security->unlockedActions[] = 'ajax_getunreadnotices';
        $this->Security->unlockedActions[] = 'delete';
        parent::beforeFilter();
    }
}
