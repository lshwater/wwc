<?php $this->Html->script('print/jQuery.print', array("inline"=>false)); ?>
<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("eventproposals_viewdetail_txt_1").h($eventproposal['Eventproposal']['name']), array("action"=>"view", $eventproposal['Eventproposal']['id']))?>
        </li>
    <li class="active"><?=__("eventproposals_viewdetail_txt_2")?></li>
</ul>
<div class="panel colourable">
    <div class="panel-heading">
        &nbsp;
        <?
        $stsclass = $eventproposal['Approvalrecordstatus']['labelclass'];
        ?>

        <span class="panel-title"> <span class="label <?=$stsclass?>"><?=h($eventproposal['Approvalrecordstatus']['name'])?></span></span>

        <div class="panel-heading-controls">
            <?
            //審評
            if($issupervisor && $eventproposal['Approvalrecordstatus']['needalert'] == 1)
            {
                echo $this->Html->Link('<i class="fa fa-reply"></i> '.__('批閱'), array("controller"=>"eventproposals","action"=>'doapproval', $eventproposal['Eventproposal']['id'],'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array("class" => "btn btn-warning btn-xs", 'escape' => false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
            }?>
            <?
            if($eventproposal['Eventproposal']['user_id'] == $auth['id'] || $issupervisor){
                echo $this->Html->link("<i class='fa fa-pencil'></i> ".__('修改內容'), array("action"=>'edit', $eventproposal['Eventproposal']['id']), array("class" => "btn btn-xs btn-info", 'escape' => false));
            }
            ?>
            <?echo $this->Html->link("<i class='fa fa-print'></i> ", "javascript:void(0);", array("class" => "btn btn-xs", 'escape' => false, "onclick"=>"printpage()"));?>

        </div> <!-- / .panel-heading-controls -->
    </div>
    <div class="panel-body">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#baseinfo" aria-controls="home" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_1")?></a></li>
                <li role="presentation"><a href="#tab_2" aria-controls="profile" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_2")?></a></li>
                <li role="presentation"><a href="#tab_4" aria-controls="messages" role="tab" data-toggle="tab"><?=__("財政紀錄")?></a></li>
                <li role="presentation"><a href="#tab_3" aria-controls="messages" role="tab" data-toggle="tab"><?=__("eventproposals_viewdetail_tab_txt_3")?></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="baseinfo">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"><?=__('基本資料')?></span>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td style="width:20%"><?=__("計劃類別")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['proposaltype']); ?>&nbsp;</td>

                                    <td style="width:20%"><?=__("年度")?></td>
                                    <td><?php echo h($eventproposal['Year']['name']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("編號")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['event_code']); ?>&nbsp;</td>

                                    <td style="width:20%"><?=__("活動名稱")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['name']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:20%"><?=__("性質")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['nature']); ?>&nbsp;</td>

                                    <td><?=__("預計名額")?></td>
                                    <td><?php echo h($eventproposal['Eventproposaltarget']['quota']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("日期")?></td>
                                    <td><?php echo h($eventproposal['Eventproposaltarget']['date']); ?>&nbsp;</td>
                                    <td><?=__("時間")?></td>
                                    <td><?php echo h($eventproposal['Eventproposaltarget']['time']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("地點")?></td>
                                    <td><?php echo h($eventproposal['Eventproposaltarget']['location']); ?>&nbsp;</td>
                                    <td><?=__("節數")?></td>
                                    <td><?php echo h($eventproposal['Eventproposaltarget']['numberofsession']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("小組對象")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['target']); ?>&nbsp;</td>
                                    <td><?=__("收費")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['fee']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("義工人數")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['volunteerneed']); ?>&nbsp;</td>
                                    <td><?=__("其他人員人數")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['helperneed']); ?>&nbsp;</td>
                                </tr>
                            </table>
                        </div>

                        <div class="proposalbox panel-body">
                            <?php echo $eventproposal['Eventproposal']['proposal_content']; ?>&nbsp;
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <td><?=__("小組理念")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['structure']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("小組目的")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['aim']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><?=__("小組目標")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['objective']); ?>&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
<!--                        panel-->
                        <div class="panel-heading">
                            <span class="panel-title"><?=__('其他')?></span>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <td style="width:20%"><?=__("應變方法")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['contingency']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:20%"><?=__("評估方法")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['evaluation']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:20%"><?=__("成效指標")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['quota']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:20%"><?=__("備註")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['remarks']); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:20%"><?=__("督導意見")?></td>
                                    <td><?php echo h($eventproposal['Eventproposal']['senior_advice']); ?>&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_4">

                    <div class="panel">
                        <div class="panel-heading" >
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-example" href="#collapseOne">
                                <h3><?=__('財政預算')?></h3>
                            </a>
                        </div> <!-- / .panel-heading -->
                        <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body" id="financial_budget">

                            </div> <!-- / .panel-body -->
                        </div> <!-- / .collapse -->
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_2">
                    <div class="panel panel-success panel-slimscroll" >
                        <div class="panel-heading">
                            <span class="panel-title"><i class="panel-title-icon fa fa-folder-o"></i><?=__("eventproposals_viewdetail_txt_8")?></span>
                            <div class="panel-heading-controls">
                                <div class="panel-heading-text">
                                    <?php echo $this->Html->link('<span class="fa fa-upload"></span> ', array('controller'=>"Attachments", 'action' => 'uploadatt', 'Eventproposal', $eventproposal['Eventproposal']['id'], utf8_encode(__("eventproposals_viewdetail_txt_2")." - ".h($eventproposal['Eventproposal']['name'])),'redirect'=>urlencode($this->Html->url(null, true))), array('class'=>'', 'escape'=>false)); ?>
                                </div>
                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body tab-content-padding widget-comments">
                            <!-- Panel padding, without vertical padding -->
                            <?if(!empty($eventproposal['Attachment'])){
                                ?>
                                <div class="panel-padding no-padding-vr">
                                    <?
                                    foreach($eventproposal['Attachment'] as $att){
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
                    <div class="panel panel-warning" id="dashboard-recent">
                        <div class="panel-heading">
                            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i><?=__("eventproposals_viewdetail_tab_txt_3")?></span>

                        </div> <!-- / .panel-heading -->
                        <div class="ps-block">
                            <!-- Panel padding, without vertical padding -->
                            <?if(!empty($eventproposal['Approvalrecord'])){
                                foreach($eventproposal['Approvalrecord'] as $rd){
                                    $stsclass = $rd['Approvalrecordstatus']['labelclass'];
                                        ?>
                                        <div class="widget-support-tickets-item">
                                            <a href="#" class="widget-support-tickets-title" title=""><?=$rd['User']['name']?> <?=__('轉')?> <?=__('狀態為')?> </a>
                                            <span class="label <?=$stsclass?>"><?=h($rd['Approvalrecordstatus']['name'])?></span>
                                            <span class="widget-support-tickets-info">
                                            <?if(!empty($rd['comment'])){?>
                                                <div class="comment-text">
                                                    <?=h($rd['comment'])?>
                                                </div>
                                            <?}?>
                                                <?echo $this->Time->timeAgoInWords($rd['created'],  array(
                                                    'format' => __('time_format'),
                                                    'accuracy' => array('minute' => 'minute'),
                                                    'end' => '1 day'
                                                ));?>
                                            </span>
                                        </div> <!-- / .comment -->
                                    <?
                                }
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

        var budget_exist = '<?=$eventproposal["Financialbudget"]["id"]?>';
        var balance_exist = '<?=$eventproposal["Financialbalance"]["id"]?>';

        if(budget_exist){
            $('#financial_budget').load('<?echo $this->Html->url(array("controller"=>"Financialbudgets", "action"=>"viewsimplify", $eventproposal["Eventproposal"]["id"], "Eventproposal", "redirect"=>urlencode($this->Html->url(null, true))), array("escape"=>false));?>');
        }else{
            $('#financial_budget').append('<?echo $this->Html->link(__("新增財政預算"), array("controller"=>"Financialbudgets", "action"=>"add", $eventproposal["Eventproposal"]["id"], "Eventproposal", "redirect"=>urlencode($this->Html->url(null, true))), array("class"=>"btn btn-block btn-primary"));?>');
        }
    }

    function printpage(){
        $("#baseinfo").print();
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
        $('[data-toggle="tooltip"]').tooltip();
        // $('#dashboard-recent .panel-body > div').slimScroll({ height: 300, alwaysVisible: true, color: '#888',allowPageScroll: true });

        // $('.panel-slimscroll .panel-body > div').slimScroll({ height: 300, alwaysVisible: true, color: '#888',allowPageScroll: true });
    });
</script>