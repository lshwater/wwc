
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Dbmodel', array('class'=>'form-horizontal validate_form')); ?>

        <div class="modal-header">
            <span class="panel-title"><?=__('更新Model')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('name', __('Name'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'name'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('oname', __('Other Name'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('oname', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'other name'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('db_table', __('db_table'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('db_table', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'db_table'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('model_ref', __('model_ref'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('model_ref', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'model_ref'));?>
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
