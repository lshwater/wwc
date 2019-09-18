<?php echo $this->element('email_menu'); ?>

<div class="mail-container">
    <div class="mail-container-header show starred">
        <?
        if($message['Recipient'][0]['starred'])
        {
            $starred = "star";
        }else{
            $starred = "star-o";
        }
        ?>
        <a href="#" class="m-details-star"><i class="fa fa-<?=$starred?>"></i></a>
        <?=h($message['Message']['title'])?>&nbsp;
    </div>

    <div class="mail-controls clearfix">
        <div class="btn-toolbar wide-btns pull-left" role="toolbar">

            <div class="btn-group">
                <?
                    if(!empty($redirecturl)){
                        echo $this->Html->link('<i class="fa fa-chevron-left"></i>', $redirecturl, array('escape'=>false, "class"=>"btn"));
                    }else{
                        echo $this->Html->link('<i class="fa fa-chevron-left"></i>', array("action"=>"inbox"), array('escape'=>false, "class"=>"btn"));
                    }
                ?>

            </div>

            <div class="btn-group">
                <?
                if(!$message['Recipient'][0]['trash']){
                    echo $this->Html->link('<i class="fa fa-trash-o"></i>', array("action"=>"toggletrash", $message['Message']['id'], "redirect"=>urlencode($redirecturl)), array('escape'=>false, "class"=>"btn"));
                }else{
                    echo $this->Html->link('還原', array("action"=>"toggletrash", $message['Message']['id'], "redirect"=>urlencode($redirecturl)), array('escape'=>false, "class"=>"btn"));
                    echo $this->Form->postLink('刪除', array("action"=>"unlinkmsg", $message['Message']['id'], "redirect"=>urlencode($redirecturl)), array('escape'=>false, "class"=>"btn"), __('請確認永久刪除?'));
                }
                ?>
            </div>

        </div>

        <div class="btn-toolbar pull-right" role="toolbar">
            <div class="btn-group">
                <?=$this->Html->link('<i class="fa fa-mail-reply"></i>', array("controller"=>"messages",'action'=>"sendmsg", "replyid"=>$message['Message']['id']), array('escape' => false, 'class'=>"openasnew btn"));?>
            </div>
        </div>
    </div>

    <div class="mail-info">
        <?
        echo $this->Html->image("dummy-avatar.png", array("class"=>"avatar"));
        ?>
        <div class="from">
            <div class="name"><?=h($message['Message']['from_name'])?></div>
        </div>

        <div class="date">
            <?echo $this->Time->timeAgoInWords($message['Message']['created'],  array(
            'format' => __('time_format'),
//            'format' => 'F jS, Y',
            'accuracy' => array('hour' => 'hour'),
            'end' => '2 hour'
        ));?></div>
    </div>


    <div class="mail-message-body">
        <?=$message['Message']['msg']?>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('img').addClass('img-responsive');

        $("body").addClass("page-mail mmc main-menu-animated");
        $("#mail_select_folder").addClass("active");

        $('body').on('click', '.m-details-star', function () {
            $(this).find('> *').toggleClass('fa-star').toggleClass('fa-star-o');

            $.ajax({
                type: "POST",
                url: '<?=$this->Html->url(array('controller'=>'messages', 'action'=>'ajax_togglestarred', $message['Message']['id']))?>',
                dataType: 'json'
            })
                .done(function(data) {

                });
            return false;
        });

    });
</script>