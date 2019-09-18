<?php
App::uses('AppController', 'Controller');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class EventproposalsController extends AppController
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
//        Configure::write('debug', 2);
        if(!isset($this->request->params['named']['filter'])){
            $this->redirect(array("action"=>"index", "filter"=>1));
        }
        $this->Prg->commonProcess();
        $option = $this->Eventproposal->parseCriteria($this->Prg->parsedParams());

        $this->Eventproposal->recursive = 0;
        $myevent = array();
        $cond = array("Eventproposal.user_id"=>$this->Auth->user("id"));
        $cond = array_merge($cond, $option);
        $events = $this->Eventproposal->find('all', array(
            "conditions"=>array(
                $cond
            )
        ));

        if(!empty($events)){
            foreach($events as $ev){
                $myevent[$ev['Eventproposal']['id']] = $ev;
            }
        }

        $this->Eventproposal->UserIncharge->Behaviors->load('Containable');

        $share = $this->Eventproposal->UserIncharge->find('first', array(
            "conditions"=>array(
                $this->Eventproposal->UserIncharge->alias.".id"=>$this->Auth->user("id")
            ),
            "contain"=>array(
                "EventproposalIncharge"=>array(
                    "conditions"=>$option
                ),
                "EventproposalSupervisors"=>array(
                    "conditions"=>$option
                )
            )
        ));
