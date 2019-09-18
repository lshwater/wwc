<?php
App::uses('AppController', 'Controller');

class DocumentsController extends AppController
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
    public function index()
    {
        $this->Document->recursive = 0;
        $this->set('documents', $this->Document->find('all'));
    }

    public function upload(){
        if ($this->request->is('post')) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "zip");
            $temp = explode(".", $this->request->data['Document']['file']["name"]);
            $extension = end($temp);
            if (($this->request->data['Document']['file']["size"] < 10000000)
                && in_array(strtolower($extension), $allowedExts)) {
                if ($this->request->data['Document']['file']["error"] > 0) {

                    //echo Response::json('error', 400);
                } else {
                    $path = 'uploads/'.uniqid().'.'.$extension;
                    move_uploaded_file($this->request->data['Document']['file']["tmp_name"],APP.WEBROOT_DIR."/".$path);

                    $this->Document->create();
                    $this->Document->save(
                        array(
                            "orgname"=>$this->request->data['Document']['file']['name'],
                            "ext"=>$extension,
                            'name'=>$this->request->data['Document']['name'],
                            'des'=>$this->request->data['Document']['des'],
                            "model"=>"Document",
                            'model_id'=>0,
                            'path'=>$path,
                            'size'=>$this->request->data['Document']['file']["size"],
                            'user_id'=>$this->Auth->user("id")
                        )
                    );
                    $this->Document->savefield("model_id", $this->Document->id);

                    $this->Session->setFlash(__('成功上傳'), 'default', array('class'=>'alert alert-success'));

                    $this->redirect(array("action"=>"index"));
                }
            } else {
                $this->Session->setFlash(__('上傳失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
            }
        }
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

}
