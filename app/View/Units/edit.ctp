
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Unit', array('class'=>'form-horizontal validate_form')); ?>

        <div class="modal-header">
            <span class="panel-title"><?=__('更新單位資料')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('name', __('Name'), 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>'required', 'placeholder'=>'Name', 'id'=>'name'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("tel", __('phone'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("fax", __('Fax'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('fax', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("address", __('Address'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("email", __('email'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('agency_id', __('Agency'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('agency_id', array('div'=>false, 'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'Select a Agency'));?>
                </div>
            </div> <!-- / .form-group -->
            
            <div class="form-group">
                <?php echo $this->Form->label('remark', __('Remark'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remark', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Remark'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>
        <div class="modal-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<script>
    $( document ).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });

        validate_form();

    });
</script>
