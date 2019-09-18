<?
App::uses('Component', 'Controller');
class ABMSReportComponent extends Component {
    // the other component your component uses

    public $unit_id;
    public $startdate;
    public $enddate;
    public $result;
    public $xlsxpath;
    public $xlsxdata;
    public $Periods;

    public function initialize(Controller $controller) {
        $this->Controller = $controller;
        $this->Model = $this->Controller->{$this->Controller->modelClass};
        $this->modelAlias = $this->Model->alias;
        $this->result = array();
        $this->xlsxpath = APP.'Files/abms.xlsx';
        $this->xlsxdata = array();
        parent::initialize($controller);
    }

    public function getresult(){
//        echo "HI";
//        print_R($this->Model->find("all"));

        //Load All Modal
        $this->Memberapplication = ClassRegistry::init('Memberapplication');
        $this->Activitysession = ClassRegistry::init('Activitysession');
        $this->Activityattendant = ClassRegistry::init('Activityattendant');
        $this->Activity = ClassRegistry::init('Activity');
        $this->ActivitiesVolunteerAttendant  = ClassRegistry::init('ActivitiesVolunteerAttendant');

        //Split Date
        $start = new DateTime($this->startdate);
        $interval = new DateInterval('P1M');
        $end = new DateTime($this->enddate);
        $dateperiod = new DatePeriod($start, $interval, $end);
        $this->Periods = array();
        $this->result = array();
        $count = 0;
        foreach ($dateperiod as $dt) {
            $this->Periods[$count] = array(
                "startdate"=>$dt->format('Y-m-d'),
                "enddate"=>date("Y-m-t", strtotime($dt->format('Y-m-d'))),
                "resultkey"=>$count,
                "label"=>$dt->format('M')
            );
            $count++;
        }

        foreach($this->Periods as $_date){
            $_thisid = $_date['resultkey'];

            //=====Member====
            $this->result[$_thisid]['Member']['=<14'] = $this->result[$_thisid]['Member']['15-24'] = $this->result[$_thisid]['Member']['>=25'] = $this->result[$_thisid]['Member']['parent'] = 0;
            $memberapplications = $this->Memberapplication->stat_newmember($_date['startdate'], $_date['enddate'], $this->unit_id);
            if(!empty($memberapplications)){
                foreach($memberapplications as $app){
                    if(!empty($app['Member'])){
                        foreach($app['Member'] as $appmember){
                            if($appmember['is_parent']){
                                $this->result[$_thisid]['Member']['parent']++;
                            }else{
                                $memberage = $appmember['age'];
                                switch($memberage){
                                    case($memberage <= 14):
                                        $this->result[$_thisid]['Member']['=<14']++;
                                        break;
                                    case($memberage >= 15 && $memberage <=24):
                                        $this->result[$_thisid]['Member']['15-24']++;
                                        break;
                                    case($memberage >= 25):
                                        $this->result[$_thisid]['Member']['>=25']++;
                                        break;
                                }
                            }
                        }
                    }
                }
            }

            //=====Activitysession====
            #Guidance & Counseling Service
            $this->result[$_thisid]['ProgramSession']['GC'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 1,$this->unit_id);
            #Supportive Service for Young People in Disadvantaged Circumstance
            $this->result[$_thisid]['ProgramSession']['SS'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 2,$this->unit_id);
            #Socialization Programs
            $this->result[$_thisid]['ProgramSession']['SP'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 3,$this->unit_id);
            #Development of Social Responsibility & Competence
            $this->result[$_thisid]['ProgramSession']['DSA'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 4,$this->unit_id);
            $this->result[$_thisid]['ProgramSession']['DSB'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 5,$this->unit_id);
            $this->result[$_thisid]['ProgramSession']['DSC'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 6,$this->unit_id);
            $this->result[$_thisid]['ProgramSession']['DSD'] = $this->Activitysession->session_count('',$_date['startdate'], $_date['enddate'], 7,$this->unit_id);
            $this->result[$_thisid]['ProgramSession']['DS'] = $this->result[$_thisid]['ProgramSession']['DSA'] + $this->result[$_thisid]['ProgramSession']['DSB'] + $this->result[$_thisid]['ProgramSession']['DSC'] + $this->result[$_thisid]['ProgramSession']['DSD'];

            //=====Attendance======
            #Guidance & Counseling Service
            $this->result[$_thisid]['Attendance']['GC'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,1,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,1,$this->unit_id);
            #Supportive Service for Young People in Disadvantaged Circumstance
            $this->result[$_thisid]['Attendance']['SS'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,2,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,2,$this->unit_id);
            #Socialization Programs
            $this->result[$_thisid]['Attendance']['SP'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,3,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,3,$this->unit_id);
            #Development of Social Responsibility & Competence
            $this->result[$_thisid]['Attendance']['DSA'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,4,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,4,$this->unit_id);
            $this->result[$_thisid]['Attendance']['DSB'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,5,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,5,$this->unit_id);
            $this->result[$_thisid]['Attendance']['DSC'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,6,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,6,$this->unit_id);
            $this->result[$_thisid]['Attendance']['DSD'] = $this->Activityattendant->applicant_count('',$_date['startdate'], $_date['enddate'], 2,7,$this->unit_id)+$this->ActivitiesVolunteerAttendant->volunteer_count('',$_date['startdate'], $_date['enddate'], 2,7,$this->unit_id);
            $this->result[$_thisid]['Attendance']['DS'] = $this->result[$_thisid]['Attendance']['DSA'] + $this->result[$_thisid]['Attendance']['DSB'] + $this->result[$_thisid]['Attendance']['DSC'] + $this->result[$_thisid]['Attendance']['DSD'];

            //======Activity Count======
            $this->result[$_thisid]['ActivityCount']['DSA'] = $this->Activity->activity_count('',$_date['startdate'], $_date['enddate'], 4,$this->unit_id);
            $this->result[$_thisid]['ActivityCount']['DSB'] = $this->Activity->activity_count('',$_date['startdate'], $_date['enddate'], 5,$this->unit_id);
            $this->result[$_thisid]['ActivityCount']['DSC'] = $this->Activity->activity_count('',$_date['startdate'], $_date['enddate'], 6,$this->unit_id);
            $this->result[$_thisid]['ActivityCount']['DSD'] = $this->Activity->activity_count('',$_date['startdate'], $_date['enddate'], 7,$this->unit_id);

        }

        //=====Agree Level======
        $allclosedactvivty = $this->Activity->closeactivity_list('',$this->startdate, $this->enddate,'',$this->unit_id);
        $this->result['ClosedActivity']['Group'] = $this->result['ClosedActivity']['Activity'] = 0;
        $this->result['Agreelevel']['Group'] = $this->result['Agreelevel']['Activity'] = 0;
        if(!empty($allclosedactvivty)){
            foreach($allclosedactvivty as $closed){
                $activitytype_id = $closed['Activity']['activitytype_id'];
                $alias = "";
                switch($activitytype_id){
                    #Guidance & Counseling Service
                    case 1:
                        $alias = "Group";
                        break;
                    #Supportive Service for Young People in Disadvantaged Circumstance
                    case 2:
                        $alias = "Activity";
                        break;
                }
                if(!empty($alias)){
                    $this->result['ClosedActivity'][$alias]++;
                    if($closed['Activity']['issuccess']){
                        $this->result['Agreelevel'][$alias]++;
                    }
                }
            }
        }
        //Service recipients/Workers
        $this->result['Servicerecipients']  = 0;
        #member recipients
        $array_memberattendance = $this->Activityattendant->count_attendance(1, 2,'',$this->startdate, $this->enddate,'',$this->unit_id);
        if(!empty($array_memberattendance)){
            foreach($array_memberattendance as $att){
                if($att[0]['total_session_count'] >= 3){
                    $this->result['Servicerecipients']++;
                }else{
                    break;
                }
            }
        }
        #non-member recipients
        $array_nonmemberattendance = $this->Activityattendant->count_attendance(0, 2,'',$this->startdate, $this->enddate,'',$this->unit_id);
        if(!empty($array_nonmemberattendance)){
            foreach($array_nonmemberattendance as $att){
                if($att[0]['total_session_count'] >= 3){
                    $this->result['Servicerecipients']++;
                }else{
                    break;
                }
            }
        }

        $array_registeredvolunteerattendance = $this->ActivitiesVolunteerAttendant->count_attendance_volunteer(1, 2,'',$this->startdate, $this->enddate,'',$this->unit_id);
        if(!empty($array_registeredvolunteerattendance)){
            foreach($array_registeredvolunteerattendance as $att){
                if($att[0]['total_session_count'] >= 3){
                    $this->result['Servicerecipients']++;
                }else{
                    break;
                }
            }
        }

        $array_nonregisteredvolunteerattendance = $this->ActivitiesVolunteerAttendant->count_attendance_volunteer(0, 2,'',$this->startdate, $this->enddate,'',$this->unit_id);
        if(!empty($array_nonregisteredvolunteerattendance)){
            foreach($array_nonregisteredvolunteerattendance as $att){
                if($att[0]['total_session_count'] >= 3){
                    $this->result['Servicerecipients']++;
                }else{
                    break;
                }
            }
        }
        $this->formatxlsx();
//        Configure::write('debug', 2);
//        debug($array_memberattendance);
//        Configure::write('debug', 2);
//        debug($this->result);
//        exit();
    }

