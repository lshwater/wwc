<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>
<!--Matching-->

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-address-card page-header-icon"></i>&nbsp;&nbsp;<?=__("修改會藉資料")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>
<ul class="breadcrumb">
    <li>
        <?echo $this->Html->link(__("返回"), "javascript:history.go(-1)");?>
    </li>
    <li class="active"><?=__("修改會藉資料")?></li>
</ul>

<?php echo $this->Form->create('Membership', array('class'=>'panel validate_form preventDoubleSubmission', 'id'=>"form2submit")); ?>
<?php echo $this->Form->input('id'); ?>
<div class="row">
    <div class="col-sm-12">

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('會藉資料'); ?></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('membertype', __('會藉'), 'control-label required'); ?>
                        <p class="form-control-static">
                            <span class="text-success font-size-15"><b><?=$membership['Membertype']['name']?></b></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label("membercard", __('配對會員卡'), 'control-label'); ?>
                        <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control membercard', "readonly"=>"readonly"));?>

                    </div> <!-- / .form-group -->
                </div>

            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label("code", __('會員編號'), 'control-label required'); ?>
                        <?php echo $this->Form->input("code", array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required"));?>

                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-6">
                    <?
                   if($membership['Membership']['valid']){
                        $checkoptions = "checked";
                    }else{
                        $checkoptions = "";
                    }
                    ?>
                    <div class="hidden">
                        <?php echo $this->Form->input('valid', array('label'=>false,'div'=>false, 'type'=>'text', 'id'=>'validinput')); ?>
                    </div>
                    <?php echo $this->Form->label("valid", __('會藉狀態'), 'control-label required'); ?>
                    <label for="switcher-success" class="switcher switcher-success">
                        <input type="checkbox" id="switcher-success" <?=$checkoptions?>>
                        <div class="switcher-indicator">
                            <div class="switcher-yes">生效</div>
                            <div class="switcher-no">無效</div>
                        </div>
                        &nbsp;
                    </label>
                </div>

            </div>

            <div class="row">
                <?if($membership['Membertype']['default_period'] > 0){?>
                    <div class="col-md-6">
                        <?php echo $this->Form->label('', __('會藉有效期'), 'control-label required'); ?>

                        <div class="form-group">
                            <?php echo $this->Form->input('enddate', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>'required', 'id'=>'enddate', 'placeholder'=>"最後日期", 'type'=>"text"));?>

                        </div>
                    </div>
                <?}?>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $this->Form->label('Membership.remarks', __('備註'), 'control-label'); ?>
                        <?php echo $this->Form->input('Membership.remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
                    </div> <!-- / .form-group -->
                </div>
            </div>
        </div>

        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
        </div>

    </div>
</div>
<?php echo $this->Form->end(); ?>

<!-- Success -->
<div id="hkidok" class="modal modal-alert modal-success fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="modal-title">香港身份証認証</div>
            <div class="modal-body">正確</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
<!-- / Success -->

<!-- Danger -->
<div id="hkidfail" class="modal modal-alert modal-danger fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="modal-title">香港身份証認証</div>
            <div class="modal-body">不正確</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
<!-- / Danger -->

<script>

    $(document).ready(function() {

        $('.membercard').scannerdevice()

        $("#switcher-success").change(function(){
            var checked = $("#switcher-success").is(':checked');
            if(checked){
                $("#validinput").val(1);
            }else{
                $("#validinput").val(0);
            }
        });
    });

</script>