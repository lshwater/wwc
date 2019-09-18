<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<!--<div class="page-header">-->
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-refresh page-header-icon"></i>&nbsp;&nbsp;<?=__("重新配對智能卡")?>
        </h1>

<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <div class="row">-->
<!--                <hr class="visible-xs no-grid-gutter-h">-->
                <!-- "Create project" button, width=auto on desktops -->
<!--            </div>-->
<!--        </div>-->
    </div>
<!--</div>-->

<div class="panel">
    <?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission') ); ?>
    <div class="panel-body">
        <?php echo $this->Form->input('id'); ?>
        <div class="form-group">
            <?php echo $this->Form->label("membercard", __('配對智能卡'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control membercard', "readonly"=>"readonly"));?>
            </div>
        </div> <!-- / .form-group -->
    </div>

    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
    </div>
    <?php echo $this->Form->end(); ?>

</div>


<script>

    $(document).ready(function() {

        $('.membercard').scannerdevice();
        validate_form();
    });
</script>

