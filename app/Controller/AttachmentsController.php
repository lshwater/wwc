<?php
App::uses('AppController', 'Controller');

class AttachmentsController extends AppController
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
    public function download($id = null)
    {
        if(!$this->Attachment->exists($id)){
            throw new NotFoundException(__('Not exist'));
        }
        $rs = $this->Attachment->findByid($id);

        $this->viewClass = 'Media';
        // Render app/webroot/files/example.docx
        $params = array(
            'id'        => basename($rs['Attachment']['path']),
            'name'      => substr($rs['Attachment']['orgname'], 0, strrpos($rs['Attachment']['orgname'], ".")),
            'extension' => $rs['Attachment']['ext'],
            'path'      => "uploads".DS,
            'download'  => true
        );
        $this->set($params);
    }

    public function uploadatt($model = null, $id = null, $title = null){
//        Configure::write('debug', 2);
        $this->loadModel($model);
        if (!$this->{$model}->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is('post')) {
            $errormsg = "";
            $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "zip");
            $temp = explode(".", $this->request->data['Attachment']['file']["name"]);
            $extension = end($temp);
            if(!in_array(strtolower($extension), $allowedExts)){
                $errormsg = "(附件類型不正確。)";
            }
            else if($_FILES["file"]["size"] < 10000000){
                if ($_FILES["file"]["error"] > 0) {
                    $errormsg = "(附件必須少於10Mb。)";
                } else {
                    $path = 'uploads/'.uniqid().'.'.$extension;
                    move_uploaded_file($this->request->data['Attachment']['file']["tmp_name"],APP.WEBROOT_DIR."/".$path);

                    $this->Attachment->create();
                    $this->Attachment->save(
                        array(
                            "orgname"=>$this->request->data['Attachment']['file']['name'],
                            "ext"=>$extension,
                            'name'=>$this->request->data['Attachment']['name'],
                            'des'=>$this->request->data['Attachment']['des'],
                            "model"=>$model,
                            'model_id'=>$id,
                            'path'=>$path,
                            'size'=>$this->request->data['Attachment']['file']["size"],
                            'user_id'=>$this->Auth->user("id")
                        )
                    );
                    $this->Session->setFlash(__('成功上傳'), 'default', array('class'=>'alert alert-success'));

                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                    $this->redirect($redirecturl);
                }
            }
            $this->Session->setFlash(__('上傳失敗，請再檢查後嘗試。'.$errormsg), 'default', array('class'=>'alert alert-danger'));
        }

        $redirecturl = urldecode($this->request->params['named']['redirect']);
        $this->set('redirecturl', $redirecturl);
        if(!empty($title)){
            $this->set('title', utf8_decode($title));
        }else{
            $this->set('title', "上傳附件");
        }

    }

    public function delete($id = null){
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
        $this->request->allowMethod('post', 'delete');
        $rs = $this->Attachment->findByid($id);
        if ($this->Attachment->delete()) {
            unlink(APP.WEBROOT_DIR.DS.$rs['Attachment']['path']);
            $this->Session->setFlash("已刪除", 'default', array('class'=>'alert alert-success'));
        } else {
            $this->Session->setFlash("刪除失敗", 'default', array('class'=>'alert alert-danger'));
        }
        $redirecturl = urldecode($this->request->params['named']['redirect']);
        return $this->redirect($redirecturl);
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

}
