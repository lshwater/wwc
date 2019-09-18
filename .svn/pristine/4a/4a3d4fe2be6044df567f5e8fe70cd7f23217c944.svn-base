<?
echo $this->Html->css('ladda-themeless.min', array('inline' => false));
echo $this->Html->script('spin.min', array("inline"=>false));
echo $this->Html->script('ladda.min', array("inline"=>false));
?>
<?php echo $this->element('email_menu'); ?>

<div class="mail-container">
    <div class="mail-container-header">
        <i class="fa fa-envelope"></i> <?=__('已傳送')?>
    </div>

    <div class="mail-controls clearfix">
        <div class="btn-toolbar wide-btns pull-left" role="toolbar">

            <div class="btn-group">
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-check-square-o"></i>&nbsp;<i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="javascript:void(0);" id="select_all"><?=__("全選")?></a></li>
                        <li><a href="javascript:void(0);" id="unselect_all"><?=__("取消全選")?></a></li>
                    </ul>
                </div>
                <?=$this->Html->link('<i class="fa fa-refresh"></i>', $this->here, array("class"=>"btn", "escape"=>false))?>
            </div>
            <div class="btn-group">
                <button type="button" class="btn" id="deletebtn"><?=__('刪除')?></button>
            </div>
        </div>

        <div class="btn-toolbar pull-right" role="toolbar">
            <div class="btn-group">
                <?php echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array("escape"=>false, "class"=>"btn"), null, array('disabled' => 'disabled',"escape"=>false, "class"=>"btn"));?>
                <?php echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array("escape"=>false, "class"=>"btn"), null, array('disabled' => 'disabled',"escape"=>false, "class"=>"btn"));?>
            </div>
        </div>
        <div class="pages pull-right">
            <?echo $this->Paginator->counter(
                __('counter')
            );?>
        </div>
    </div>
    <?
    echo $this->Form->create('Message', array("id"=>"messageform", "action"=>"delete_sentmail", "class"=>"validate_form preventDoubleSubmission"));
    echo $this->Form->hidden("redirect", array("value"=>urlencode($this->Html->url(null, true))));
    if(!empty($messages)){
        ?>
        <ul class="mail-list">
            <?
            foreach($messages as $message){
                ?>
                <li class="mail-item message starred">
                    <div class="m-chck">
                        <label class="px-single"><input type="checkbox" name="messageid[]" value="<?=h($message['Message']['id'])?>" class="px"><span class="lbl"></span></label>
                    </div>
                    <div class="m-star">To:</div>
                    <div class="m-from">
                         <a href="#" title="" class="from">
                            <?
                            $comma = "";
                            $tohtml = "";
                            foreach($message['Recipient'] as $rec){
                                $tohtml .= $comma.h($rec['User']['name']);
                                $comma = ", ";
                            }
                            echo $tohtml;
                            ?>
                        </a>
                    </div>
                    <div class="m-subject">
                        <?php echo $this->Html->link(h($message['Message']['title']), array('action' => 'viewsent', $message['Message']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"msglink")); ?>
                    </div>
                    <div class="m-date">
                        <?echo $this->Time->timeAgoInWords($message['Message']['created'],  array(
                            'format' => __('time_format'),
//                            'format' => 'F jS, Y',
                            'accuracy' => array('hour' => 'hour'),
                            'end' => '2 hour'
                        ));?>
                    </div>
                </li>
            <?
            }
            ?>
        </ul>
    <?
    }
    echo $this->Form->end();
    ?>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    .page-header .pull-right {
        padding-top: 5px;
    }
    .page-header .pull-right > * {
        display: inline-block;
        vertical-align:middle;
    }

    .m-from{
      white-space: nowrap;
    }
</style>

<script>
    $(document).ready(function () {
//        $("body").addClass("page-mail mmc");

        $("#email_menu_sent").addClass("active");

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $("#select_all").on("click", function(){
            $("input:checkbox").prop('checked', 1);
        });

        $("#unselect_all").on("click", function(){
            $("input:checkbox").prop('checked', 0);
        });

        $('#deletebtn').on('click', function () {
            bootbox.confirm({
                message: "<?=__("你確記要永久刪除？")?>",
                callback: function(result) {
                    if(result){
                        $("#messageform").submit();
                    }
                },
                className: "bootbox-sm"
            });
        });

    });

</script>