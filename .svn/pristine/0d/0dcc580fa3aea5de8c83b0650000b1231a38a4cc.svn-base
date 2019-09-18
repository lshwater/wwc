<?php
App::uses('AppController', 'Controller');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class MembertmpsController extends AppController
{
    public function ajax_import()
    {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $code = $this->request->data['code'];
        $rs = $this->Membertmp->findByCode($code);
        if(!empty($rs)){
            echo json_encode($rs);
        }
        else{
            return json_encode(false);
        }
    }

    public function beforeFilter()
    {

        $this->Security->unlockedActions[] = 'ajax_import';
        parent::beforeFilter();
    }
}

?>