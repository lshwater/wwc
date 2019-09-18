<div class="panel">
    <div class="panel-heading">
        <h2>
            <span class="fa fa-print"></span>&nbsp;報名記錄
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Activityapplication', array('class' => 'form-horizontal validate_form', 'action'=>"export_histories_excel")); ?>
        <div class="col-sm-12">
            <div class="form-group no-margin-hr">
                <?php echo $this->Form->label('startdate', __('報名日期'), 'control-label'); ?>
                <div class="input-daterange input-group bs-datepicker-range">
                    <?php echo $this->Form->input('startdate', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm datecount', 'placeholder'=>'開始日期', 'required'=>"required")); ?>
                    <span class="input-group-addon">to</span>
                    <?php echo $this->Form->input('enddate', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm datecount', 'placeholder'=>'結束日期', 'required'=>"required")); ?>
                </div>
            </div>

            <div class="form-group no-margin-hr">
            <?php echo $this->Form->label('paymentcodecolor', "收據顏色 ", 'control-label'); ?>
                <?php echo $this->Form->input('paymentcodecolor', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal',"empty"=>true, "default"=>$eventproposal['Eventproposal']['paymentcodecolor'], "options"=>configure::read("PaymentColorCode")));?>

            </div> <!-- / .form-group -->

            <div class="form-group no-margin-hr">
                <?php echo $this->Form->label('user_id', __('經手人'), 'control-label'); ?>
                <?php echo $this->Form->input('user_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal', "options"=>$users, 'placeholder'=>__('經手人'), "empty"=>true));?>
            </div>
            <button class="btn btn-block btn-success"><span class="fa fa-check"></span>&nbsp;&nbsp;確定</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

</div>

<script>
    $( document ).ready(function() {
        var options = {
            orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: "linked"
            <?
            if(!empty($_cutoffdate)){
            ?>
            ,startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
            <?
            }
            ?>
        }
        $('.bs-datepicker-range').datepicker(options);

        validate_form();
       $(".select2_modal").select2({
           allowClear: true
       });
    });

</script>

