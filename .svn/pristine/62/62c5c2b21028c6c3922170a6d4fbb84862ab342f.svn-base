<?php
App::uses('AppController', 'Controller');
/**
 * Backupsettings Controller
 *
 * @property Backupsetting $Backupsetting
 */
class BackupsettingsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function setting() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if($this->Backupsetting->save($this->request->data)){
                $this->Session->setFlash(__('The Backup ').__('has been saved'), 'flash/success');
            }else{
                $this->Session->setFlash(__('The Backup ').__('could not be saved. Please, try again.'), 'flash/error');
            }

        }
        $setting = $this->Backupsetting->find('first');
        $this->request->data = $setting;
    }

}
