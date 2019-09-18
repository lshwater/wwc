<div class="panel">
    <div class="panel-heading">
        <h2>
            完結<?=h($activity['Activity']['name'])?>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Activity', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('id', array("value"=>$activity['Activity']['id'])); ?>
        <?php echo $this->Form->hidden('closed', array("value"=>1)); ?>
        <div class="form-group">
            <?php echo $this->Form->label('issuccess', "是否成功", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('issuccess', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('closereason_id', "原因", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('closereason_id', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", "id"=>"closereason"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('closedate', __('結束日期'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('closedate', array('div'=>false, "type"=>"text",'label'=>false, 'class'=>'form-control', "id"=>"datepicker", 'required' => 'required'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('closereason', "備註", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('closereason', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('確定');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

</div>


<script>
    $( document ).ready(function() {

        // Multiselect
        $("#closereason").select2({
            allowClear: true,
            placeholder: "選擇"
        });

        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked"
            <?
                if(!empty($_cutoffdate)){
            ?>
            ,startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
            <?
                }
            ?>
        });
        validate_form();
    });

</script>

