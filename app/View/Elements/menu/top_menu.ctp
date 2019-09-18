<? if($auth){
    ?>
    <nav class="navbar px-navbar">
        <!-- Header -->
        <div class="navbar-header">
            <a href="<? echo $this->Html->url(array('controller'=>'users', 'action'=>'dashboard'), true)?>" class="navbar-brand">
                <?=__(Configure::read('sitename'))?>
            </a>
        </div>
        <!-- Navbar toggle -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-navs-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>
        <!-- Collapse -->
        <div class="navbar-collapse collapse" id="px-navbar-navs-collapse" aria-expanded="false">
            <ul class="nav navbar-nav">
                <li>
                    <?=$this->Html->link(__("常用文件"), array("controller"=>"documents", "action"=>"index"))?>
                </li>
                <li>
                    <?=$this->Html->link(__("收款"), array("controller"=>"payments", "action"=>"newpayment"), array("target"=>"_BLANK"))?>
                </li>
                <li>
                    <?=$this->Html->link(__("服務對象"), array("controller"=>"members", "action"=>"index"))?>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- NOTIFICATIONS -->
                <li class="dropdown">
                    <a href="<?=$this->Html->url(array('controller'=>"Notifications", 'action'=>'index'))?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="px-navbar-icon fa fa-bullhorn font-size-14"></i>
                        <span class="px-navbar-icon-label">通知</span>
                        <span class="px-navbar-label label label-success" id="unreadnoticenumber"><?=sizeof($_notices)?></span>
                    </a>
                    <div class="dropdown-menu p-a-0" style="width: 300px">
                        <div class="navbar-notifications" id="notifications-list" data-updatetime="<?=time()?>" style="height: 280px; position: relative;">
                            <?
                            if(!empty($_notices)){
                                $count = 0;
                                foreach($_notices as $notice){
                                    if($count > 5){
                                        break;
                                    }
                                    ?>
                                    <div class="widget-notifications-item notifications checklink" data-href="<?=$this->Html->url(array('controller'=>'Notifications', 'action'=>'view', $notice['Notification']['id']), true)?>" onmouseover="JavaScript:this.style.cursor='pointer' ">
                                        <div class="widget-notifications-title text-info"><?=h($notice['Notification']['title'])?></div>
                                        <div class="widget-notifications-date">
                                            <?echo $this->Time->timeAgoInWords($notice['Notification']['created'],  array(
                                                'format' => __('time_format'),
//                                                            'format' => 'F jS, Y',
                                                'accuracy' => array('hour' => 'hour'),
                                                'end' => '2 hour'
                                            ));?>
                                        </div>
                                        <div class="widget-notifications-icon fa fa-hdd-o bg-info"></div>
                                    </div> <!-- / .notification -->
                                    <?
                                    $count++;
                                }
                            }
                            ?>
                        </div> <!-- / .notifications-list -->
                        <?=$this->Html->link(__('更多通知'), array('controller'=>"Notifications", 'action'=>'index'), array('class'=>"widget-more-link"));?>
                    </div> <!-- / .dropdown-menu -->
                </li>
                <!-- NOTIFICATIONS -->

                <!-- MESSAGE -->
                <li class="nav-icon-btn nav-icon-btn-success dropdown hidden">
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
<!--            <ul class="nav navbar-nav navbar-right">-->
<!--                <li>--><?//echo $this->Html->link("我的帳號", array('controller'=>'Users', 'action'=>'myaccount'));?><!--</li>-->
<!--                <li>--><?// echo $this->Html->link("更新密碼", array('controller'=>'Users', 'action'=>'chpass'));;?><!--</li>-->
<!--                <li>--><?//echo $this->Html->link("登出", array('controller'=>'Users', 'action'=>'logout'));?><!--</li>-->
<!--            </ul>-->
    </nav>
    <?
} else {
    ?>

<?}?>
