
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Workflow', array('class'=>'form-horizontal validate_form')); ?>

        <div class="modal-header">
            <span class="panel-title"><?=__('新增Workflow')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->hidden('model_id',array('value'=>$model_id)); ?>

            <div class="form-group">
                <?php echo $this->Form->label('name', __('Name'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'name'));?>
                </div>
            </div>


        </div>
        <div class="modal-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<script>
    $( document ).ready(function() {

    });
</script>
