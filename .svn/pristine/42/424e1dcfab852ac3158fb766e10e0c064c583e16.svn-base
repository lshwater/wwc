<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("參加者報名記錄"), array("controller"=>"activityapplications", "action"=>"histories"))?>
    </li>
    <li class="active">編輯報名資料</li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Activityapplication', array('class'=>'panel form-horizontal validate_form')); ?>

        <div class="panel-heading">
            <span class="panel-title">編輯報名資料</span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="panel-body">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="col-xs-3">
                            <col class="col-xs-5">
                        </colgroup>
                        <thead>
                        <tr>
                            <th><?php echo __('table_content'); ?></th>
                            <th><?php echo __('table_details'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>收據號碼</td>
                            <td><?php echo h($activityapplication['Activityapplication']['payment_code']); ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>費用</td>
                            <td>
                                $<?php echo money_format("%i", $activityapplication['Activityapplication']['totalcost']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>備註</td>
                            <td>
                                <?php echo h($activityapplication['Activityapplication']['remarks']); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php echo $this->Form->input('id'); ?>

            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('Activityapplication.paymentmethod_id', __('付款方式') . "*", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Activityapplication.paymentmethod_id', array('div' => false, 'label' => false, 'class' => 'form-control', "required" => "required", 'placeholder' => __('付款方式'), "empty"=>true, "id"=>"paymentmethod_id")); ?>
                    </div>
                </div>
                <!-- / .form-group -->
            </div>

            <div class="row" style="display:none" id="chequenumberdiv">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('Activityapplication.chequenumber', __('支票號碼'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Activityapplication.chequenumber', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => __('支票號碼'))); ?>
                    </div>
                </div>
                <!-- / .form-group -->
            </div>

            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('Activityapplication.remarks', __('備註'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Activityapplication.remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </div> <!-- / .form-group -->
            </div>


        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    function swap(){
        if($("#paymentmethod_id").val() == 2){
            $("#chequenumberdiv").show();
        }else{
            $("#chequenumberdiv").hide();
        }
    }

    $( document ).ready(function() {
        validate_form();
        swap();

        $(".validate_form").on('change', '#paymentmethod_id', function(){
            swap();
        });
        //phonemask($(".phonemask"));
    });

</script>

