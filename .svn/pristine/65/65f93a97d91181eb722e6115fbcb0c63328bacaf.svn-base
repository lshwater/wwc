<div class="panel">
    <div class="panel-heading">
        <h2>
            完結計劃
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Eventproposal', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('id', array("value"=>$eventproposal_id)); ?>
        <?php echo $this->Form->hidden('closed', array("value"=>1)); ?>
        <div class="form-group">
            <?php echo $this->Form->label('closereason_id', "原因", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('closereason_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "required"=>"required"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('close_reason', "其他原因", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('close_reason', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
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
        $(".select2").select2({
            allowClear: true
        });

        validate_form();
    });

</script>

