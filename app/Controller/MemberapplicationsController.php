<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Members Controller
 *
 * @property Memberapplication $Memberapplication
 * @property PaginatorComponent $Paginator
 */
class MemberapplicationsController extends AppController
{

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

    public function test(){
        Configure::write('debug', 2);
//        debug(max("2000-01-01","2002-01-01" ));
//
//        if("2000-01-01" <  "2002-01-01"){
//            debug(true);
//        }else{
//            debug(false);
//
//        }
//
//        exit();

        debug($this->Memberapplication->Member->checkreportrange(3553, '2019-01-01','2010-01-01'));
        exit();

    }

    public function index()
    {
       // Configure::write('debug', 2);
        $this->Memberapplication->recursive = 0;
//        $this->Prg->commonProcess();
//
//        $option = $this->Member->parseCriteria($this->Prg->parsedParams());
//        $this->paginate = array('conditions' => $option);
        $members = $this->Memberapplication->find('all', array(
            "order"=>array("Memberapplication.code DESC")
        ));

        $this->set('memberapplications', $members);

//        $test = $this->Memberapplication->stat_newmember('2015-12-01','2015-12-30');
//        debug($test);exit();
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
//        Configure::write('debug', 2);
        if (!$this->Memberapplication->exists($id)) {
            throw new NotFoundException(__('Invalid memberapplication'));
        }
        $this->Memberapplication->Behaviors->load('Containable');

        $options = array(
            'conditions' => array(
                'Memberapplication.' . $this->Memberapplication->primaryKey => $id
            ),
            'contain' => array(
                "Membertype",
                'Memberapplicationtype',
                'Mainmember',
                'Member',
                "Unit",
                "User"
            ),
        );
        $memberapplication = $this->Memberapplication->find('first', $options);

//        debug($memberapplication);

        //Remove mainmember from list of related members
        $mainmember = $memberapplication['Mainmember'];
        $members = $memberapplication['Member'];

        foreach($members as $index=>$member){
            if ($member['id'] == $mainmember['id']){
                unset($members[$index]);
            }
        }
        $memberapplication['Member'] = $members;

        $this->set('memberapplication', $memberapplication);
        $this->set("modal_title", $memberapplication['Memberapplication']['code']);

    }


    public function rollback($id=null){


        if (!$this->Memberapplication->exists($id)) {
            throw new NotFoundException(__('Invalid memberapplication'));
        }
        $this->Memberapplication->Behaviors->load('Containable');

        $options = array(
            'conditions' => array(
                'Memberapplication.' . $this->Memberapplication->primaryKey => $id
            ),
            'contain' => array(
                'Member',
                'Member.Memberapplication',
            ),
        );

        if ($this->request->is(array('post', 'put'))) {
            $error = false;

            $this->Memberapplication->begin();

            if($this->Memberapplication->exists($this->request->data['Memberapplication']['id'])){
                $this->Memberapplication->id = $this->request->data['Memberapplication']['id'];
                if(!$this->Memberapplication->saveField('valid',0)){
                    $error = configure::read("error_prefix")."00053";
                }

                foreach($this->request->data['Member'] as $member){
                    if($this->Memberapplication->Member->exists($member['id'])){
                        $this->Memberapplication->Member->id = $member['id'];
                        if(!$this->Memberapplication->Member->saveField('membershipdate',$member['membershipdate'])){
                            $error = configure::read("error_prefix")."00054";
                        }

                    }else{
                        $error = configure::read("error_prefix")."00055";
                    }
                }
            }else{
                $error = configure::read("error_prefix")."00056";
            }
            if(!$error){
                $this->Memberapplication->commit();
                $this->Session->setFlash(__("成功取消續期。"), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array("action"=>"index"));
            }else{
                $this->Memberapplication->rollback();
                $this->Memberapplication->setFlash(__("取消續期不成功。").' ('.$error.')', 'default', array('class' => 'alert alert-danger'));
            }


        }

        $memberapplication = $this->Memberapplication->find('first', $options);
        $this->set('memberapplication', $memberapplication);

        $cutoffdatemsg = '';
        if($this->Cutoffdate->canchange($memberapplication['Memberapplication']['created'], $cutoffdatemsg)){
            $this->set('cutoffdatemsg', $cutoffdatemsg);
        }else{
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("cutoffdate_msg_title"));
            $this->set('errormsg', __("cutoff_time"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Member->id = $id;
        if (!$this->Member->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Member->delete()) {
            $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function ajax_searchbymember()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg ='';

        $member_code = trim($this->request->data['member_code']);
        if(empty($member_code)){
            $errormsg = "必須填寫會員編號";
        }else{
            $this->Memberapplication->Member->Behaviors->load('Containable');

            $options = array(
                'conditions' => array(
                    'Member.code' => $member_code
                ),
                'contain' => array(
                    'Memberapplication',
                    'Memberapplication.Memberapplicationtype',
                    'Memberapplication.Mainmember'
                ),
            );

            $result = $this->Memberapplication->Member->find('first', $options);

            if(empty($result)){
                $errormsg = "沒有記錄";
            }else{
                $result=$result['Memberapplication'];
                $errormsg = '';
            }

        }

        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );
    }

    public function beforeFilter()
    {
        if ($this->request['action'] == 'sendconfirmmail' || $this->request['action'] == 'sendresetpwdmail') {
            $this->allowtoken();
            $this->Security->unlockedActions[] = 'sendresetpwdmail';
            $this->Security->unlockedActions[] = 'sendconfirmmail';
        }

        $this->Security->unlockedActions[] = 'ajax_searchbymember';
        $this->Security->unlockedActions[] = 'ajax_checkinfo';
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }



}
