<?
//Configure::write('debug', 2);
//debug($eventfinalreport);
?>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("eventproposals_viewdetail_txt_1").h($eventfinalreport['Eventproposal']['name']), array("controller"=>"Eventproposals","action"=>"view", $eventfinalreport['Eventproposal']['id']))?>
    </li>
    <li class="active"><?=__('活動報告書')?></li>
</ul>
<div class="panel colourable">
<div class="panel-heading">
    <?
    $stsclass = $eventfinalreport['Approvalrecordstatus']['labelclass'];
    ?>

    <span class="panel-title"> <span class="label <?=$stsclass?>"><?=h($eventfinalreport['Approvalrecordstatus']['name'])?></span></span>

    <div class="panel-heading-controls">
        <?
        //審評
        if($issupervisor && $eventfinalreport['Approvalrecordstatus']['needalert'] == 1)
        {
            echo $this->Html->Link('<i class="fa fa-reply"></i> '.__('批閱'), array("controller"=>"eventfinalreports","action"=>'doapproval', $eventfinalreport['Eventfinalreport']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "btn btn-warning btn-xs", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
        }?>
        <?
        if($eventfinalreport['Eventproposal']['user_id'] == $auth['id'] || $issupervisor){
            echo $this->Html->link("<i class='fa fa-pencil'></i> ".__('修改內容'), array("action"=>'edit', $eventfinalreport['Eventfinalreport']['id']), array("class" => "btn btn-xs btn-info", 'escape' => false));
        }
        ?>
    </div> <!-- / .panel-heading-controls -->
</div>
<div class="panel-body">
<div role="tabpanel">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab_1" aria-controls="home" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_1")?></a></li>
    <li role="presentation"><a href="#tab_2" aria-controls="profile" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_2")?></a></li>
    <li role="presentation"><a href="#tab_4" aria-controls="messages" role="tab" data-toggle="tab"><?=__("財政紀錄")?></a></li>
    <li role="presentation"><a href="#tab_3" aria-controls="messages" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_3")?></a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="tab_1">
<div class="panel">
<div class="panel-heading">
    <span class="panel-title"><?=__('基本資料')?></span>
</div>
<div class="panel-body">
    <table class="table table-striped">
        <tbody>
        <tr>
            <td style="width:20%"> <?=__('報名人數')?></td>
            <td><?php echo h($eventfinalreport['Eventfinalreport']['enrolnum']); ?>&nbsp;</td>
        </tr>
        <tr>
            <td><?=__('出席率')?></td>
            <td><?php echo h($eventfinalreport['Eventfinalreport']['attendance']); ?>&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>
<!--                        panel-->
<div class="panel-heading">
    <span class="panel-title"><?=__('活動推行與計劃不同之地方及原因')?><small></small></span>
</div>
<div class="panel-body">
    <table class="table table-striped">
        <tr>
            <th>
                <?=__('項目（人數）')?>
            </th>
            <th>
                <?=__('籌備')?>
            </th>
            <th>
                <?=__('推行')?>
            </th>
            <th>
                <?=__('評估及跟進')?>
            </th>
        </tr>
        <?
        if(!empty($eventarrangementtypes)){
            foreach($eventarrangementtypes as $key=>$val){
                ?>
                <tr>
                    <td>
                        <?=$val?>
                        ( <?=h($eventfinalreport['Eventarrangement'][$key]['count'])?> )
                    </td>
                    <td>
                        <?=h($eventfinalreport['Eventarrangement'][$key]['preparation'])?>
                    </td>
                    <td>
                        <?=h($eventfinalreport['Eventarrangement'][$key]['ongoing'])?>
                    </td>
                    <td>
                        <?=h($eventfinalreport['Eventarrangement'][$key]['following'])?>
                    </td>
                </tr>
            <?
            }
        }
        ?>
    </table>
</div>
<div class="panel-heading">
    <span class="panel-title"><?=__('基本資料')?></span>
</div>
<div class="panel-body">
    <table class="table table-striped">
        <tr>
            <td style="width:20%">
                成效指標
            </td>
            <td>
                <?=h($eventfinalreport['Eventfinalreport']['performanceindicators'])?>
            </td>
        </tr>
        <tr>
            <td style="width:20%">
                目標達成程度
            </td>
            <td>
                <?=h($eventfinalreport['Eventfinalreport']['goallevel'])?>
            </td>
        </tr>
        <tr>
            <td style="width:20%">
                備註
            </td>
            <td>
                <?=h($eventfinalreport['Eventfinalreport']['performanceremarks'])?>
            </td>
        </tr>
    </table>
</div>
<!--                        panel-->
<div class="panel-heading">
    <span class="panel-title"><?=__('其他')?><small></small></span>
</div>
<div class="panel-body">
    <table class="table table-striped">
        <tr>
            <td style="width:20%"><?=__("評估工具使用情況及評估結果")?></td>
            <td><?php echo h($eventfinalreport['Eventfinalreport']['appraiseresult']); ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="width:20%"><?=__("整體是否成功")?></td>
            <td><?php echo __("symboltick_".$eventfinalreport['Eventfinalreport']['issuccess']); ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="width:20%"><?=__("跟進")?></td>
            <td><?php echo h($eventfinalreport['Eventfinalreport']['following']); ?>&nbsp;</td>
        </tr>
        <tr>
            <td style="width:20%"><?=__("建議")?></td>
            <td><?php echo h($eventfinalreport['Eventfinalreport']['advice']); ?>&nbsp;</td>
        </tr>
    </table>
</div>
</div>
</div>
<div role="tabpanel" class="tab-pane fade" id="tab_4">

    <div class="panel">
        <div class="panel-heading" >
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-example" href="#collapseOne">
                <h3><?=__('財政報告')?></h3>
            </a>
        </div> <!-- / .panel-heading -->
        <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
            <div class="panel-body" id="financial_balance">

            </div> <!-- / .panel-body -->
        </div> <!-- / .collapse -->
    </div>

</div>
<div role="tabpanel" class="tab-pane fade" id="tab_2">
    <div class="panel panel-success widget-support-tickets" ">
        <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-fa-folder-o"></i><?=__("eventproposals_viewdetail_txt_8")?></span>
            <div class="panel-heading-controls">
                <div class="panel-heading-text">
                    <?php echo $this->Html->link('<span class="fa fa-upload"></span>', array('controller'=>"Attachments", 'action' => 'uploadatt', 'Eventfinalreport', $eventfinalreport['Eventfinalreport']['id'], utf8_encode("活動報告書 - ".$eventfinalreport['Eventproposal']['name']), 'redirect'=>urlencode($this->Html->url(null, true))), array('class'=>'', 'escape'=>false)); ?>

                </div>
            </div>
        </div> <!-- / .panel-heading -->
        <div class="panel-body tab-content-padding widget-comments">
            <!-- Panel padding, without vertical padding -->
            <?if(!empty($eventfinalreport['Attachment'])){
                ?>
                <div class="panel-padding no-padding-vr">
                    <?
                    foreach($eventfinalreport['Attachment'] as $att){
                        ?>
                        <div class="comment">
                            <div class="comment-body" style="margin-left: 0">
                                <div class="comment-by">
                                    <a href="#" title=""><?=h($att['name'])?></a> <?=__('Uploaded by')?> <a href="#" title=""><?=h($att['User']['name'])?></a>
                                </div>
                                <div class="comment-text">
                                    <?=h($att['des'])?>
                                </div>
                                <div class="comment-actions">
                                    <?=$this->Html->link('<span class="text-success"><i class="fa fa-download"></i> Download</span>', array("controller"=>"Attachments", "action"=>"download", $att['id']), array("class"=>"", "escape"=>false));?>
                                    <?= $this->Form->postLink('<span class="text-danger"><i class="fa fa-times"></i>  Remove</span>', array("controller"=>"Attachments", "action"=>"delete", $att['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array("class" => "", 'escape' => false), __('你確定要刪除附件 （ %s ）？', h($att['name'])));?>
                                    <span class="pull-right"><?=h($att['created'])?></span>
                                </div>
                            </div> <!-- / .comment-body -->
                        </div>
                    <?
                    }
                    ?>
                </div>
            <?
            }
            ?>
        </div> <!-- / .panel-body -->
    </div>
</div>
<div role="tabpanel" class="tab-pane fade" id="tab_3">
    <div class="panel widget-article-comments panel-warning panel-slimscroll" id="dashboard-recent">
        <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i><?=__("eventproposals_viewdetail_tab_txt_3")?></span>

        </div> <!-- / .panel-heading -->
        <div class="panel-body tab-content-padding">
            <!-- Panel padding, without vertical padding -->
            <?if(!empty($eventfinalreport['Approvalrecord'])){?>
                <div class="panel-padding no-padding-vr">
                    <?
                    foreach($eventfinalreport['Approvalrecord'] as $rd){
                        $stsclass = $rd['Approvalrecordstatus']['labelclass'];
                        ?>
                        <div class="comment">
                            <a href="#" title=""><?=$rd['User']['name']?></a> <?=__('轉')?> <?=__('狀態為')?> <span class="label <?=$stsclass?>"><?=h($rd['Approvalrecordstatus']['name'])?></span>
                            <?if(!empty($rd['comment'])){?>
                                <div class="comment-body">
                                    <div class="comment-text">
                                        <?=h($rd['comment'])?>
                                    </div>
                                </div> <!-- / .comment-body -->
                            <?}?>
                            <div class="comment-footer">
                                <span class="pull-right"><?=$rd['created']?></span>
                            </div>
                        </div> <!-- / .comment -->
                    <?
                    }
                    ?>
                </div>
            <?
            }
            ?>
        </div> <!-- / .panel-body -->
    </div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    function show_financial_detail(){

        var budget_exist = '<?=$eventfinalreport["Financialbudget"]["id"]?>';
        var balance_exist = '<?=$eventfinalreport["Financialbalance"]["id"]?>';

<!--        if(budget_exist){-->
<!--            $('#financial_budget').load('--><?//echo $this->Html->url(array("controller"=>"Financialbudgets", "action"=>"viewsimplify", $eventproposal["Eventproposal"]["id"], "Eventproposal", "redirect"=>urlencode($this->Html->url(null, true))), array("escape"=>false));?><!--');-->
<!--        }else{-->
<!--            $('#financial_budget').append('--><?//echo $this->Html->link("新增財政預算", array("controller"=>"Financialbudgets", "action"=>"add", $eventproposal["Eventproposal"]["id"], "Eventproposal", "redirect"=>urlencode($this->Html->url(null, true))), array("class"=>"btn btn-block btn-primary"));?><!--');-->
<!--        }-->

        if(balance_exist){
            $('#financial_balance').load('<?echo $this->Html->url(array("controller"=>"Financialbalances", "action"=>"viewsimplify", $eventfinalreport["Eventfinalreport"]["id"], "Eventfinalreport", "redirect"=>urlencode($this->Html->url(null, true))), array("escape"=>false));?>');
        }else{
            $('#financial_balance').append('<?echo $this->Html->link(__('新增財政報告'), array("controller"=>"Financialbalances", "action"=>"add", $eventfinalreport["Eventfinalreport"]["id"], "Eventfinalreport", "redirect"=>urlencode($this->Html->url(null, true))), array("class"=>"btn btn-block btn-primary"));?>');
        }
    }

    $(document).ready(function () {


        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        show_financial_detail();

        $('.panel-slimscroll .panel-body > div').slimScroll({ height: 300, alwaysVisible: true, color: '#888',allowPageScroll: true });
    });
</script>