<!-- 5. $PROFILE ===================================================================================

		Profile
-->
<?
$allsupervisorids = array();
$alluserids = array();
$alluserids[] = $eventproposal['Eventproposal']['user_id'];
?>
<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("我的活動計劃", array("action"=>"index"))?>
    </li>
    <li class="active"><?=h($eventproposal['Eventproposal']['name']) ?></li>
</ul>


<div class="row m-t-1">
<div class="col-md-2">

    <?
    if($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor || $superadmin){
    ?>
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <span class="panel-title"> 設定 </span>
        </div>
            <div class="list-group">
                <?
                    if($eventproposal['Eventproposal']['approvalrecordstatus_id'] == 4){
                        echo $this->Form->postLink('<i class="fa fa-times" style="color: red"></i> 刪除活動計劃', array('action' => 'delete', $eventproposal['Eventproposal']['id']), array('escape'=>false, "class"=>"list-group-item"), __('你確的要完全刪除活動計劃 %s? 這個行動是不能復回的。', $eventproposal['Eventproposal']['name']));
                    }
                ?>
                <?=$this->Html->link('<i class="fa fa-users" style="color: #4ab6d5"></i> 負責職員', array('action'=>"editerole", $eventproposal['Eventproposal']['id']), array('escape' => false, 'class'=>"list-group-item"));?>
                <?if($issupervisor){
                    if(!$eventproposal['Eventproposal']['closed']){
                ?>
                    <div class="btn-group" role="group">
                        <?echo $this->Html->Link('<i class="fa fa-dot-circle-o" style="color: red"></i>  結束計劃', array("action"=>'closeproject', $eventproposal['Eventproposal']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "list-group-item", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));?>
                    </div>
                <?
                    }else{
                ?>
                    <div class="btn-group" role="group">
                        <?=$this->Form->postLink('<i class="fa fa-refresh" style="color: #4ab6d5"></i> 重開計劃', array('action'=>"reactiveproject", $eventproposal['Eventproposal']['id']), array("class" => "list-group-item", 'escape' => false), __('你確定重開計劃？'));?>
                    </div>
                <?
                    }
               }?>
            </div>
    </div>
    <?}?>
    <div class="panel panel-transparent">
        <?
        $stsclass = $eventproposal['Approvalrecordstatus']['labelclass'];
        ?>
        <div class="panel-heading">
            <span class="panel-title">活動計劃書  <span class="label <?=$stsclass?>"><?=h($eventproposal['Approvalrecordstatus']['name'])?></span></span>
        </div>
        <div class="panel-body">
            <p class="text-muted">
                <small>最後更新時間: <?=h($eventproposal['Eventproposal']['modified'])?></small>
            </p>
            <?=$this->Html->link('<i class="fa fa-search"></i> 查看', array('action'=>"viewdetail", $eventproposal['Eventproposal']['id']), array('escape' => false, 'class'=>"btn btn-success btn-block"));?>
            <br/>
            <?
            //審評
            if($issupervisor && $eventproposal['Approvalrecordstatus']['needalert'] == 1)
            {
            ?>
                <?php echo $this->Html->Link('<i class="fa fa-reply"></i> 批閱', array("action"=>'doapproval', $eventproposal['Eventproposal']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "btn btn-warning btn-block", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static")); ?>
            <?}?>
            <?if($eventproposal['Approvalrecordstatus']['needrequest'] == 1 && ($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor)){?>
                <?= $this->Form->postLink("<i class='fa fa-bullhorn'></i>  要求批閱", array("action"=>'requestapproval', $eventproposal['Eventproposal']['id']), array("class" => "btn btn-warning btn-block", 'escape' => false), __('你確定要求批閱？'));?>
            <?}?>

        </div>
    </div>
    <?
        if($eventproposal['Eventproposal']['approved']){
    ?>
            <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title"> 活動報告書 <span class="label <?=$eventproposal['Eventfinalreport']['Approvalrecordstatus']['labelclass']?>"><?=h($eventproposal['Eventfinalreport']['Approvalrecordstatus']['name'])?></span></span>
            </div>
                <div class="panel-body">
            <?

            if(!empty($eventproposal['Eventfinalreport']['id'])){
            ?>
            <p class="text-muted">
                <small>最後更新時間: <?=h($eventproposal['Eventfinalreport']['modified'])?></small>
            </p>
            <?
                echo $this->Html->link('<i class="fa fa-search"></i> 查看', array("controller"=>"eventfinalreports",'action'=>"viewdetail", $eventproposal['Eventfinalreport']['id']), array('escape' => false, 'class'=>"btn btn-success btn-block"));
            ?>
                <br />
            <?
                if($issupervisor && $eventproposal['Eventfinalreport']['Approvalrecordstatus']['needalert'] == 1)
                {
                     echo $this->Html->Link('<i class="fa fa-reply"></i> 批閱', array("controller"=>"eventfinalreports","action"=>'doapproval', $eventproposal['Eventfinalreport']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "btn btn-warning btn-block", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
                }
                if($eventproposal['Eventfinalreport']['Approvalrecordstatus']['needrequest'] == 1 && ($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor)){
                    echo $this->Form->postLink("<i class='fa fa-bullhorn'></i>  要求批閱", array("controller"=>"eventfinalreports","action"=>'requestapproval', $eventproposal['Eventfinalreport']['id'],'redirect'=>urlencode($this->Html->url(null, true))), array("class" => "btn btn-warning btn-block", 'escape' => false), __('你確定要求批閱？'));
                }
                if($eventproposal['Eventfinalreport']['approved'] && !$eventproposal['Eventproposal']['closed']&& ($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor)){
                    echo $this->Html->Link("<i class='fa fa-dot-circle-o'></i>  結束計劃", array("action"=>'closeproject', $eventproposal['Eventproposal']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "btn btn-danger btn-block", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
                }
            }else{
            ?>
                <span class="label label-primary">未有記錄</span><br/><br/>
                <?
                if($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor)
                {
                    echo $this->Html->link("新增", array("controller"=>"eventfinalreports", "action"=>"add", $eventproposal['Eventproposal']['id']), array("class" => "btn btn-success btn-block", 'escape' => false));
                }
                ?>
            <?
            }
            ?>
                </div>
        </div>
    <?
        }
    ?>

    <?if(!empty($eventproposal['Eventproposal']['paymentcodecolor'])){?>
    <div class="panel panel-transparent profile-skills">
        <div class="panel-heading">
            <span class="panel-title"> 收據顏色 </span>
        </div>
        <div class="panel-body">
            <?echo $eventproposal['Eventproposal']['paymentcodecolor'];?>
        </div>
    </div>
    <?}?>


    <div class="panel panel-transparent profile-skills">
        <div class="panel-heading">
            <span class="panel-title"> 主要負責職員</span>
        </div>
        <div class="panel-body">
            <?echo '<span class="label label-primary">'.$eventproposal['User']['name'].'</span>';?>
        </div>
    </div>

    <div class="panel panel-transparent profile-skills">
        <div class="panel-heading">
            <span class="panel-title">
                監督 Supervisor
            </span>
        </div>
        <div class="panel-body">
            <?
            if(!empty($eventproposal['Supervisors'])){
                foreach($eventproposal['Supervisors'] as $val){
                    $allsupervisorids[] = $val['id'];
                    echo '<span class="label label-primary">'.$val['name'].'</span>';
                }
            }
            ?>
        </div>
    </div>

    <div class="panel panel-transparent profile-skills">
        <div class="panel-heading">
            <span class="panel-title"> 其他負責職員</span>
        </div>
        <div class="panel-body">
            <?
            if(!empty($eventproposal['UserIncharge'])){
                foreach($eventproposal['UserIncharge'] as $val){
                    $alluserids[] = $val['id'];
                    echo '<span class="label label-primary">'.$val['name'].'</span>';
                }
            }
            ?>
        </div>
    </div>

    <div class="panel panel-transparent profile-skills">
        <div class="panel-heading">
            <span class="panel-title"> 系統</span>
        </div>
        <div class="list-group">
                <?=$this->Html->link('<i class="profile-list-icon fa fa-envelope" style="color: #888"></i> 監督員', array("controller"=>"messages",'action'=>"sendmsg", "userids"=>$allsupervisorids), array('escape' => false, 'class'=>"openasnew list-group-item"));?>
                <?=$this->Html->link('<i class="profile-list-icon fa fa-envelope" style="color: #888"></i> 負責職員', array("controller"=>"messages",'action'=>"sendmsg", "userids"=>$alluserids), array('escape' => false, 'class'=>"openasnew list-group-item"));?>
        </div>
    </div>

</div>

    <hr class="page-wide-block visible-xs visible-sm">
    <div class="col-md-10">

        <h1 class="font-size-20 m-y-4">
            <i class="fa fa-folder-o page-header-icon"></i>
            <?= h($eventproposal['Eventproposal']['name']) ?>
            <?if(!empty($eventproposal['Eventproposal']['event_code'])){
                ?>
                ( 編號: <?=h($eventproposal['Eventproposal']['event_code'])?> )
            <?}?>
            <?php
            if($eventproposal['Eventproposal']['closed']){
                echo '<a href="#" class="label">已結束</a>';
            }else{
                echo '<a href="#" class="label label-success">進行中</a>';
            }
            ?>
            <?php
            if($eventproposal['Eventproposal']['approved']){
                echo '<a href="#" class="label label-success">已批閱</a>';
            }else{
                echo '<a href="#" class="label ">未批閱</a>';
            }
            ?>
            <span class="label label-info">
                <?=h($eventproposal['Year']['name'])?>
             </span>
        </h1>


    <div class="profile-content">
        <?
        //active 就可以開始
            if($eventproposal['Eventproposal']['approved']){
        ?>
                <?
                    if(!empty($eventproposal['Activity'])){

                ?>
                        <ul class="nav nav-tabs nav-tabs-simple" id="profile-tabs">
                            <?
                            $active = "class='active'";
                            foreach($eventproposal['Activity'] as $ac){
                            ?>
                            <?
                                if(!$ac['active']){
                                    $cancellable = '<span class="label">未生效</span>';
                                }else{
                                    $cancellable = "";
                                }
                                if($ac['closed']){
                                    $closelabel = '<span class="label label-danger">已完結</span>';
                                }else{
                                    $closelabel = "";
                                }
                                if(!empty($ac['activity_code'])){
                                    $acode = " ( ".h($ac['activity_code'])." ) ";
                                }else{
                                    $acode = "";
                                }
                            ?>
                                <li <?=$active?>>
                                    <a id="tab<?=$ac['id']?>" href="#tab<?=$ac['id']?>" data-toggle="tab"><?=h($ac['name'])?><?=$acode?> <?=$cancellable?> <?=$closelabel?></a>
                                </li>
                            <?
                                $active = "";
                            }
                            ?>
                            <li>
                                <?=$this->Html->link("<i class='fa fa-plus'></i> 新增", array("controller"=>"activities", "action"=>'add', $eventproposal['Eventproposal']['id']), array('escape' => false)); ?>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-bordered panel-padding">
                            <?
                            $active = "active";
                            foreach($eventproposal['Activity'] as $ac){
                                $activitycanedit = true;

                                if(!$ac['active']){
                                    $cancellable = '<span class="badge">未生效</span>';
                                    $activitycanedit = false;
                                }else{
                                    $cancellable = "";
                                }

                                if($ac['closed']){
                                    $activitycanedit = false;
                                    $closelabel = '<span class="badge badge-danger">已完結</span>';
                                }else{
                                    $closelabel = "";
                                }
                            ?>
                                <div class="tab-pane panel colourable fade in <?=$active?>" id="tab<?=$ac['id']?>">
                                    <?
                                    if(!$ac['publish']){
                                        ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <span class="panel-title"><i class="fa fa-warning"></i> 注意</span>
                                                <div class="panel-heading-controls">
                                                    <?php echo $this->Form->postLink('確認活動', array("controller"=>"activities", "action"=>"publish", $ac['id']), array('escape'=>false, "class"=>"btn btn-sm btn-info"), __('你確定要確認活動 %s?', $ac['name'])); ?>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                活動 ( <?=$ac['name']?> ) 還未確認公開。 請確認所有資料，然後才確認活動。<br />
                                                活動會於確認後取得活動編號<br />
                                                注意：<br />
                                                1) 確認活動後便不能刪除。<br />
                                                2) 統計設定不能更改。
                                            </div>
                                        </div>
                                    <?
                                    }
                                    ?>
                                        <div class="panel-heading">
                                            <span class="panel-title">&nbsp;<?=$cancellable?> <?=$closelabel?></span>
                                            <div class="panel-heading-controls">
                                                <a class="btn btn-xs btn-success btn-outline" data-toggle="modal" data-target="#clone_modal" onclick="$('#clone_ac_id').val('<?=$ac['id']?>')"><span class="fa fa-clone"></span>&nbsp;&nbsp;複製</a>
                                                <?
                                                if($activitycanedit)
                                                {
                                                    echo $this->Html->link('<span class="fa fa-pencil"></span>&nbsp;&nbsp;修改', array("controller"=>"activities", "action"=>"edit", $ac['id']), array("class"=>"btn btn-xs btn-success btn-outline", "escape"=>false));
                                                }
                                                if(!$ac['publish']){
                                                    echo $this->Form->postLink('<span class="fa fa-times"></span>&nbsp;&nbsp;刪除', array("controller"=>"activities", "action"=>"delete", $ac['id']), array('escape'=>false, "class"=>"btn btn-xs btn-danger btn-outline"), __('你確定要刪除活動 %s?', $ac['name']));
                                                }
                                                //如未生效或公開
                                                if($ac['publish']){
                                                    //完結
                                                    if(!$ac['closed'] && $ac['active']){
                                                        echo $this->Html->Link('<span class="fa fa-dot-circle-o"></span>&nbsp;&nbsp;完結', array("controller"=>"activities", "action"=>"close", $ac['id'], 'ajax'=>true), array("class" => "btn btn-xs btn-danger btn-outline", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
                                                        //生效
                                                        if($issupervisor){
                                                            echo $this->Form->postLink('<span class="fa fa-dot-circle-o"></span>&nbsp;&nbsp;取消', array("controller"=>"activities", "action"=>"chactive", $ac['id'], 0), array('escape'=>false, "class"=>"btn btn-xs btn-warning btn-outline"), __('你確定要結束活動 %s?', $ac['name']));
                                                        }
                                                    }else{
                                                        if($issupervisor){
                                                            if(!$ac['active']){
                                                                echo $this->Form->postLink('<span class="fa fa-refresh"></span>&nbsp;&nbsp;重啓', array("controller"=>"activities", "action"=>"chactive", $ac['id'], 1), array('escape'=>false, "class"=>"btn btn-xs btn-success btn-outline"), __('你確定要重啓活動 %s?', $ac['name']));
                                                            }else if($ac['closed']){
                                                                echo $this->Form->postLink('<span class="fa fa-refresh"></span>&nbsp;&nbsp;取消完結', array("controller"=>"activities", "action"=>"reopen", $ac['id'], 1), array('escape'=>false, "class"=>"btn btn-xs btn-success btn-outline"), __('你確定要取消完結活動 %s?', $ac['name']));
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <div class="btn-group btn-group-xs">
                                                        <button class="btn btn-info dropdown-toggle btn-outline" type="button" data-toggle="dropdown"><span class="fa fa-magnet"></span>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-header">類別</li>
                                                            <li>
                                                                <?=$this->Html->link('會員', array("controller"=>"members", "action"=>"matching", $ac['id']), array("class"=>"openasnew", "escape"=>false))?>
                                                            </li>
                                                            <?
                                                            //another helper / volunteer
                                                            if(!empty($volunteertypes)){
                                                                foreach($volunteertypes as $vtype_id=>$vtype){
                                                                    ?>
                                                                    <li>
                                                                        <?=$this->Html->link(h($vtype), array("controller"=>"volunteers", "action"=>"matching", $vtype_id), array("class"=>"openasnew", "escape"=>false))?>
                                                                    </li>
                                                                <?
                                                                }
                                                            }
                                                            ?>

                                                        </ul> <!-- / .dropdown-menu -->
                                                    </div> <!-- / .btn-group -->
                                                    <div class="btn-group btn-group-xs">
                                                        <button class="btn btn-info dropdown-toggle btn-outline" type="button" data-toggle="dropdown"><span class="fa fa-users"></span>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-header">名單管理</li>
                                                            <li>
                                                                <?=$this->Html->link('參加者', array("controller"=>"activityapplicants", "action"=>"management", $ac['id'], "withoutmenu"=>1), array("class"=>"openasnew", "escape"=>false))?>
                                                            </li>
                                                            <?
                                                            //another helper / volunteer
                                                            if(!empty($volunteertypes)){
                                                                foreach($volunteertypes as $vtype_id=>$vtype){
                                                            ?>
                                                                <li>
                                                                    <?=$this->Html->link(h($vtype), array("controller"=>"activitiesVolunteers", "action"=>"management", $ac['id'],$vtype_id, "withoutmenu"=>1), array("class"=>"openasnew", "escape"=>false))?>
                                                                </li>
                                                            <?
                                                                }
                                                            }
                                                            ?>
                                                        </ul> <!-- / .dropdown-menu -->
                                                    </div> <!-- / .btn-group -->
                                                <?}?>
                                            </div> <!-- / .panel-heading-controls -->
                                        </div> <!-- / .panel-heading -->
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered table-condensed table-hover">
                                                <tbody>
                                                <tr>
                                                    <td>編號</td>
                                                    <td colspan="3"><?=h($ac['activity_code'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>名稱</td>
                                                    <td colspan="3"><?=h($ac['name'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>對象</td>
                                                    <td><?=h($ac['target'])?></td>
                                                    <td>地點</td>
                                                    <td><?=h($ac['place'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>開始日期</td>
                                                    <td><?=h($ac['startdate'])?></td>
                                                    <td>結束日期</td>
                                                    <td><?=h($ac['enddate'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>報名 ／ 名額</td>
                                                    <td><span class="text-success"><?=sizeof($ac['Activityapplicant'])?></span> / <?=h($ac['quota'])?></td>
                                                    <td>堂數</td>
                                                    <td>
                                                    <?
                                                    $noofsession = 0;
                                                    if(!empty($ac['Activitysession'])){
                                                        foreach($ac['Activitysession'] as $se){
                                                            $noofsession += $se['session'];
                                                        }
                                                    }
                                                    echo $noofsession;
                                                    ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>導師</td>
                                                    <td><?=h($ac['tutor'])?></td>
                                                    <td>負責同事</td>
                                                    <td><?=h($ac['incharge'])?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="success">統計設定</th>
                                                </tr>
                                                <tr>
                                                    <td>預設職員</td>
                                                    <td><?=h($ac['Countuser']['name'])?></td>
                                                    <td>類型</td>
                                                    <td><?=h($ac['Activitytype']['name'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>單位</td>
                                                    <td colspan="3">
                                                        <?
                                                        if($ac['Unit']){
                                                            $comma = "";
                                                            foreach($ac['Unit'] as $aunit){
                                                                echo $comma.$aunit['name'];
                                                                $comma = ", ";
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>類別</td>
                                                    <td colspan="3"><?=h($ac['Activitygroup']['name'])?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="success">報名設定</th>
                                                </tr>
                                                <tr>
                                                    <td>報名時間</td>
                                                    <td><?=h($ac['enrolstart'])?></td>
                                                    <td>至</td>
                                                    <td><?=h($ac['enrolend'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>只限會員</td>
                                                    <td><?=__("symboltick_".$ac['memberonly'])?></td>
                                                    <td>會籍必須至 </td>
                                                    <td><?=h($ac['membershipcheck'])?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="success">收費</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">基本收費</td>
                                                    <td colspan="2">
                                                        $<?=money_format("%i", $ac['fee'])?>
                                                    </td>
                                                </tr>
                                                <?
                                                if(!empty($ac['Activityfee'])){
                                                    foreach($ac['Activityfee'] as $otherfee){
                                                ?>
                                                    <tr>
                                                        <td colspan="2"><?=h($otherfee['Membertype']['name'])?></td>
                                                        <td colspan="2">$<?=money_format("%i", $otherfee['fee'])?></td>
                                                    </tr>
                                                <?
                                                    }
                                                }
                                                ?>
                                                <?
                                                    if($ac['closed']){
                                                ?>
                                                    <tr>
                                                        <th colspan="4" class="success">活動完結</th>
                                                    </tr>
                                                    <tr>
                                                        <td>原因</td>
                                                        <td><?=h($ac['Closereason']['name'])?></td>
                                                        <td>是否成功</td>
                                                        <td><?=__("symboltick_".$ac['issuccess'])?></td>
                                                    </tr>
                                                    <td>備註</td>
                                                    <td colspan="3">
                                                        <?=h($ac['closereason'])?>
                                                    </td>

                                                <?
                                                    }
                                                if(!empty($ac['remarks'])){
                                                ?>
                                                    <tr>
                                                        <th colspan="4" class="success">其他</th>
                                                    </tr>
                                                    <tr>
                                                        <td>活動備註</td>
                                                        <td colspan="3">
                                                            <?=h($ac['remarks'])?>
                                                        </td>
                                                    </tr>
                                                <?}?>
                                                </tbody>
                                            </table>
                                         </div>

                                        <div class="panel-heading">
                                            <span class="panel-title">節數</span>
                                            <?
                                            if($activitycanedit){
                                            ?>
                                                <div class="panel-heading-controls">
                                                    <?=$this->Html->link('<span class="fa fa-plus-square"></span> 新增', array("controller"=>"activitysessions", "action"=>"addsession", $ac['id']), array("class"=>"btn btn-xs btn-info btn-outline", "escape"=>false))?>
                                                    <div class="btn-group btn-group-xs">
                                                        <button class="btn btn-info dropdown-toggle btn-outline" type="button" data-toggle="dropdown"><span class="fa fa-hand-paper-o"></span>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-header">出席情況</li>
                                                            <li>
                                                                <?=$this->Html->link('參加者', array("controller"=>"activityapplicants", "action"=>"viewallattendant", $ac['id']), array("class"=>"openasnew", "escape"=>false))?>
                                                            </li>
                                                            <?
                                                            //another helper / volunteer
                                                            if(!empty($volunteertypes)){
                                                                foreach($volunteertypes as $vtype_id=>$vtype){
                                                                    ?>
                                                                    <li>
                                                                        <?=$this->Html->link(h($vtype), array("controller"=>"activitiesVolunteers", "action"=>"viewallattendant", $ac['id'],$vtype_id), array("class"=>"openasnew", "escape"=>false))?>
                                                                    </li>
                                                                <?
                                                                }
                                                            }
                                                            ?>
                                                        </ul> <!-- / .dropdown-menu -->
                                                    </div> <!-- / .btn-group -->
                                                </div>
                                            <?}?>
                                        </div> <!-- / .panel-heading -->
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                                <thead>
                                                <tr>
                                                    <th>
                                                        日期 (統計職員)
                                                    </th>
                                                    <th class="hidden-xs">
                                                        節數
                                                    </th>
                                                    <th>
                                                        點名
                                                    </th>
                                                    <th>
                                                        行動
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                if(!empty($ac['Activitysession'])){
                                                    foreach($ac['Activitysession'] as $se){
                                                        $c_msg = '';
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?=$se['date']?> <small><br/>
                                                            <small><?=date("h:i A", strtotime($se['starttime']))?> - <?=date("h:i A", strtotime($se['endtime']))?></small><br/>
                                                            <?if(!empty($se['Countuser']['name'])){?>
                                                                ( <?=h($se['Countuser']['name'])?> )</small>
                                                            <?}?>

                                                        </td>
                                                        <td class="hidden-xs"><?=$se['session']?></td>
                                                        <td>
                                                            <?
                                                            if($ac['publish'] && $activitycanedit && $this->Cutoffdate->check($se['date'], $c_msg))
                                                            {
                                                            ?>
                                                            <div class="btn-group btn-group-xs">
                                                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-users"></span></button>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li>
                                                                        <?=$this->Html->link('參加者', array("controller"=>"activityattendants", "action"=>"takeatt", $se['id'],$ac['id']), array("class"=>"openasnew", "escape"=>false))?>
                                                                    </li>
                                                                    <?
                                                                    //another helper / volunteer
                                                                    if(!empty($volunteertypes)){
                                                                        foreach($volunteertypes as $vtype_id=>$vtype){
                                                                    ?>
                                                                        <li>
                                                                            <?=$this->Html->link(h($vtype), array("controller"=>"activitiesVolunteerAttendants", "action"=>"takeatt", $se['id'], $ac['id'],$vtype_id), array("class"=>"openasnew", "escape"=>false))?>
                                                                        </li>
                                                                    <?
                                                                        }
                                                                    }?>
                                                                </ul> <!-- / .dropdown-menu -->
                                                            </div>
                                                            <?
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?
                                                            if($activitycanedit && $this->Cutoffdate->check($se['date'], $c_msg)){
                                                                if(!empty($c_msg)){
                                                                    $popupword = $c_msg;
                                                                }else{
                                                                    $popupword = __('你確定要刪除日期 # %s?', $se['date']);
                                                                }
                                                            ?>
                                                            <?  echo $this->Html->link('<span class="fa fa-pencil"></span>', array("controller"=>"activitysessions", "action"=>"edit", $se['id']), array("class"=>"btn btn-xs btn-warning", "escape"=>false))?>
                                                            <?  echo $this->Form->postLink('<i class="fa fa-times"></i>', array("controller"=>"activitysessions", 'action' => 'delete', $se['id']), array('escape'=>false, "class"=>"btn btn-xs btn-danger"), $popupword);?>
                                                            <?
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>

<!--                                            系統文件-->
                                        <div class="panel-info">
                                            <div class="panel-heading">
                                                <span class="panel-title"><i class="panel-title-icon fa fa-folder-o"></i>相關文件</span>
                                            </div> <!-- / .panel-heading -->
                                            <div class="ps-block">
                                                <div class="widget-support-tickets-item">
                                                    <div class="comment-body" style="margin-left: 0">
                                                        <div class="comment-by">
                                                            <a href="#" title="">會員點名表</a>
                                                        </div>
                                                        <div class="comment-actions">
                                                            <?=$this->Html->link('<span class="text-success"><i class="fa fa-download"></i> Download</span>', array('controller'=>"Activityapplicants",'action' => 'exportattendentsheet' , $ac['id'],'redirect'=>urlencode($this->Html->url(null, true))), array("class"=>"", "escape"=>false));?>
                                                        </div>
                                                    </div> <!-- / .comment-body -->
                                                </div>

                                                <?
                                                //another helper / volunteer
                                                if(!empty($volunteertypes)){
                                                    foreach($volunteertypes as $vtype_id=>$vtype){
                                                        ?>
                                                        <div class="widget-support-tickets-item">
                                                            <div class="comment-body" style="margin-left: 0">
                                                                <div class="comment-by">
                                                                    <a href="#" title=""><?=h($vtype)?>點名表</a>
                                                                </div>
                                                                <div class="comment-actions">
                                                                    <?=$this->Html->link('<span class="text-success"><i class="fa fa-download"></i> Download</span>', array('controller'=>"ActivitiesVolunteers",'action' => 'exportattendentsheet' , $ac['id'], $vtype_id,'redirect'=>urlencode($this->Html->url(null, true))), array("class"=>"", "escape"=>false));?>
                                                                </div>
                                                            </div> <!-- / .comment-body -->
                                                        </div>
                                                    <?
                                                    }
                                                }
                                                ?>
                                            </div> <!-- / .panel-body -->
                                        </div>
<!--                                            上傳文件-->
                                        <div class="panel-success ">
                                            <div class="panel-heading">
                                                <span class="panel-title"><i class="panel-title-icon fa fa-folder-o"></i><?=__("eventproposals_viewdetail_txt_8")?></span>
                                                <div class="panel-heading-controls">
                                                    <div class="panel-heading-text">
                                                        <?php echo $this->Html->link('<span class="fa fa-upload"></span> ', array('controller'=>"Attachments", 'action' => 'uploadatt', 'Activity', $ac['id'], utf8_encode($ac['name']),'redirect'=>urlencode($this->Html->url(null, true))), array('class'=>'', 'escape'=>false)); ?>
                                                    </div>
                                                </div>
                                            </div> <!-- / .panel-heading -->
                                            <div class="ps-block">
                                                <!-- Panel padding, without vertical padding -->
                                                <?if(!empty($ac['Attachment'])){
                                                    ?>
                                                        <?
                                                        foreach($ac['Attachment'] as $att){
                                                            ?>
                                                            <div class="widget-support-tickets-item">
                                                                <a href="#" title="" class="widget-support-tickets-title"><?=h($att['name'])?></a>
                                                                <?if(!empty($att['des'])){
                                                                    echo $this->Text->autoParagraph(h($att['des']));
                                                                }?>
                                                                <span class="widget-support-tickets-info">
                                                                     Uploaded by <a href="#" title=""><?=h($att['User']['name'])?></a>
                                                                    <br />
                                                                    <?=$this->Html->link('<span class="text-success"><i class="fa fa-download"></i> Download</span>', array("controller"=>"Attachments", "action"=>"download", $att['id']), array("class"=>"", "escape"=>false));?>
                                                                    <?= $this->Form->postLink('<span class="text-danger"><i class="fa fa-times"></i>  Remove</span>', array("controller"=>"Attachments", "action"=>"delete", $att['id'],'redirect'=>urlencode($this->Html->url(null, true))), array("class" => "", 'escape' => false), __('你確定要刪除附件 （ %s ）？', h($att['name'])));?>
                                                                    <span class="pull-right"><?=h($att['created'])?></span>
                                                                </span>
                                                            </div>
                                                        <?
                                                        }
                                                        ?>

                                                <?
                                                }
                                                ?>

                                            </div> <!-- / .panel-body -->
                                        </div>
                                </div>
                            <?
                            $active = "";
                            }
                            ?>
                        </div>
                <?
                    }else{
                ?>
                        <div class="note note-info">沒有活動/服務記錄!</div>
                        <?= $this->Html->link("新增活動/服務", array("controller"=>"activities", "action"=>'add', $eventproposal['Eventproposal']['id']), array("class" => "btn btn-success btn-block", 'escape' => false)); ?><br />
                    <?
                    }
                ?>
        <?
            }else{
        ?>

            <?
                if(!empty($eventproposal['Activity'])){
            ?>
                    <div id="pa-page-alerts-box">
                        <div class="alert alert-warning  alert-dark" data-animate="true" style=""><strong><?=__('活動計劃書必須先批閱，才能繼續[新增/修改][活動/服務]')?></strong> </div>
                    </div>
                    <div id="pa-page-alerts-box">
                        <div class="alert alert-warning  alert-dark" data-animate="true" style=""><strong><?=__('活動計劃書被拒絕後，系統會自動結束所有有關的[活動/服務]。活動計劃書再次批閱後，請自行重啓[活動/服務]')?></strong> </div>
                    </div>

                    <div class="panel panel-success panel-slimscroll">
                        <div class="panel-heading">
                            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i> 已開啓的 活動/服務 清單</span>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body tab-content-padding">
                            <!-- Panel padding, without vertical padding -->
                            <div class="panel-padding no-padding-vr">
                    <?
                    foreach($eventproposal['Activity'] as $ac){

                        if(!$ac['active']){
                            $cancellable = '<span class="label ticket-label">未生效</span>';
                        }else{
                            $cancellable = "";
                        }
                        if(!empty($ac['activity_code'])){
                            $_activity_code = "(編號：".h($ac['activity_code']).")";
                        }else{
                            $_activity_code = "";
                    }
                    ?>
                        <div class="ticket">
                            <?=$cancellable?>
                            <span title="" class="ticket-title"><?=h($ac['name'])?> <span><?=$_activity_code?></span></span>
                        </div> <!-- / .ticket -->
                    <?
                    }
                    ?>
                            </div>
                        </div> <!-- / .panel-body -->
                    </div>
        <?
                }else{
        ?>
                    <div id="pa-page-alerts-box">
                        <div class="alert alert-warning  alert-dark" data-animate="true" style=""><strong><?=__('活動計劃書必須先批閱，取得活動編號後，才能 [新增] [活動/服務記錄]')?></strong> </div>
                    </div>
        <?
                }
            }
        ?>

    </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<div id="clone_modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><span class="fa fa-clone"></span>&nbsp;複製至</h4>
            </div>
            <div class="modal-body">
                <div class="form-group no-margin-hr">
                    <?php echo $this->Form->input('cloneevent_id', array('div'=>false, 'label'=>false, "id"=>"cloneevent_id",'class'=>'form-control', "options"=>$eventlists, "default"=>$eventproposal['Eventproposal']['id']));?>
                </div>
                <input type="hidden" id="clone_ac_id" />
                <?=$this->Html->link('<span class="fa fa-check"></span>&nbsp;&nbsp;確定', "javascript:void(0)", array("class"=>"btn btn-block btn-success", "escape"=>false, "id"=>"cloneconfirm_btn"));?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        // $("body").addClass("page-profile");

        // $('.panel-slimscroll .panel-body > div').slimScroll({ height: 300, alwaysVisible: true, color: '#888',allowPageScroll: true });


        // $('#profile-tabs').tabdrop();
        var taburl = document.location.toString();
        if( taburl.match('#') ) {
            $('#'+taburl.split('#')[1]).click();
        }
        $(".datatable").dataTable({
            searching: false,
            lengthChange: false,
            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
                "sSearch":         "<?=__('sSearch')?>",
                "sInfoEmpty":    "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst":    "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext":     "<?=__('sNext')?>",
                    "sLast":     "<?=__('sLast')?>"
                }
            }
        });

        $("#cloneevent_id").select2({
            dropdownParent: $("#clone_modal")
        });

        $("#cloneconfirm_btn").click(function(){
            var cloneevent_id = $("#cloneevent_id").val();
            var clone_ac_id = $("#clone_ac_id").val();
            if(!cloneevent_id){
                alert("必須選擇");
            }else{
                window.top.location = "<?=$this->Html->url(array("controller"=>"activities", "action"=>"add"), true)?>/"+cloneevent_id+"/"+clone_ac_id;
            }
        });


    });
    $(function() {
        $('#profile-tabs').pxTabResize();
    });

</script>