<? if($auth){?>
    <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
        <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
        <div class="navbar-inner">
            <div class="navbar-header">
                <!-- Logo -->
                <a href="<? echo $this->Html->url(array('controller'=>'users', 'action'=>'dashboard'), true)?>" class="navbar-brand">
                    <div><? echo $this->Html->image('logo.png', array('alt' => 'Admin Page')); ?></div>
                    <?=__(Configure::read('sitename'))?>
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
            </div>

            <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
                <div>
                    <ul class="nav navbar-nav">
                        <li>
                            <?=$this->Html->link(__("常用文件"), array("controller"=>"documents", "action"=>"index"))?>
                        </li>
                        <li>
                            <?=$this->Html->link(__("收款"), array("controller"=>"members", "action"=>"payment"))?>
                        </li>
                        <li>
                            <?=$this->Html->link(__("服務義象搜尋"), array("controller"=>"members", "action"=>"matching"), array( "class"=>"openasnew"))?>
                        </li>
                        <li>
                            <a href="https://sjs.hypoidea.com/stockrequests" target="_blank">FBIS</a>
                        </li>
                        <li>
                            <a href="http://test.caritas.hypoidea.com" target="_blank">外展服務</a>
                        </li>
                    </ul>
                    <div class="right clearfix">
                        <ul class="nav navbar-nav pull-right right-navbar-nav">
                        <!-- NOTIFICATIONS -->
                                <li class="nav-icon-btn nav-icon-btn-danger dropdown">
                                    <a href="<?=$this->Html->url(array('controller'=>"Notifications", 'action'=>'index'))?>" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="label" id="unreadnoticenumber"><?=sizeof($_notices)?></span>
                                        <i class="nav-icon fa fa-bullhorn"></i>
                                        <span class="small-screen-text">通知</span>
                                    </a>
                                    <div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
                                        <div class="notifications-list" id="notifications-list" data-updatetime="<?=time()?>">
                                            <?
                                            if(!empty($_notices)){
                                                $count = 0;
                                                foreach($_notices as $notice){
                                                    if($count > 5){
                                                        break;
                                                    }
                                            ?>
                                                <div class="notification checklink" data-href="<?=$this->Html->url(array('controller'=>'Notifications', 'action'=>'view', $notice['Notification']['id']), true)?>" onmouseover="JavaScript:this.style.cursor='pointer' ">
                                                    <div class="notification-title text-info"><?=h($notice['Notification']['title'])?></div>
                                                    <div class="notification-ago">
                                                        <?echo $this->Time->timeAgoInWords($notice['Notification']['created'],  array(
                                                            'format' => __('time_format'),
//                                                            'format' => 'F jS, Y',
                                                            'accuracy' => array('hour' => 'hour'),
                                                            'end' => '2 hour'
                                                        ));?>
                                                    </div>
                                                    <div class="notification-icon fa fa-envelope-o bg-info"></div>
                                                </div> <!-- / .notification -->
                                            <?
                                                    $count++;
                                                }
                                            }
                                            ?>
                                        </div> <!-- / .notifications-list -->
                                        <?=$this->Html->link(__('更多通知'), array('controller'=>"Notifications", 'action'=>'index'), array('class'=>"notifications-link"));?>
                                    </div> <!-- / .dropdown-menu -->
                                </li>
                            <!-- NOTIFICATIONS -->

                            <!-- MESSAGE -->
                            <li class="nav-icon-btn nav-icon-btn-success dropdown">
                                <a href="<?=$this->Html->url(array('controller'=>"Messages", 'action'=>'inbox'))?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="label" id="unreadmessagenumber"><?=sizeof($_messages)?></span>
                                    <i class="nav-icon fa fa-envelope"></i>
                                    <span class="small-screen-text">訊息</span>
                                </a>
                                <div class="dropdown-menu widget-messages-alt no-padding" style="width: 300px">
                                    <div class="messages-list" id="messages-list" data-updatetime="<?=time()?>">
                                        <?
                                        if(!empty($_messages)){
                                            $count = 0;
                                            foreach($_messages as $msg){
                                                if($count > 5){
                                                    break;
                                                }
                                                ?>
                                                <div class="message checklink" data-href="<?=$this->Html->url(array('controller'=>'Messages', 'action'=>'view', $msg['Message']['id']), true)?>" onmouseover="JavaScript:this.style.cursor='pointer' ">
                                                    <?
                                                        echo $this->Html->image("dummy-avatar.png", array("class"=>"message-avatar"));
                                                    ?>
                                                    <a href="#" class="message-subject"><?=$msg['Message']['title']?></a>
                                                    <div class="message-description">
                                                        from <a href="#"><?=$msg['Message']['from_name']?></a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        <?echo $this->Time->timeAgoInWords($msg['Message']['created'],  array(
                                                            'format' => __('time_format'),
//                                                            'format' => 'F jS, Y',
                                                            'accuracy' => array('hour' => 'hour'),
                                                            'end' => '2 hour'
                                                        ));?>
                                                    </div>
                                                </div> <!-- / .message -->
                                                <?
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </div> <!-- / .notifications-list -->
                                    <?=$this->Html->link(__('更多訊息'), array('controller'=>"Messages", 'action'=>'inbox'), array('class'=>"messages-link"));?>
                                </div> <!-- / .dropdown-menu -->
                            </li>
                            <!-- MESSAGE -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="dropdown-header">帳號</li>
                                    <li>
                                        <?
                                            echo $this->Html->link("我的帳號", array('controller'=>'Users', 'action'=>'myaccount'));
                                        ?>
                                        <?
                                            echo $this->Html->link("更新密碼", array('controller'=>'Users', 'action'=>'chpass'));
                                        ?>
                                        <?
                                            echo $this->Html->link("登出", array('controller'=>'Users', 'action'=>'logout'));
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <script>
<!---->
        $(document).ready(function() {

            $("#main-navbar-collapse").on("click", ".checklink", function(){
                var href = $(this).attr('data-href');
                window.location.href = href;
            });

            setInterval('ajax_updatenotification()', 10000);
            setInterval('ajax_updatemessage()', 10000);
        });
    </script>
<?
} else {
    ?>

<?}?>