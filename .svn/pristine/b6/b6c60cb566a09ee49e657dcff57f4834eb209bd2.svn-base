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
    echo $this->Html->css('hypoidea?v10');
    echo $this->Html->css('local');
    echo $this->fetch('css');

    ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?

    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('pixeladmin.min');
    echo $this->Html->script('pace.min');
    echo $this->fetch('script');
    ?>

    <STYLE TYPE="text/css">
        P.breakhere {page-break-before: always}
    </STYLE>
</head>
<body>
<!--<script>-->
<!--    window.onload = function () {-->
<!--        window.print();-->
<!--    };-->
<!--</script>-->
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>
</body>
</html>
