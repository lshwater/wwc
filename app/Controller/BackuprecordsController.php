<?php
App::uses('AppController', 'Controller');
App::uses('CakeSchema', 'Model');
App::uses('ConnectionManager', 'Model');
App::uses('Inflector', 'Utility');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Backuprecords Controller
 *
 * @property Backuprecord $Backuprecord
 */
class BackuprecordsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {

        $this->Backuprecord->recursive = 0;
        $result = $this->paginate();
        if(!empty($result)){
            foreach($result as $k=>$value){
                $result[$k]['Backuprecord']['filesize'] = $this->Backuprecord->formatSizeUnits($value['Backuprecord']['filesize']);
            }
        }
        $this->set('backuprecords', $result);
    }

    public function dobackup(){
        $this->autoRender = false;
        $needbackup = false;

        $this->loadModel('Backupsetting');
        $setting = $this->Backupsetting->find('first');


        $lt_backup = $this->Backuprecord->find('first', array(
                'order' => array('id' => 'DESC')
            )
        );

        $numDays = round(abs(time() - strtotime($lt_backup['Backuprecord']['created']))/60/60/24);
        if($setting['Backupsetting']['daily']){
            if($numDays >= 1){
                $needbackup = true;
            }
        }else if($setting['Backupsetting']['weekly']){
            if($numDays >= 7){
                $needbackup = true;
            }
        }

        if($needbackup){
            ini_set('memory_limit', '5120M');
            ini_set('max_execution_time', 1000);
            //exec Backups
            $dataSourceName = 'default';
            $db = ConnectionManager::getDataSource($dataSourceName);
            $config = $db->config;

            $path = APP .'Backups' . DS;
            $fileSufix = date('Ymd\_His') . '.sql.gz';
            $file = $path . $fileSufix;

            $command = "mysqldump -u ".$config['login'].' --password='.$config['password'].' '.$config['database'].' | gzip > '.$file;
            echo exec($command);
            if(filesize($file) > 10){
                $this->Backuprecord->create();
                $data2save = array(
                    'path'=>$file,
                    'filesize'=>filesize($file)
                );
                $this->Backuprecord->save($data2save);
                echo true;
            }
        }
        //=====end
    }

    public function beforeFilter(){
        $this->Auth->allow('dobackup');
        parent::beforeFilter();
    }

}
