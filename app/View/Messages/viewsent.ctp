<?php echo $this->element('email_menu'); ?>

<div class="mail-container">
    <div class="mail-container-header show starred">
        <?=h($message['Message']['title'])?>&nbsp;
    </div>

    <div class="mail-controls clearfix">
        <div class="btn-toolbar wide-btns pull-left" role="toolbar">

            <div class="btn-group">
                <?
                if(!empty($redirecturl)){
                    echo $this->Html->link('<i class="fa fa-chevron-left"></i>', $redirecturl, array('escape'=>false, "class"=>"btn"));
                }else{
                    echo $this->Html->link('<i class="fa fa-chevron-left"></i>', array("action"=>"sent"), array('escape'=>false, "class"=>"btn"));
                }
                ?>

            </div>

            <div class="btn-group">
                <?php echo $this->Form->postLink('刪除', array("action"=>"delete_sentmail", $message['Message']['id'], "redirect"=>urlencode($redirecturl)), array('escape'=>false, "class"=>"btn"), __('請確認刪除 ')); ?>
            </div>

        </div>

        <div class="btn-toolbar pull-right" role="toolbar">
            <div class="btn-group">
                <?=$this->Html->link('<i class="fa fa-share"></i>', array("controller"=>"messages",'action'=>"sendmsg", "replyid"=>$message['Message']['id'], "forward"=>true), array('escape' => false, 'class'=>"openasnew btn"));?>
            </div>
        </div>
    </div>

    <div class="mail-info">
        <?
        echo $this->Html->image("dummy-avatar.png", array("class"=>"avatar"));
        ?>
        <div class="from">
            <div class="name">To:
                <?
                $comma = "";
                $tohtml = "";
                foreach($message['Recipient'] as $rec){
                    $tohtml .= $comma.h($rec['User']['name']);
                    $comma = ", ";
                }
                echo $tohtml;
                ?>
            </div>
        </div>

        <div class="date">
            <?echo $this->Time->timeAgoInWords($message['Message']['created'],  array(
                'format' => 'F jS, Y',
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
//        $("body").addClass("page-mail mmc");
        $("#mail_select_folder").addClass("active");

        $('body').on('click', '.m-details-star', function () {
            $(this).find('> *').toggleClass('fa-star').toggleClass('fa-star-o');
            return false;
        });

    });
</script>