<?
//Configure::write('debug', 2);

//debug($messages);
?>
<div class="page-header">
    <h1 class="doc-header"><i class="fa fa-newspaper-o page-header-icon"></i>&nbsp;&nbsp;<?=__('最新資訊')?></h1>
</div>

<!-- / Javascript -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-rss"></i><?=__('最新站內公佈')?></span>
            </div>

            <div class="ps-block">

                    <?
                    if(!empty($announcements)){
                        foreach($announcements as $announcement){
                                if($announcement['needconfirm'] && empty($announcement['AnnouncementUser'])){
                                    $needconfirmlb = '<span href="#" class="label ticket-label label-warning">未確認</span>';
                                }else{
                                    $needconfirmlb = "";
                                }
                            ?>
                            <div class="widget-support-tickets-item">
                                <?=$needconfirmlb?>
                                <?php echo $this->Html->link(h($announcement['title']), array('controller'=>'Announcements', 'action'=>'view', $announcement['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"widget-support-tickets-title")); ?>
                                <span class="widget-support-tickets-info">
                                    <?=__('由')?> <i><?=h($announcement['Fromuser']['name'])?></i> <?=__('發佈')?>
                                    &nbsp;
                                    <?echo $this->Time->timeAgoInWords($announcement['created'],  array(
                                        'format' => __('time_format'),
//                                        'format' => 'F jS, Y',
                                        'accuracy' => array('minute' => 'minute'),
                                        'end' => '1 day'
                                    ));?>
                                </span>
                            </div> <!-- / .ticket -->


                        <?
                        }
                    }
                    ?>
            </div> <!-- / .panel-body -->
            <div class="panel-footer tab-content-padding">
                <div class="text-center">
                    <?php echo $this->Html->link(__('更多'), array('controller'=>'Announcements', 'action' => 'index')); ?>
                </div>
            </div>
        </div> <!-- / .panel -->
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success ">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i><?=__('最新通知')?></span>
                <?
                if($unread_notifications){
                ?>
                    <div class="panel-heading-controls">
                        <div class="panel-heading-text"><?php echo $this->Html->link($unread_notifications.__('個').__('新通知'), array('controller'=>'Notifications', 'action' => 'index')); ?></div>
                    </div>
                <?
                }
                ?>

            </div> <!-- / .panel-heading -->
            <div class="ps-block">
                    <?
                    if(!empty($notifications)){
                        foreach($notifications as $notice){
    //                        debug($note);
                            ?>
                            <div class="widget-support-tickets-item">
                                <?
                                if($notice['Recipient']['read']){
                                    ?><span class="label pull-right"><?=__('已讀')?></span><?
                                }else{
                                    ?><span class="label label-warning pull-right"><?=__('未讀')?></span><?
                                }
                                ?>
                                <?php echo $this->Html->link(h($notice['Notification']['title']), array('controller'=>'Notifications', 'action'=>'view', $notice['Notification']['id'], 'ajax'=>true, 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"widget-support-tickets-title", 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static")); ?>
                                <span class="widget-support-tickets-info">
                                    <?=__('由')?> <i><?=h($notice['Notification']['from_name'])?></i> <?=__('發出')?>
                                    &nbsp;
                                    <?echo $this->Time->timeAgoInWords($notice['Notification']['created'],  array(
                                        'format' => __('time_format'),
//                                        'format' => 'F jS, Y',
                                        'accuracy' => array('minute' => 'minute'),
                                        'end' => '1 day'
                                    ));?>
                                </span>
                            </div> <!-- / .ticket -->


                        <?
                        }
                    }
                    ?>
            </div> <!-- / .panel-body -->
            <div class="panel-footer tab-content-padding">
                <div class="text-center">
                    <?php echo $this->Html->link(__('更多'), array('controller'=>'Notifications', 'action' => 'index')); ?>
                </div>
            </div>
        </div> <!-- / .panel -->
    </div>

    <div class="col-md-6 hidden">
        <div class="panel panel-warning ">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-envelope-o"></i><?=__('最新訊息')?></span>
                <?if($unread_messages >0){
                ?>
                    <div class="panel-heading-controls">
                        <div class="panel-heading-text"><?php echo $this->Html->link($unread_messages.__('個').__('未讀訊息'), array('controller'=>'Messages', 'action' => 'inbox')); ?></div>
                    </div>
                <?
                }?>

            </div> <!-- / .panel-heading -->
            <div class="tab-content p-a-0">
                <!-- Panel padding, without vertical padding -->
                <div class="ps-block tab-pane fade in active">
                        <?
                        if(!empty($messages)){
                            foreach($messages as $msg){
                                ?>
                                <div class="widget-messages-alt-item">
                                    <?echo $this->Html->image("dummy-avatar.png", array("class"=>"widget-messages-alt-avatar"));?>

                                    <?if(!$msg['Recipient']['read']){?>
                                        <?php echo $this->Html->link("<strong>".h($msg['Message']['title'])."</strong>", array('controller'=>'Messages', 'action' => 'view', $msg['Message']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"widget-messages-alt-subject text-truncate")); ?>
                                        <!--                                <a href="#" class="message-subject"><strong>--><?//=h($msg['Message']['title'])?><!--</strong></a>-->
                                    <?}else{?>
                                        <?php echo $this->Html->link(h($msg['Message']['title']), array('controller'=>'Messages', 'action' => 'view', $msg['Message']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"widget-messages-alt-subject text-truncate")); ?>
                                        <!--                                <a href="#" class="message-subject">--><?//=h($msg['Message']['title'])?><!--</a>-->
                                    <?}?>

                                    <div class="widget-messages-alt-description">
                                        <?=__('由')?> <i><?=h($msg['Message']['from_name'])?></i> <?=__('發出')?>
                                        &nbsp;
                                        <?echo $this->Time->timeAgoInWords($msg['Message']['created'],  array(
                                            'format' => __('time_format'),
//                                            'format' => 'F jS, Y',
                                            'accuracy' => array('minute' => 'minute'),
                                            'end' => '1 day'
                                        ));?>
                                    </div>
                                </div>

                            <?
                            }
                        }
                        ?>
                    </div>
            </div> <!-- / .panel-body -->
            <div class="panel-footer tab-content-padding">
                <div class="text-center">
                    <?php echo $this->Html->link(__('更多'), array('controller'=>'Messages', 'action' => 'inbox')); ?>
                </div>
            </div>
        </div> <!-- / .panel -->
    </div>
    <div class="col-md-12">
        <p class="text-light-gray text-sm">系統版本： v<?=$systemversion?></p>
    </div>


</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
            location.reload();
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
        $('.panel-slimscroll .panel-body > div').slimScroll({ height: 270, alwaysVisible: true, color: '#888',allowPageScroll: true });

    });

    $(function() {
        $('#support-tickets').perfectScrollbar();
        $('#comments').perfectScrollbar();
        $('#threads').perfectScrollbar();
    });
</script>