<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-info-circle"></i><?=__('基本資料')?></span>
        <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    </div>
    <div class="panel-body">
        <div class="text-right">
            <div class="btn-group btn-group-xs">
                <button class="btn btn-info dropdown-toggle btn-outline" type="button" data-toggle="dropdown"><span class="fa fa-users"></span>&nbsp;名單管理&nbsp;<span class="fa fa-caret-down"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">名單管理</li>
                    <li>
                        <?=$this->Html->link('參加者', array("controller"=>"activityapplicants", "action"=>"management", $ac['Activity']['id'], "withoutmenu"=>1), array("class"=>"openasnew", "escape"=>false))?>
                    </li>
                    <?
                    //another helper / volunteer
                    if(!empty($volunteertypes)){
                        foreach($volunteertypes as $vtype_id=>$vtype){
                            ?>
                            <li>
                                <?=$this->Html->link(h($vtype), array("controller"=>"activitiesVolunteers", "action"=>"management", $ac['Activity']['id'],$vtype_id, "withoutmenu"=>1), array("class"=>"openasnew", "escape"=>false))?>
                            </li>
                        <?
                        }
                    }
                    ?>
                </ul> <!-- / .dropdown-menu -->
            </div> <!-- / .btn-group -->
        </div>
        <br />
        <table class="table">
            <tbody>
            <tr>
                <td>編號</td>
                <td colspan="3"><?=h($ac['Activity']['activity_code'])?></td>
            </tr>
            <tr>
                <td>名稱</td>
                <td colspan="3"><?=h($ac['Activity']['name'])?></td>
            </tr>
            <tr>
                <td><?=__('對象')?></td>
                <td><?=h($ac['Activity']['target'])?></td>
                <td><?=__('地點')?></td>
                <td><?=h($ac['Activity']['place'])?></td>
            </tr>
            <tr>
                <td><?=__('開始日期')?></td>
                <td><?=h($ac['Activity']['startdate'])?></td>
                <td><?=__('結束日期')?></td>
                <td><?=h($ac['Activity']['enddate'])?></td>
            </tr>
            <tr>
                <td><?=__('報名 ／ 名額')?></td>
                <td><span class="text-success"><?=sizeof($ac['Activityapplicant'])?></span> / <?=h($ac['Activity']['quota'])?></td>
                <td><?=__('堂數')?></td>
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
                <td><?=__('導師')?></td>
                <td><?=h($ac['Activity']['tutor'])?></td>
                <td><?=__('負責同事')?></td>
                <td><?=h($ac['Activity']['incharge'])?></td>
            </tr>
            <tr>
                <th colspan="4" class="success">報名設定</th>
            </tr>
            <tr>
                <td><?=__('報名時間')?></td>
                <td><?=h($ac['Activity']['enrolstart'])?></td>
                <td><?=__('至')?></td>
                <td><?=h($ac['Activity']['enrolend'])?></td>
            </tr>
            <tr>
                <td><?=__('只限會員')?></td>
                <td><?=__("symboltick_".$ac['Activity']['memberonly'])?></td>
                <td><?=__('會籍必須至')?></td>
                <td><?=h($ac['Activity']['membershipcheck'])?></td>
            </tr>
            <tr>
                <th colspan="4" class="success"><?=__('收費')?></th>
            </tr>
            <tr>
                <td colspan="2"><?=__('收據顏色')?></td>
                <td colspan="2">
                    <?=h($ac['Eventproposal']['paymentcodecolor'])?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?=__('基本收費')?></td>
                <td colspan="2">
                    $<?=money_format("%i", $ac['Activity']['fee'])?>
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
            </tbody>
        </table>
        <div class="panel-heading">
            <span class="panel-title"><?=__('節數')?></span>
        </div> <!-- / .panel-heading -->
        <table class="table">
            <thead>
            <tr>
                <th>
                    <?=__('日期')?>
                </th>
                <th>
                    <?=__('時間')?>
                </th>
                <th>
                    <?=__('節數')?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?
            if(!empty($ac['Activitysession'])){
                foreach($ac['Activitysession'] as $se){
                    if($se['done']){
                        $selabel= '<span class="label label-success label-tag"><i class="fa fa-check"></i> 點名</span>';
                    }else{
                        $selabel= "";
                    }
                    ?>
                    <tr>
                        <td><?=$se['date']?> </td>
                        <td><?=date("h:i A", strtotime($se['starttime']))?> - <?=date("h:i A", strtotime($se['endtime']))?></td>
                        <td><?=$se['session']?></td>
                    </tr>
                <?
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
