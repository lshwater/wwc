<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>HiCRM</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="refresh" content="3600;url=<?=$this->Html->url(array("controller"=>"users", "action"=>"login"), true)?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <?php echo $this->fetch('meta'); ?>
    <?php echo $this->Html->meta('icon'); ?>
    <?php
        echo $this->Html->css('bootstrap.min');
//        echo $this->Html->css('bootstrap-table-filter');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('pixeladmin.min');
        echo $this->Html->css('themes/default.min');
//        switch ($auth['agency_id']) {
//            case 1:
//                echo $this->Html->css('themes/dust.min');
//            break;
//            case 2:
//                echo $this->Html->css('themes/adminflare.min');
//            break;
//            case 3:
//                echo $this->Html->css('themes/fresh.min');
//            break;
//            default:
//                echo $this->Html->css('themes/clean.min');
//        }

        echo $this->Html->css('widgets.min');
        echo $this->Html->css('hypoidea?v11');
        echo $this->Html->css('local');
        echo $this->fetch('css');

?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?

//        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
//        echo $this->Html->script('bootstrap-table-filter');
        echo $this->Html->script('pixeladmin.min');
        echo $this->Html->script('pace.min');

//        echo $this->Html->script('jquery.dataTables.min');
//        echo $this->Html->script('dataTables.bootstrap.min');
//        echo $this->Html->script('dataTables.responsive.min');
//        echo $this->Html->script('datepicker/bootstrap-datepicker.min');
        echo $this->Html->script('hypothesis.js');
        echo $this->fetch('script');
	?>
</head>
<style>
    .daterangepicker{z-index:9999 !important}

    /*body {*/
    /*font-size: 15px !important;*/
    /*}*/

    .no-search .select2-search {
        display:none
    }

    /*.table {*/
    /*font-size: 15px;*/
    /*}*/

    /*.btn {*/
    /*font-size: 15px;*/
    /*}*/

    div.dataTables_filter {
        text-align: right;
    }

    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 3051;
    }
</style>
<body>
    <?php echo $this->element('menu/main_menu'); ?>
    <?php echo $this->element('menu/top_menu'); ?>
    <div class="px-content">
<!--        --><?//= $this->Html->image('sjslogo.png', array('alt' => 'logo', 'class'=>'m-b-1', 'width'=>"300px"));?>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div> <!-- / #content-wrapper -->

    <footer class="px-footer px-footer-bottom p-t-1">
        <div class="row">
            <div class="col-xs-8">
                  <span class="text-muted">Copyright © 2018 Hypothesis & Idea Business Solution Ltd. All rights reserved.</span>
            </div>
            <div class="col-xs-4 text-right">
                <span class="text-right"><span id="timer"></span>後自動登出</span>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        var countDownDate = new Date().getTime()+120*60*1000;
        var popup_countdown = false;

        $(document).ready(function () {
            $('body > .px-nav').pxNav();
            $('body > .px-footer').pxFooter();
            // $('.px-nav').pxNav('activateItem', '#some-nav-item');
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var hr = Math.floor(distance / 3600000);
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) + hr*60;
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("timer").innerHTML = minutes + "分" + seconds + "秒";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "自動登出";
                }else if(distance < 1000*60*10 && !popup_countdown){
                    popup_countdown = true;
                    bootbox.alert({
                        message:   '你將於10分鐘自動登出，請重新整理網頁。(請緊記存儲未存儲的資料)',
                        className: 'bootbox-sm',

                        callback: function() {
                        },
                    });
                }
            }, 1000);
        });

    </script>



    </body>
</html>
