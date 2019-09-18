<?php
App::uses('AppController', 'Controller');

class UserloginlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', "DataTable");

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}

    public function ajax_search(){

        $this->autoRender = false;
        $this->paginate = array(
            'link' => array(
                'User',
            ),
            'fields' => array(
                'Userloginlog.created',
            ),
        );
        $this->DataTable->mDataProp = true;
        echo json_encode($this->DataTable->getResponse());
    }

    public function beforeFilter()
    {
        $this->Security->unlockedActions[] = "ajax_search";
        parent::beforeFilter();
    }
}
