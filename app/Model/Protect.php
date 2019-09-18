<?php
App::uses('AppModel', 'Model');

class Protect extends AppModel {


    function access($account, $action,$limit)
    {
        $ip = gethostbyname($_SERVER['REMOTE_ADDR']);
        $this->deleteAll(array($this->alias.'.expire <=NOW()'));
        $amount = $this->find('count', array(
            'conditions'=>array(
                $this->alias.'.account'=>$account,
                $this->alias.'.action'=>$action
            )
        ));
        if ($amount < $limit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function fail($account, $action, $expire)
    {
        $unit="MINUTE";
        switch (strtolower($expire{strlen($expire)-1}))
        {
            case 's':$unit="SECOND";break;
            case 'm':$unit="MINUTE";break;
            case 'h':$unit="HOUR";    break;
            case 'w':$unit="WEEK";    break;
            case 'o':$unit="MONTH";    break;
            case 'q':$unit="QUARTER";break;
            case 'y':$unit="YEAR";    break;
        }
        $db = $this->getDataSource();

        $data2save =  array(
            'account'=>$account,
            'action'=>$action,
            'expire'=>$db->expression('TIMESTAMPADD('.$unit.','.substr ( $expire,0,strlen($expire)-1).',NOW())')
        );

        $this->create();
        $this->save($data2save);
    }

}