//        Configure::write('debug', 2);

        if(!empty($share['EventproposalIncharge'])){
            foreach($share['EventproposalIncharge'] as $ein){
                $ein['share'] = 1;
                $myevent[$ein['id']]['Eventproposal'] = $ein;
            }
        }
        if(!empty($share['EventproposalSupervisors'])){
            foreach($share['EventproposalSupervisors'] as $esu){
                if(isset($myevent[$esu['id']]['Eventproposal'])){
                    $myevent[$esu['id']]['Eventproposal']['supervisor'] = 1;
                }else{
                    $esu['supervisor'] = 1;
                    $myevent[$esu['id']]['Eventproposal'] = $esu;
                }

            }
        }
        $this->set('eventproposals', $myevent);
    }

    public function viewall(){
        if(!isset($this->request->params['named']['filter'])){
            $this->redirect(array("action"=>"viewall", "filter"=>1));
        }
        $this->Prg->commonProcess();
        $option = $this->Eventproposal->parseCriteria($this->Prg->parsedParams());

        $this->Eventproposal->recursive = 0;
        $events = $this->Eventproposal->find('all', array(
            "conditions"=>array(
                $option
            )
        ));

        $this->set('eventproposals', $events);
    }

    public function view($id = null)
    {
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Eventfinalreport",
                "Eventfinalreport.Approvalrecordstatus",
                "Activity.Countuser",
                "Activity.Unit",
                "Activity.Attachment",
                "Activity.Activityfee.Membertype",
                "Activity.Activitysession"=>array(
                    "Countuser",
                    "order"=>"Activitysession.date ASC"
                ),
                'Activity.Activitygroup',
                'Activity.Activitytype',
                'Activity.Closereason',
                'Activity.Activityapplicant'=>array(
                    "fields"=>array(
                        "Activityapplicant.id"
                    ),
                    "conditions"=>array(
                        "Activityapplicant.valid"=>1
                    )
                ),
                'Approvalrecordstatus',
                "Eventproposaltype",
                "Attachment.User",
                "Approvalrecord.User",
                "Approvalrecord.Approvalrecordstatus",
                "Supervisors",
                "UserIncharge",
                "User",
                "Year"
            ),
            "conditions"=>array(
                $this->Eventproposal->alias.".id"=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);
        $issupervisor = $this->Eventproposal->issupervisor($id);
        $volunteertypes = $this->Eventproposal->Activity->ActivitiesVolunteer->Volunteer->Volunteertype->find("list");

        $this->set('eventproposal', $eventproposal);
        $this->set('volunteertypes', $volunteertypes);
        $this->set("issupervisor", $issupervisor);

        $eventlists = array();

        $myevent = $this->Eventproposal->getallevent();
        if(!empty($myevent)){
            foreach($myevent as $ev){
                if(!empty($ev['Eventproposal']['event_code'])){
                    $eventlists[$ev['Eventproposal']['id']] = $ev['Eventproposal']['name']." (".$ev['Eventproposal']['event_code'].")";
                }

            }
        }
        $this->set('eventlists', $eventlists);
    }

    public function view2($id = null)
    {
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Eventfinalreport",
                "Eventfinalreport.Approvalrecordstatus",
                "Activity.Countuser",
                "Activity.Unit",
                "Activity.Attachment",
                "Activity.Activityfee.Membertype",
                "Activity.Activitysession"=>array(
                    "Countuser",
                    "order"=>"Activitysession.date ASC"
                ),
                'Activity.Activitygroup',
                'Activity.Activitytype',
                'Activity.Closereason',
                'Activity.Activityapplicant'=>array(
                    "fields"=>array(
                        "Activityapplicant.id"
                    ),
                    "conditions"=>array(
                        "Activityapplicant.valid"=>1
                    )
                ),
                'Approvalrecordstatus',
                "Eventproposaltype",
                "Attachment.User",
                "Approvalrecord.User",
                "Approvalrecord.Approvalrecordstatus",
                "Supervisors",
                "UserIncharge",
                "User",
                "Year"
            ),
            "conditions"=>array(
                $this->Eventproposal->alias.".id"=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);
        $issupervisor = $this->Eventproposal->issupervisor($id);
        $volunteertypes = $this->Eventproposal->Activity->ActivitiesVolunteer->Volunteer->Volunteertype->find("list");

        $this->set('eventproposal', $eventproposal);
        $this->set('volunteertypes', $volunteertypes);
        $this->set("issupervisor", $issupervisor);

        $eventlists = array();

        $myevent = $this->Eventproposal->getallevent();
        if(!empty($myevent)){
            foreach($myevent as $ev){
                if(!empty($ev['Eventproposal']['event_code'])){
                    $eventlists[$ev['Eventproposal']['id']] = $ev['Eventproposal']['name']." (".$ev['Eventproposal']['event_code'].")";
                }

            }
        }
        $this->set('eventlists', $eventlists);
    }

    public function viewdetail($id = null){
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->Behaviors->load('Containable');
        $issupervisor = $this->Eventproposal->issupervisor($id);

        $options = array(
            "contain"=>array(
                "Eventproposalprocedure",
                "Eventproposalpromotion",
                "Eventarrangement",
                "Year",
                'Approvalrecordstatus',
                "Eventproposaltype",
                "Attachment.User",
                "Approvalrecord"=>array(
                    "Approvalrecordstatus",
                    "User",
                    "order"=>array(
                        "Approvalrecord.created DESC"
                    )
                ),
                "Eventproposaltarget",
                'Financialbudget.User',
                'Financialbudget.Financialbudgetdetail.Financialitem',
            ),
            "conditions"=>array(
                $this->Eventproposal->alias.".id"=>$id
            )
        );
        $eventarrangementtypes = $this->Eventproposal->Eventarrangement->Eventarrangementtype->find('list', array('order'=>array("id ASC"), 'conditions'=>array('active'=>true)));
        $eventproposal = $this->Eventproposal->find('first', $options);

        if(!empty($eventproposal['Eventarrangement'])){
            $tmp_array = array();
            foreach($eventproposal['Eventarrangement'] as $val){
                $tmp_array[$val['eventarrangementtype_id']] = $val;
            }
            $eventproposal['Eventarrangement'] = $tmp_array;
        }

        $this->set("issupervisor", $issupervisor);
        $this->set("eventarrangementtypes",$eventarrangementtypes);
        $this->set('eventproposal', $eventproposal);
    }

    //2016-11-01 Watermelon
    public function add(){
        if ($this->request->is('post')) {
            $this->Eventproposal->begin();
            $this->Eventproposal->create();

            $this->request->data['Eventproposal']['proposal_content'] = <<<HTML
義工參與 (有協助策劃及執行活動): 
<span contenteditable="false">
    <input type="checkbox"> 協助策劃
    <input type="checkbox"> 事前準備
    <input type="checkbox"> 執行活動
    <input type="checkbox"> 協助檢討
</span><br />
<span contenteditable="false">
    <b><input type="checkbox"> 健康 / 康 樂 / 教 育及發展 / 其他</b>
</span>
<table class="table table-bordered" >
    <tr contenteditable="false">
        <td style="text-align: center; width: 20%;"><b>形式</b></td>
        <td style="text-align: center; width: 20%;"><b>對象</b></td>
        <td style="text-align: center; width: 20%;"><b>內容</b></td>
        <td style="text-align: center;"><b>目的</b></td>
    </tr>
    <tr >
        <td>
            <span contenteditable="false">
                <input type="checkbox"> 活動 <br>
                <input type="checkbox"> 講座 <br>
                <input type="checkbox"> 旅行 <br>
                <input type="checkbox"> 外來探訪 <br>
                <input type="checkbox"> 派贈 <br>
                <input type="checkbox"> 轉介 <br>
             </span>
            <input type="checkbox"> 其他： &nbsp; &nbsp;
        </td>
        <td>
            <span contenteditable="false">
                <input type="checkbox"> 會員<br>
                <input type="checkbox"> 非會員<br>
            </span>
            資格：

        </td>
        <td>
            <span contenteditable="false">
                <input type="checkbox"> 康樂活動<br>
                <input type="checkbox"> 健康資訊<br>
                <input type="checkbox"> 專題資訊<br>
                <input type="checkbox"> 社區資訊<br>
                <input type="checkbox"> 社區資源<br>
                <input type="checkbox"> 社區教育<br>
                <input type="checkbox"> 探訪<br>
                <input type="checkbox"> 意見表達<br>
            </span>
            <input type="checkbox"> 其他： &nbsp; &nbsp; &nbsp;
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 得悉相關資訊、知識和技巧<br>
                <input type="checkbox"> 提升服務使用者的快樂指數<br>
                <input type="checkbox"> 提升服務使用者的健康指數<br>
                <input type="checkbox"> 轉介社區資源予服務使用者<br>
                <input type="checkbox"> 加強社區人士對服務使用者的關心<br>
                <input type="checkbox"> 加強服務使用者與社區之間的聯繫<br>
                <input type="checkbox"> 增加對服務使用者的了解，提升服務質素<br>
                <input type="checkbox"> 推廣社區共融<br>
             </span>
            <input type="checkbox"> 其他：
        </td>
    </tr>
</table>
<!--    可以加係呢度下邊 -->
<b><input type="checkbox">  義工服務</b>
<table class="table table-bordered">
    <tbody>
    <tr contenteditable="false">
        <td style="text-align: center; width: 20%;"><b>形式</b></td>
        <td style="text-align: center; width: 20%;"><b>對象</b></td>
        <td style="text-align: center; width: 20%;"><b>內容</b></td>
        <td style="text-align: center;"><b>目的</b></td>
    </tr>
    <tr>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 工作坊<br>
                <input type="checkbox"> 商討會<br>
                <input type="checkbox"> 聚會<br>
                <input type="checkbox"> 探訪<br>
                <input type="checkbox"> 街站<br>
                <input type="checkbox"> 考察<br>
                <input type="checkbox"> 旅行<br>
                <input type="checkbox"> 計劃<br>
             </span>
            <input type="checkbox"> 其他：<br>
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 會員<br>
                <input type="checkbox"> 非會員<br>
                <input type="checkbox"> 義工<br>
                <input type="checkbox"> 其他<br>
             </span>
            資格：<br>
        </td>
        <td>
            <span contenteditable="false">
                <input type="checkbox"> 康樂活動<br>
                <input type="checkbox"> 專題資訊<br>
                <input type="checkbox"> 社區教育<br>
                <input type="checkbox"> 義工訓練<br>
                <input type="checkbox"> 義工探訪<br>
                <input type="checkbox"> 活動策劃<br>
                <input type="checkbox"> 社區導向<br>
                <input type="checkbox"> 嘉許禮<br>
            </span>
            <input type="checkbox"> 其他：
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 得悉/掌握相關資訊、知識和技巧<br>
                <input type="checkbox"> 為<span contenteditable="true">＿＿＿＿＿＿＿＿＿＿＿</span>活動作準備<br>
                <input type="checkbox"> 提升自我效能感<br>
                <input type="checkbox"> 強化團隊精神<br>
                <input type="checkbox"> 加強對有需要人士的關心<br>
                <input type="checkbox"> 增加社區人士對<span contenteditable="true">＿＿＿＿＿＿＿＿＿＿＿</span>的認識<br>
                <input type="checkbox"> 建立<span contenteditable="true">＿＿＿＿＿＿＿＿＿＿＿</span>的支援網絡<br>
                <input type="checkbox"> 推廣社區共融<br>
             </span>
            <input type="checkbox"> 其他：
        </td>
    </tr>
    </tbody>
</table>
<span contenteditable="false">
<b><input type="checkbox"> 護老者服務</b><br>
<b><input type="checkbox"> 有需要護老者服務</b>
</span>
<table class="table table-bordered">
    <tr contenteditable="false">
        <td style="text-align: center; width: 20%;"><b>形式</b></td>
        <td style="text-align: center; width: 20%;"><b>對象</b></td>
        <td style="text-align: center; width: 20%;"><b>內容</b></td>
        <td style="text-align: center; "><b>目的</b></td>
    </tr>
    <tr>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 工作坊<br/>
                <input type="checkbox"> 活動<br/>
                <input type="checkbox"> 講座<br/>
                <input type="checkbox"> 聚會<br/>
                <input type="checkbox"> 街站<br/>
                <input type="checkbox"> 旅行<br/>
                <input type="checkbox"> 計劃<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 會員<br/>
                <input type="checkbox"> 非會員<br/>
                <input type="checkbox"> 護老者<br/>
                <input type="checkbox"> 被護老者<br/>
                <input type="checkbox"> 其他<br/>
             </span>
            資格：<br/>
        </td>
        <td>
             <span contenteditable="false">
            <input type="checkbox"> 康樂活動<br/>
            <input type="checkbox"> 專題資訊<br/>
            <input type="checkbox"> 社區教育<br/>
            <input type="checkbox"> 護老者資訊<br/>
            <input type="checkbox"> 護老者訓練<br/>
            <input type="checkbox"> 護老者探訪<br/>
            <input type="checkbox"> 嘉許禮<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 得悉/掌握相關資訊、知識和技巧<br/>
                <input type="checkbox"> 舒緩護老者的照顧壓力<br/>
                <input type="checkbox"> 提升護老者的正面情緒<br/>
                <input type="checkbox"> 加強護老者和被護老者間的關係<br/>
                <input type="checkbox"> 建立護老者的支援網絡<br/>
                <input type="checkbox"> 增加社區人士對護老者服務的認識<br/>
                <input type="checkbox"> 推廣社區共融<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
    </tr>
</table>

<span contenteditable="false">
    <b><input type="checkbox"> 認知障礙症服務</b><br>
</span>
<table class="table table-bordered">
    <tr contenteditable="false">
        <td style="text-align: center; width: 20%;"><b>形式</b></td>
        <td style="text-align: center; width: 20%;"><b>對象</b></td>
        <td style="text-align: center; width: 20%;"><b>內容</b></td>
        <td style="text-align: center; "><b>目的</b></td>
    </tr>
    <tr>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 工作坊<br/>
                <input type="checkbox"> 活動<br/>
                <input type="checkbox"> 講座<br/>
                <input type="checkbox"> 聚會<br/>
                <input type="checkbox"> 街站<br/>
                <input type="checkbox"> 旅行<br/>
                <input type="checkbox"> 計劃<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 會員<br/>
                <input type="checkbox"> 非會員<br/>
                <input type="checkbox"> 疾病長者<br/>
                <input type="checkbox"> 疾病照顧者<br/>
                <input type="checkbox"> 其他<br/>
             </span>
            資格：<br/>
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 康樂活動<br/>
                <input type="checkbox"> 專題資訊<br/>
                <input type="checkbox"> 社區教育<br/>
                <input type="checkbox"> 疾病資訊<br/>
                <input type="checkbox"> 長者訓練<br/>
                <input type="checkbox"> 長者探訪<br/>
                <input type="checkbox"> 嘉許禮<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
        <td>
             <span contenteditable="false">
                <input type="checkbox"> 得悉/掌握相關資訊、知識和技巧<br/>
                <input type="checkbox"> 舒緩認知障礙症照顧者的照顧壓力<br/>
                <input type="checkbox"> 提升認知障礙症照顧者的正面情緒<br/>
                <input type="checkbox"> 加強認知障礙症長者和照顧者間的關係<br/>
                <input type="checkbox"> 建立認知障礙症照顧者的支援網絡<br/>
                <input type="checkbox"> 提升認知障礙症長者認知/活動/溝通能力<br/>
                <input type="checkbox"> 提升認知障礙症長者的自我效能<br/>
                <input type="checkbox"> 增加社區人士對認知障礙症服務的認識<br/>
            <input type="checkbox"> 推廣社區共融<br/>
             </span>
            <input type="checkbox"> 其他：
        </td>
    </tr>
</table>
<b>目標及程序簡介：</b>
<table class="table table-bordered">
<tbody>
  <tr contenteditable="false">
    <td style="text-align: center; width: 50%;"><b>目標</b></td>
    <td style="text-align: center; width: 50%;"><b>程序簡介</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
</tbody>
</table>

<b>檢討方法、內容及指標：</b>
<table class="table table-bordered">
<tbody>
  <tr contenteditable="false">
    <td style="text-align: center; width: 20%;"><b>方法</b></td>
    <td style="text-align: center; width: 30%;"><b>內容</b></td>
    <td style="text-align: center;"><b>指標</b></td>
  </tr>
  <tr>
    <td contenteditable="false"><input type="checkbox"> 工作員觀察</td>
    <td>參加者的參與程度</td>
    <td>＿＿%參加者積極參與是次活動</td>
  </tr>
  <tr>
    <td contenteditable="false"><input type="checkbox"> 口頭詢問</td>
    <td>參加者的滿意程度</td>
    <td>＿＿%參加者滿意是次活動</td>
  </tr>
  <tr>
    <td contenteditable="false"><input type="checkbox"> 問卷調查</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td contenteditable="false"><input type="checkbox"> 前測 / 後測</td>
    <td>(各類量表)</td>
    <td></td>
  </tr>
</tbody>
</table>

<b>準備事工：</b>
<table class="table table-bordered">
<tbody>
  <tr contenteditable="false">
    <td style="text-align: center; width: 30%;"><b>事項</b></td>
    <td style="text-align: center;"><b>預定完成日期</b></td>
    <td style="text-align: center;  width: 10%;"><b>已完成</b></td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 工作員觀察</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 撰寫及發出邀請信</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 聯絡相關團體</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 宣傳及招募參加者</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid white;"><input type="checkbox"> 物資準備＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid white;"><input type="checkbox"> 財政準備(<input type="checkbox"> 報價、預算收支表、＿＿＿＿＿)</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 活動程序表(詳見附件)</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 分工及簡介</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 招募及安排義工協助活動</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 輸入資料至會員系統</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td contenteditable="false" style="border-bottom:1px solid white;"><input type="checkbox"> 前測 / 後測</td>
    <td></td>
    <td style="border-bottom:1px solid white; text-align:center;"><input type="checkbox"> </td>
  </tr>
  <tr>
    <td><input type="checkbox"> 其他：＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿</td>
    <td></td>
    <td style="text-align:center;"><input type="checkbox"> </td>
  </tr>
</tbody>
</table>
HTML;


            if($this->Eventproposal->saveAssociated($this->request->data, array("deep"=>true))){
                $this->Eventproposal->commit();
                $this->Session->setFlash(__('成功新增'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("action"=>'view', $this->Eventproposal->id));
            }else{
                $this->Session->setFlash(__('新增失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00034".')', 'default', array('class'=>'alert alert-danger'));
            }
        }
        $userIncharges = $this->Eventproposal->UserIncharge->find('list',
            array(
                'conditions'=>array(
                    'UserIncharge.id != '.$this->Auth->user('id'),
                    'UserIncharge.active'=>1,
                )
            )
        );
//        Configure::write('debug', 2);
        $supervisors = $this->Eventproposal->Supervisors->getuserrolelist(array(1,3),true);
        $years = $this->Eventproposal->Year->find('list', array(
            "fields"=>array(
                "id", "name"
            ),
            "conditions"=>array(
                $this->Eventproposal->Year->alias.".active"=>1
            ),
            "order"=>array(
                "name DESC"
            )
        ));

        $eventproposalcodes = $this->Eventproposal->Eventproposalcode->find("list", array(
            "conditions"=>array(
                $this->Eventproposal->Eventproposalcode->alias.".active"=>1
            ),
            'order'=>array(
                $this->Eventproposal->Eventproposalcode->alias.'.name'=>"ASC"
            )
        ));
        $targetjson = array();
        foreach($this->Eventproposal->target as $v){

            $targetjson[] = array(
                "id"=>$v,
                "name"=>$v
            );
        }

        $this->set("targetjson", $targetjson);
        $this->set("eventproposalcodes", $eventproposalcodes);
        $this->set("years", $years);
        $this->set("userIncharges", $userIncharges);
        $this->set("supervisors", $supervisors);
    }

    //2016-11-01 Watermelon
    public function viewpending($all){
        $this->Eventproposal->Supervisors->Behaviors->load('Containable');
        if(isset($all) && $all){
            $rs = $this->Eventproposal->Supervisors->find('all', array(
                "contain"=>array(
                    "EventproposalSupervisors"=>array(
                        "conditions"=>array(
                            "EventproposalSupervisors.closed"=>0
                        )
                    ),
                    "EventproposalSupervisors.Approvalrecordstatus",
                    "EventproposalSupervisors.Eventfinalreport.Approvalrecordstatus"
                )
            ));

            $tmp_rs['EventproposalSupervisors'] = array();
            foreach($rs as $proposal){
                $proposal['EventproposalSupervisors'] = Set::combine($proposal['EventproposalSupervisors'], '{n}.id', "{n}");
                if (!empty($proposal['EventproposalSupervisors'])){
                    foreach ($proposal['EventproposalSupervisors'] as $k=>$pro){
                        if(empty($tmp_rs['EventproposalSupervisors'][$k])){
                            $tmp_rs['EventproposalSupervisors'][$k] = $pro;
                        }
                    }
                }
            }
            $rs = $tmp_rs;

        }else{
            $rs = $this->Eventproposal->Supervisors->find('first', array(
                "conditions"=>array(
                    $this->Eventproposal->Supervisors->alias.".id"=>$this->Auth->user("id"),
                ),
                "contain"=>array(
                    "EventproposalSupervisors"=>array(
                        "conditions"=>array(
                            "EventproposalSupervisors.closed"=>0
                        )
                    ),
                    "EventproposalSupervisors.Approvalrecordstatus",
                    "EventproposalSupervisors.Eventfinalreport.Approvalrecordstatus"
                )
            ));

        }

        $this->set('all',$all);
        $this->set('eventproposals', $rs['EventproposalSupervisors']);
    }

    public function editerole($id = null){
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->Behaviors->load('Containable');
        $options = array(
            "conditions"=>array(
                'Eventproposal.id'=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);
        if ($this->request->is('post') || $this->request->is('put')) {
            if($this->Eventproposal->saveAssociated($this->request->data)){
                $this->Session->setFlash(__('更新成功'), 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("action"=>'view', $id));
            }else{
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00035".')', 'default', array('class'=>'alert alert-danger'));
            }
        }else{

            $this->request->data = $eventproposal;

        }

        $userIncharges = $this->Eventproposal->UserIncharge->find('list',
            array(
                'conditions'=>array(
                    'UserIncharge.id != '=>$eventproposal['Eventproposal']['user_id'],
                    'UserIncharge.active'=>true
                )
            )
        );

        $eventproposal = $this->Eventproposal->findById($id);
        $users =  $this->Eventproposal->User->find('list', array(
           'conditions'=>array(
               'active'=>true
           )
        ));

        $this->set('users', $users);
        $this->set('eventproposal', $eventproposal);
        $supervisors = $this->Eventproposal->Supervisors->getuserrolelist(array(1,3), true);
        $this->set("userIncharges", $userIncharges);
        $this->set("supervisors", $supervisors);
    }

    public function edit($id = null){
        //Configure::write('debug', 2);
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->Behaviors->load('Containable');
        $options = array(
            "conditions"=>array(
                'Eventproposal.id'=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Eventproposal->begin();
            // update proposal status
            //如已批閱
            if($eventproposal['Approvalrecordstatus']['needrequest'] != 1 && $eventproposal['Approvalrecordstatus']['needalert'] != 1){
                $this->request->data['Eventproposal']['approvalrecordstatus_id'] = 5;
                $supervisor_ids = array();
                foreach($eventproposal['Supervisors'] as $su){
                    $supervisor_ids[] = $su['id'];
                }

                $this->loadModel("Notification");
                $requesttime = date("Y-m-d G:i");
                $urllink = Router::url(array('action'=>'viewdetail', $id), true);
                $msg = <<<HTML
活動計劃書批閱要求

活動計劃書名稱︰{$eventproposal['Eventproposal']['name']}
負責人︰{$eventproposal['User']['name']}
要求時間︰{$requesttime}
有關活動計劃書的連結︰{$urllink}
HTML;
                $this->Notification->addnotices($msg, "活動計劃書 [".h($eventproposal['Eventproposal']['name'])."]: 批閱要求", $supervisor_ids, array("from_name"=>"系統"));

            }

            $this->Eventproposal->Eventproposalprocedure->deleteAll(array('eventproposal_id' => $id),false);
            if($this->Eventproposal->saveAssociated($this->request->data)){
                $this->Eventproposal->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class'=>'alert alert-success'));
                //$this->redirect(array("action"=>'viewdetail', $this->Eventproposal->id));
            }else{
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試').' ('.configure::read("error_prefix")."00035".')', 'default', array('class'=>'alert alert-danger'));
            }
        }else{

            $this->request->data = $eventproposal;



        }
        $eventproposalpromotions = $this->Eventproposal->Eventproposalpromotion->find('list', array('conditions'=>array('active'=>true)));
        $eventarrangementtypes = $this->Eventproposal->Eventarrangement->Eventarrangementtype->find('list', array('order'=>array("id ASC"), 'conditions'=>array('active'=>true)));

        if(!empty($this->request->data['Eventarrangement'])){
            $tmp_array = array();
            foreach($this->request->data['Eventarrangement'] as $val){
                $tmp_array[$val['eventarrangementtype_id']] = $val;
            }
            $this->request->data['Eventarrangement'] = $tmp_array;
        }
        $years = $this->Eventproposal->Year->find('list', array(
            "fields"=>array(
                "id", "name"
            ),
            "order"=>array(
                "name DESC"
            )
        ));
        $eventproposalcodes = $this->Eventproposal->Eventproposalcode->find("list", array(
            "conditions"=>array(
                $this->Eventproposal->Eventproposalcode->alias.".active"=>1
            )
        ));

        $this->set("eventproposalcodes", $eventproposalcodes);
        $this->set("years", $years);
        $this->set("eventarrangementtypes",$eventarrangementtypes);
        $this->set('eventproposalpromotions',$eventproposalpromotions);
        $this->set('eventproposal', $eventproposal);
    }

    public function requestapproval($id = null){
//        Configure::write('debug', 2);
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        if ($this->request->is('post')) {
            $this->Eventproposal->begin();
            $this->Eventproposal->id = $id;
            $this->Eventproposal->saveField("approvalrecordstatus_id", 2);

            $eventproposal = $this->Eventproposal->findById($id);
            $supervisor_ids = array();
            foreach($eventproposal['Supervisors'] as $su){
                $supervisor_ids[] = $su['id'];
            }

            $this->loadModel("Notification");
            $requesttime = date("Y-m-d G:i");
            $urllink = Router::url(array('action'=>'viewdetail', $id), true);
            $msg = <<<HTML
活動計劃書批閱要求

活動計劃書名稱︰{$eventproposal['Eventproposal']['name']}
負責人︰{$eventproposal['User']['name']}
要求時間︰{$requesttime}
有關活動計劃書的連結︰{$urllink}
HTML;

            $this->Notification->addnotices($msg, "活動計劃書 [".h($eventproposal['Eventproposal']['name'])."]: 批閱要求", $supervisor_ids, array("from_name"=>"系統"));
            $this->Eventproposal->commit();
            return $this->redirect(array("action"=>"view", $id));
        }
    }

    public function doapproval($id = null){
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }

        $eventproposal = $this->Eventproposal->findById($id);
        if($eventproposal['Approvalrecordstatus']['needalert'] != 1){
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is('post')) {
            $error = false;
            if(empty($this->request->data['Approvalrecord']['approvalrecordstatus_id'])){
                $error = true;
            }
            $this->request->data['Approvalrecord']['model'] = "Eventproposal";
            $this->request->data['Approvalrecord']['model_id'] = $id;
            $this->request->data['Approvalrecord']['user_id'] = $this->Auth->user("id");
            $this->request->data['Approvalrecord']['approvaldate'] = date('Y-m-d');

            $this->Eventproposal->begin();
            $this->Eventproposal->Approvalrecord->create();
            if($this->Eventproposal->Approvalrecord->save($this->request->data['Approvalrecord'])){
                $this->Eventproposal->id = $id;

                if(!$this->Eventproposal->saveField("approvalrecordstatus_id", $this->request->data['Approvalrecord']['approvalrecordstatus_id'])){
                    $error = true;
                }
                $sts = $this->Eventproposal->Approvalrecordstatus->findById($this->request->data['Approvalrecord']['approvalrecordstatus_id']);
                if(!$this->Eventproposal->saveField("approved", $sts['Approvalrecordstatus']['changeapprovalstatusto'])){
                    $error = true;
                }
                if(!$this->Eventproposal->saveField("paymentcodecolor",  $this->request->data['Eventproposal']['paymentcodecolor'])){
                    $error = true;
                }

                if(!$this->Eventproposal->saveField("eventproposalcode_id",  $this->request->data['Eventproposal']['eventproposalcode_id'])){
                    $error = true;
                }

                if(!$error){
                    if($sts['Approvalrecordstatus']['changeapprovalstatusto'] == 1){
                        $cuscode = null;
                        if(!empty($this->request->data['Eventproposal']['cuscode'])){
                            $cuscode = $this->request->data['Eventproposal']['cuscode'];
                        }

                        if(!$this->Eventproposal->genevent_code($id, $cuscode)){
                            $error = true;
                        }
                    }else{
                        if(!empty($eventproposal['Activity'])){
                            foreach($eventproposal['Activity'] as $ac){
                                $this->Eventproposal->Activity->id = $ac['id'];
                                $this->Eventproposal->Activity->saveField("active", 0);
                            }
                        }
                    }

                    if(!$error){
                        //send notices
                        $this->loadModel("Notification");
                        $requesttime = date("Y-m-d G:i");
                        $urllink = Router::url(array('action'=>'viewdetail', $id), true);
                        $msg = <<<HTML
活動計劃書批閱結果

活動計劃書名稱︰{$eventproposal['Eventproposal']['name']}
批閱結果︰{$sts['Approvalrecordstatus']['name']}
評語︰{$this->request->data['Approvalrecord']['comment']}
回應時間︰{$requesttime}
有關活動計劃書的連結︰{$urllink}
HTML;

                        $this->Notification->addnotices($msg, "活動計劃書 [".h($eventproposal['Eventproposal']['name'])."]: 批閱結果", array($eventproposal['Eventproposal']['user_id']), array("from_name"=>"系統"));
                        $this->Eventproposal->commit();
                        $this->Session->setFlash(__('成功回應'), 'default', array('class'=>'alert alert-success'));
                        if ($this->request->params['named']['redirect']) {
                            $redirecturl = urldecode($this->request->params['named']['redirect']);
                        } else {
                            $redirecturl = array("controller"=>"Eventproposal", 'action' => 'view', $id);
                        }
                        return $this->redirect($redirecturl);
                    }else{
                        $this->Eventproposal->rollback();
                    }
                }
            }
            if($error){
                $this->Session->setFlash(__('回應失敗').' ('.configure::read("error_prefix")."00036".')', 'default', array('class'=>'alert alert-danger'));
            }
        }
        $this->Eventproposal->Behaviors->load('Containable');

        $options = array(
            "contain"=>array(
                "Year",
                "Eventproposalcode"
            ),
            "conditions"=>array(
                $this->Eventproposal->alias.".id"=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);
        //format val=========
        $year_start = substr($eventproposal['Year']['start'], 2, 2);
        $year_end = substr($eventproposal['Year']['end'], 2, 2);
//        $code = $eventproposal['Eventproposalcode']['name'];
        $code = "__CODE__";
        $number = "";
        //=========
        $eventproposalcodeformat = null;
        $eventproposalcodeformat_raw = Configure::read("eventproposalcodeformat");
        eval("\$eventproposalcodeformat = \"$eventproposalcodeformat_raw\";");

        $approvalrecordstatuses = $this->Eventproposal->Approvalrecordstatus->find('list', array(
            'conditions'=>array(
                    "canapprove"=>1,
            )
        ));

        $eventproposalcodes = $this->Eventproposal->Eventproposalcode->find("list", array(
            "conditions"=>array(
                $this->Eventproposal->Eventproposalcode->alias.".active"=>1
            ),
            'order'=>array(
                $this->Eventproposal->Eventproposalcode->alias.'.name'=>"ASC"
            )
        ));

        $this->set("eventproposalcodes", $eventproposalcodes);
        $this->set('approvalrecordstatuses', $approvalrecordstatuses);
        $this->set("eventproposalcodeformat", $eventproposalcodeformat);
        $this->set("eventproposal", $eventproposal);
        $this->set("eventproposal_id", $id);
    }

    public function closeproject($id = null){
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $eventproposal = $this->Eventproposal->findById($id);
        if($eventproposal['Eventfinalreport']['approved'] != 1 && !$this->Eventproposal->issupervisor($id)){
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Eventproposal->save($this->request->data)) {
                $this->Session->setFlash("成功完結", 'default', array('class'=>'alert alert-success'));
                $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $id));
            } else {
                $this->Session->setFlash("失敗", 'default', array('class'=>'alert alert-danger'));
            }
        }

        $closereasons = $this->Eventproposal->Closereason->find("list", array("conditions"=>array($this->Eventproposal->Closereason->alias.".active"=>1)));
        $this->set("closereasons", $closereasons);
        $this->set("eventproposal_id", $id);
    }

    public function reactiveproject($id = null){
        $this->autoRender = false;
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->Eventproposal->id = $id;
        if($this->Eventproposal->saveField("closed", 0)){
            $this->Session->setFlash(__('計劃已重開'), 'default', array('class'=>'alert alert-success'));
        }else{
            $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class'=>'alert alert-danger'));
        }

        $this->redirect(array("controller"=>"Eventproposals","action"=>'view', $id));
    }

    public function delete($id = null) {
        $this->Eventproposal->id = $id;
        if (!$this->Eventproposal->isAuth($id)) {
            $this->view  = '/Pages/blockfunction';
            $this->set('title', __("你沒有權限行使用這功能"));
            $this->set('errormsg', __("你沒有權限行使用這功能"));
            $this->set('formurl', Router::url( $this->here, true ));
        }
        $this->request->allowMethod('post', 'delete');
        $options = array(
            "conditions"=>array(
                'Eventproposal.id'=>$id
            )
        );
        $eventproposal = $this->Eventproposal->find('first', $options);
        if(!$eventproposal['Eventproposal']['approvalrecordstatus_id'] == 4){
            $this->Session->setFlash('不能刪除活動計劃 ('.$eventproposal['Eventproposal']['name'].')', 'default', array('class' => 'alert alert-danger'));
        }else{
            if ($this->Eventproposal->delete()) {
                $this->Session->setFlash(__('成功刪除'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('失敗，請再檢查後嘗試'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter()
    {
        if($this->request['action'] == 'edit'){
            $this->Security->unlockedFields = array('Eventproposalprocedure');
        }
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        parent::beforeFilter();
    }

}
