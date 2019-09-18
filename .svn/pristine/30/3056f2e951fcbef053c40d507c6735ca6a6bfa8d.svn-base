<?
echo $this->Html->css('ladda-themeless.min', array('inline' => false));
echo $this->Html->script('spin.min', array("inline"=>false));
echo $this->Html->script('ladda.min', array("inline"=>false));
?>
<?php echo $this->element('email_menu'); ?>

<div class="mail-container">
    <div class="mail-container-header">
        <?if(isset($pagetitle)){
            echo $pagetitle;
        }else{?>
            <i class="fa fa-envelope-o"></i> <?=__('收件匣')?>
        <?}?>

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
                <button type="button" class="btn" id="trashbtn"><i class="fa fa-trash-o"></i></button>
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
//            '{:start} - {:end} of {:count} total'
            __('counter')
            );?>
        </div>
    </div>
    <?
    echo $this->Form->create('Message', array("id"=>"messageform", "action"=>"toggletrash", "class"=>"validate_form preventDoubleSubmission"));
    echo $this->Form->hidden("redirect", array("value"=>urlencode($this->Html->url(null, true))));
    if(!empty($messages)){
        ?>
        <ul class="mail-list">
            <?
            foreach($messages as $message){
                if($message['Recipient']['read'])
                {
                    $unread = "";
                }else{
                    $unread = "unread";
                }

                if($message['Recipient']['starred'])
                {
                    $starred = "starred";
                }else{
                    $starred = "";
                }


                ?>
                <li class="mail-item <?=$unread?> <?=$starred?> message" data-msgid="<?=$message['Message']['id']?>">
                    <div class="m-chck">
                        <label class="px-single"><input type="checkbox" name="messageid[]" value="<?=h($message['Message']['id'])?>" class="px"><span class="lbl"></span></label>
                    </div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from">
                        <a href="#" title="" class="from">&nbsp;<?=$message['Message']['from_name']?></a>
                    </div>
                    <div class="m-subject">
                        <?php echo $this->Html->link(h($message['Message']['title']), array('action' => 'view', $message['Message']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"msglink")); ?>
                    </div>
                    <div class="m-date">

                        <?
                        echo __d('cake',$this->Time->timeAgoInWords($message['Message']['created'],  array(
                            'format' => __('time_format'),
//                            'format' => 'F jS, Y',
                            'accuracy' => array('hour' => 'hour'),
                            'end' => '2 hour'
                        )));?>
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

        <?if(isset($active_page_id)){?>
            $("#<?=$active_page_id?>").addClass("active");
        <?}else{?>
            $("#email_menu_inbox").addClass("active");
        <?}?>


        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $('body').on('click', '.m-star', function () {
            $(this).parents('.mail-item').toggleClass('starred');
            var obj = $(this);
            var msgid = obj.closest(".message").attr('data-msgid');

            $.ajax({
                type: "POST",
                url: '<?=$this->Html->url(array('controller'=>'messages', 'action'=>'ajax_togglestarred'))?>/'+msgid,
                dataType: 'json'
            })
            .done(function(data) {

            });
            return false;
        });

        $("#select_all").on("click", function(){
            $("input:checkbox").prop('checked', 1);
        });

        $("#unselect_all").on("click", function(){
            $("input:checkbox").prop('checked', 0);
        });

        $("#trashbtn").on("click", function(){
            $("#messageform").submit();
        });
    });

</script>