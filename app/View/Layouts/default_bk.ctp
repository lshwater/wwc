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
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>NEC Smart System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <?php echo $this->fetch('meta'); ?>
    <?php echo $this->Html->meta('icon'); ?>
    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-table-filter');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('pixel-admin');
        echo $this->Html->css('widgets.min');
        echo $this->Html->css('rtl.min');
        echo $this->Html->css('themes.min');
        echo $this->Html->css('pages.min');
        echo $this->Html->css('select2');
        echo $this->Html->css('select2-bootstrap');
        echo $this->Html->css('dataTables.bootstrap.min');
        echo $this->Html->css('datepicker/bootstrap-datepicker3.min');
        echo $this->Html->css('responsive.dataTables.min');
        echo $this->Html->css('local');
        echo $this->fetch('css');

        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('bootstrap-table-filter');
        echo $this->Html->script('pixel-admin');
        echo $this->Html->script('select2.min');
        echo $this->Html->script('jquery.dataTables.min');
        echo $this->Html->script('dataTables.bootstrap.min');
        echo $this->Html->script('dataTables.responsive.min');
        echo $this->Html->script('datepicker/bootstrap-datepicker.min');
        echo $this->Html->script('hypothesis');
        echo $this->fetch('script');
	?>

	<!--[if lt IE 9]>
		<?php echo $this->Html->script('ie.min'); ?>
	<![endif]-->

</head>
<body class="theme-default main-menu-fixed main-navbar-fixed">
<script>var init = [];</script>
<div id="main-wrapper">
    <?php echo $this->element('menu/top_menu'); ?>
    <?php echo $this->element('menu/main_menu'); ?>
    <div id="content-wrapper">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->


<?php //echo $this->element('sql_dump'); ?>
<script type="text/javascript">
    window.PixelAdmin.start(init);

    //CutoffDate
    $(document).ready(function () {

    });
</script>
</body>
</html>