    public function formatxlsx(){
        //HEADER

        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>0,"row"=>17, "value"=>"Period : From                    ".date('j M Y',strtotime($this->startdate))."                 to                          ".date('j M Y',strtotime($this->enddate))
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>1,"row"=>25, "value"=>$this->Periods[0]['label']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>2,"row"=>25, "value"=>$this->Periods[1]['label']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>3,"row"=>25, "value"=>$this->Periods[2]['label']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>1,"row"=>19, "value"=>date('M',strtotime($this->startdate))." - ".date('M',strtotime($this->enddate))
        );

        //Page 1
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>1,"row"=>29, "value"=>$this->result[0]['Member']['=<14']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>2,"row"=>29, "value"=>$this->result[1]['Member']['=<14']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>3,"row"=>29, "value"=>$this->result[2]['Member']['=<14']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>4,"row"=>29, "value"=>$this->result[0]['Member']['15-24']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>5,"row"=>29, "value"=>$this->result[1]['Member']['15-24']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>6,"row"=>29, "value"=>$this->result[2]['Member']['15-24']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>7,"row"=>29, "value"=>$this->result[0]['Member']['>=25']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>8,"row"=>29, "value"=>$this->result[1]['Member']['>=25']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>9,"row"=>29, "value"=>$this->result[2]['Member']['>=25']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>10,"row"=>29, "value"=>$this->result[0]['Member']['parent']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>11,"row"=>29, "value"=>$this->result[1]['Member']['parent']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>0,"col"=>12,"row"=>29, "value"=>$this->result[2]['Member']['parent']
        );

        //Page 2
        //=====Activitysession====
        #Guidance & Counseling Service
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>7, "value"=>$this->result[0]['ProgramSession']['GC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>7, "value"=>$this->result[1]['ProgramSession']['GC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>7, "value"=>$this->result[2]['ProgramSession']['GC']
        );
        #Supportive Service for Young People in Disadvantaged Circumstance
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>11, "value"=>$this->result[0]['ProgramSession']['SS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>11, "value"=>$this->result[1]['ProgramSession']['SS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>11, "value"=>$this->result[2]['ProgramSession']['SS']
        );
        #Socialization Programs
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>13, "value"=>$this->result[0]['ProgramSession']['SP']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>13, "value"=>$this->result[1]['ProgramSession']['SP']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>13, "value"=>$this->result[2]['ProgramSession']['SP']
        );
        #Development of Social Responsibility & Competence
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>15, "value"=>$this->result[0]['ProgramSession']['DS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>15, "value"=>$this->result[1]['ProgramSession']['DS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>15, "value"=>$this->result[2]['ProgramSession']['DS']
        );

        //=====Attendance======
        #Guidance & Counseling Service
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>26, "value"=>$this->result[0]['Attendance']['GC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>26, "value"=>$this->result[1]['Attendance']['GC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>26, "value"=>$this->result[2]['Attendance']['GC']
        );
        #Supportive Service for Young People in Disadvantaged Circumstance
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>30, "value"=>$this->result[0]['Attendance']['SS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>30, "value"=>$this->result[1]['Attendance']['SS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>30, "value"=>$this->result[2]['Attendance']['SS']
        );
        #Socialization Programs
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>32, "value"=>$this->result[0]['Attendance']['SP']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>32, "value"=>$this->result[1]['Attendance']['SP']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>32, "value"=>$this->result[2]['Attendance']['SP']
        );
        #Development of Social Responsibility & Competence
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>1,"row"=>34, "value"=>$this->result[0]['Attendance']['DS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>2,"row"=>34, "value"=>$this->result[1]['Attendance']['DS']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>1,"col"=>3,"row"=>34, "value"=>$this->result[2]['Attendance']['DS']
        );

        //Page 3
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>1,"row"=>6, "value"=>$this->result['ClosedActivity']['Group']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>2,"row"=>6, "value"=>$this->result['ClosedActivity']['Activity']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>1,"row"=>7, "value"=>$this->result['Agreelevel']['Group']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>2,"row"=>7, "value"=>$this->result['Agreelevel']['Activity']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>2,"col"=>1,"row"=>20, "value"=>$this->result['Servicerecipients']
        );

        //Page 5
        #DSA
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>2,"row"=>11, "value"=>$this->result[0]['ActivityCount']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>3,"row"=>11, "value"=>$this->result[0]['ProgramSession']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>4,"row"=>11, "value"=>$this->result[0]['Attendance']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>5,"row"=>11, "value"=>$this->result[1]['ActivityCount']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>6,"row"=>11, "value"=>$this->result[1]['ProgramSession']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>7,"row"=>11, "value"=>$this->result[1]['Attendance']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>8,"row"=>11, "value"=>$this->result[2]['ActivityCount']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>9,"row"=>11, "value"=>$this->result[2]['ProgramSession']['DSA']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>10,"row"=>11, "value"=>$this->result[2]['Attendance']['DSA']
        );
        #DSB
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>2,"row"=>13, "value"=>$this->result[0]['ActivityCount']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>3,"row"=>13, "value"=>$this->result[0]['ProgramSession']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>4,"row"=>13, "value"=>$this->result[0]['Attendance']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>5,"row"=>13, "value"=>$this->result[1]['ActivityCount']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>6,"row"=>13, "value"=>$this->result[1]['ProgramSession']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>7,"row"=>13, "value"=>$this->result[1]['Attendance']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>8,"row"=>13, "value"=>$this->result[2]['ActivityCount']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>9,"row"=>13, "value"=>$this->result[2]['ProgramSession']['DSB']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>10,"row"=>13, "value"=>$this->result[2]['Attendance']['DSB']
        );
        #DSC
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>2,"row"=>15, "value"=>$this->result[0]['ActivityCount']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>3,"row"=>15, "value"=>$this->result[0]['ProgramSession']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>4,"row"=>15, "value"=>$this->result[0]['Attendance']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>5,"row"=>15, "value"=>$this->result[1]['ActivityCount']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>6,"row"=>15, "value"=>$this->result[1]['ProgramSession']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>7,"row"=>15, "value"=>$this->result[1]['Attendance']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>8,"row"=>15, "value"=>$this->result[2]['ActivityCount']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>9,"row"=>15, "value"=>$this->result[2]['ProgramSession']['DSC']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>10,"row"=>15, "value"=>$this->result[2]['Attendance']['DSC']
        );
        #DSD
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>2,"row"=>17, "value"=>$this->result[0]['ActivityCount']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>3,"row"=>17, "value"=>$this->result[0]['ProgramSession']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>4,"row"=>17, "value"=>$this->result[0]['Attendance']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>5,"row"=>17, "value"=>$this->result[1]['ActivityCount']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>6,"row"=>17, "value"=>$this->result[1]['ProgramSession']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>7,"row"=>17, "value"=>$this->result[1]['Attendance']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>8,"row"=>17, "value"=>$this->result[2]['ActivityCount']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>9,"row"=>17, "value"=>$this->result[2]['ProgramSession']['DSD']
        );
        $this->xlsxdata[] = array(
            "sheetindex"=>4,"col"=>10,"row"=>17, "value"=>$this->result[2]['Attendance']['DSD']
        );
    }

}
?>