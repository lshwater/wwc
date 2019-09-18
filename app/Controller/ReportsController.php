<?php
App::uses('AppController', 'Controller');


class ReportsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');


    public function export()
    {
        $this->loadModel('Unit');
        $this->set("units", $this->Unit->find('list', array('conditions'=>array('active'=>1))));
    }

    public function ajax_getlist(){
        $this->RequestHandler->respondAs('json');
        $this->autoRender = false;

        if($this->request->data['startdate'] && $this->request->data['enddate'] && $this->request->data['unit_id']){
            $startdate = date_parse($this->request->data['startdate']);
            $enddate = date_parse($this->request->data['enddate']);
            if (
                !($startdate["error_count"] ===0 && checkdate($startdate["month"], $startdate["day"], $startdate["year"]) &&
                $enddate["error_count"] === 0 && checkdate($enddate["month"], $enddate["day"], $enddate["year"]))
            ){
                return false;
            }
        }

        $this->loadModel('Activitysession');
        if(!$this->Activitysession->Activity->Unit->exists($this->request->data['unit_id'])){
            return false;
        }


        $rs = $this->Activitysession->session_list('', $this->request->data['startdate'], $this->request->data['enddate'], '', $this->request->data['unit_id']);

        $return = array();
        if(!empty($rs)){
            foreach($rs as $ac){
                $return[$ac['Activity']['id']] =  $ac;
            }
        }

        echo json_encode($rs);
    }

    public function ajax_getreport(){
        //Configure::write('debug',2);

        list($startdate, $enddate)  = explode(' to ', $this->request->data['Report']['daterange']);
        $unit_id = $this->request->data['Report']['unit_id'];

        $this->loadModel('Activitysession');
        if(!$this->Activitysession->Activity->Unit->exists($unit_id)){
            return false;
        }
        //check is date
        $checkstartdate = date_parse($startdate);
        $checkenddate = date_parse($enddate);
        if (
        !($checkstartdate["error_count"] ===0 && checkdate($checkstartdate["month"], $checkstartdate["day"], $checkstartdate["year"]) &&
            $checkenddate["error_count"] === 0 && checkdate($checkenddate["month"], $checkenddate["day"], $checkenddate["year"]))
        ){
            return false;
        }

        //$this->Memberapplication->stat_newmember();

        $this->ReportComponent = $this->Components->load(Configure::read("Report.Component"));
        $this->ReportComponent->initialize($this);
        $this->ReportComponent->unit_id = $unit_id;
        $this->ReportComponent->startdate = $startdate;
        $this->ReportComponent->enddate = $enddate;
        $result = $this->ReportComponent->getresult();

        $xlsxpath = $this->ReportComponent->xlsxpath;
        $xlsxdata = $this->ReportComponent->xlsxdata;

        $this->set(compact('startdate', 'enddate', 'result', 'xlsxpath', 'xlsxdata'));
        $this->response->type(array('xls' => 'application/vnd.ms-excel'));
        $this->response->type('xls');

    }

    public function download($id = null)
    {
        //Configure::write('debug', 2);
        $this->viewClass = 'Media';
        // Render app/webroot/files/example.docx
        $params = array(
            'id'        => "SIS_14_sample",
            'name'      => "SIS_14_sample.xlsx",
            'extension' => "xlsx",
            'path'      => "files".DS,
            'download'  => true
        );
        $this->set($params);

    }


    public function analytics()
    {
        $this->loadModel('Activitysession');
        //Configure::write('debug', 2);


        $user_id = $start_date = $end_date = $attendant_id = $activitygroup_id = $unit_id = $session_id = $activity_id = $is_publish = null;
        $start_date = date("Y-m-d",strtotime('first day of ' . date( 'F Y')));
        $end_date = date("Y-m-d",strtotime('last day of ' . date( 'F Y')));
        $is_publish = 1;

        $activities = $this->Activitysession->session_count_by_activity($user_id, $start_date, $end_date, $activitygroup_id, $unit_id, $activity_id, $is_publish);


        foreach ($activities as $index=>$activity){
            $attendant_id = array(1, 2);
            $activity_id = $activity['Activity']['id'];

            $activities[$index]['Activity']['total_applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $activities[$index][0]['total_extra_attendant'];
            if(!$activities[$index]['Activity']['total_applicant_count'])$activities[$index]['Activity']['total_applicant_count'] = '0';

            $activities[$index]['Activity']['total_volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$activities[$index]['Activity']['total_volunteer_count'])$activities[$index]['Activity']['total_volunteer_count'] = '0';

            $attendant_id = 2;
            $activities[$index]['Activity']['applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $activities[$index][0]['total_extra_attendant'];
            if(!$activities[$index]['Activity']['applicant_count'])$activities[$index]['Activity']['applicant_count'] = '0';

            $activities[$index]['Activity']['volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$activities[$index]['Activity']['volunteer_count'])$activities[$index]['Activity']['volunteer_count'] = '0';
        }


        $this->set('activities', $activities);

        $this->loadModel('User');
        $this->set('user_list', $this->User->find('list'));

        $this->loadModel('Activitygroup');
        $this->set('activitygroup_id', $this->Activitygroup->find('list'));

        $this->loadModel('Unit');
        $this->set('unit_id', $this->Unit->find('list'));


    }

    public function ajax_activity_analytics(){

        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg ='';

        $user_id = $start_date = $end_date = $attendant_id = $activitygroup_id = $unit_id = $session_id = $activity_id = $is_publish = null;

        $user_id = $this->request->data['user_id'];
        $start_date = $this->request->data['start_date'];
        $end_date = $this->request->data['end_date'];
        $activitygroup_id = $this->request->data['activitygroup_id'];
        $unit_id = $this->request->data['unit_id'];
        $is_publish = 1;

        $this->loadModel('Activitysession');


        $activities = $this->Activitysession->session_count_by_activity($user_id, $start_date, $end_date, $activitygroup_id, $unit_id, $activity_id, $is_publish);

        foreach ($activities as $index=>$activity){
            $attendant_id = ["1", "2"];
            $activity_id = $activity['Activity']['id'];

            $activities[$index]['Activity']['total_applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $activities[$index][0]['total_extra_attendant'];
            if(!$activities[$index]['Activity']['total_applicant_count'])$activities[$index]['Activity']['total_applicant_count'] = '0';

            $activities[$index]['Activity']['total_volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$activities[$index]['Activity']['total_volunteer_count'])$activities[$index]['Activity']['total_volunteer_count'] = '0';

            $attendant_id = "2";
            $activities[$index]['Activity']['applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $activities[$index][0]['total_extra_attendant'];
            if(!$activities[$index]['Activity']['applicant_count'])$activities[$index]['Activity']['applicant_count'] = '0';

            $activities[$index]['Activity']['volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$activities[$index]['Activity']['volunteer_count'])$activities[$index]['Activity']['volunteer_count'] = '0';
        }

        $result['activities'] = $activities;


        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );

    }

    public function ajax_session_analytics(){

        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $result = false;
        $errormsg ='';

        $user_id = $start_date = $end_date = $attendant_id = $activitygroup_id = $unit_id = $session_id = $activity_id = $is_publish = null;

        $user_id = $this->request->data['user_id'];
        $start_date = $this->request->data['start_date'];
        $end_date = $this->request->data['end_date'];
        $activitygroup_id = $this->request->data['activitygroup_id'];
        $unit_id = $this->request->data['unit_id'];
        $activity_id = $this->request->data['activity_id'];
        $is_publish = 1;

        $this->loadModel('Activitysession');

        $sessions = $this->Activitysession->session_list($user_id, $start_date, $end_date, $activitygroup_id, $unit_id, $activity_id, $is_publish);


        foreach ($sessions as $index=>$session){
            $attendant_id = ["1", "2"];
            $session_id = $session['Activitysession']['id'];

            $sessions[$index]['Activitysession']['total_applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $sessions[$index][0]['total_extra_attendant'];
            if(!$sessions[$index]['Activitysession']['total_applicant_count'])$sessions[$index]['Activitysession']['total_applicant_count'] = '0';

            $sessions[$index]['Activitysession']['total_volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$sessions[$index]['Activitysession']['total_volunteer_count'])$sessions[$index]['Activitysession']['total_volunteer_count'] = '0';

            $attendant_id = "2";
            $sessions[$index]['Activitysession']['applicant_count'] = $this->Activitysession->Activityattendant->applicant_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish) + $sessions[$index][0]['total_extra_attendant'];
            if(!$sessions[$index]['Activitysession']['applicant_count'])$sessions[$index]['Activitysession']['applicant_count'] = '0';

            $sessions[$index]['Activitysession']['volunteer_count'] = $this->Activitysession->ActivitiesVolunteerAttendant->volunteer_count($user_id, $start_date, $end_date, $attendant_id, $activitygroup_id, $unit_id, $session_id, $activity_id, $is_publish);
            if(!$sessions[$index]['Activitysession']['volunteer_count'])$sessions[$index]['Activitysession']['volunteer_count'] = '0';
        }

        $result['sessions'] = $sessions;


        echo json_encode(
            array(
                "result"=>$result,
                "errormsg"=>$errormsg
            )
        );

    }


    public function beforeFilter()
    {
        if ($this->request['action'] == 'ajax_getreport') {
            $this->Security->csrfUseOnce = false;
        }
        $this->Security->unlockedActions[] = "ajax_getlist";
        $this->Security->unlockedActions[] = "ajax_activity_analytics";
        $this->Security->unlockedActions[] = "ajax_session_analytics";
        parent::beforeFilter();
    }

}
