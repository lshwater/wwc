<div class="mail-nav">
    <div class="compose-btn">
        <?=$this->Html->link('<i class="btn-label fa fa-pencil-square-o"></i>'.__("新增訊息"), array("action"=>"sendmsg"), array("class"=>"btn btn-primary btn-labeled btn-block openasnew", "escape"=>false));?>
    </div>
    <div class="navigation">
        <ul class="sections">
            <li class="mail-select-folder" id="mail_select_folder"><a href="#">Select folder...</a></li>
            <li id="email_menu_inbox">
                <?
                if(!empty($_messages)){
                    $unreadlb = ' <span class="label pull-right">'.sizeof($_messages).'</span>';
                }else{
                    $unreadlb = "";
                }
                echo $this->Html->link('<i class="m-nav-icon fa fa-inbox"></i>'.__("收件匣").$unreadlb, array("controller"=>"messages", "action"=>"inbox"), array("escape"=>false));
                ?>
            </li>
            <li id="email_menu_starred">
                <?echo $this->Html->link('<i class="m-nav-icon fa fa-star"></i>'.__("已加上標記"), array("controller"=>"messages", "action"=>"viewstarred"), array("escape"=>false));?>
            <li id="email_menu_sent">
                <?echo $this->Html->link('<i class="m-nav-icon fa fa-envelope"></i>'.__("已傳送"), array("controller"=>"messages", "action"=>"sent"), array("escape"=>false));?>
            </li>
            <li id="email_menu_trash">
                <?echo $this->Html->link('<i class="m-nav-icon fa fa-trash-o"></i>'.__("垃圾桶"), array("controller"=>"messages", "action"=>"trash"), array("escape"=>false));?>
            </li>
        </ul>

    </div>
</div>

<script>
    init.push(function () {
        // Open nav on mobile
        $('.mail-nav .navigation li.active a').click(function () {
            $('.mail-nav .navigation').toggleClass('open');
            return false;
        });
        $('body').addClass('page-mail mmc');
    });
</script>