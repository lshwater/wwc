
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Customtype', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('id')?>
        <div class="modal-header">
            <h3 class="modal-title">
                <?=__("Edit")?>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </h3>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <?php echo $this->Form->label('type_name', __('name')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('type_name', array('div'=>false, 'label'=>false,'class'=>'form-control' ,"required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('type_oname', __('other name')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('type_oname', array('div'=>false, 'label'=>false,'class'=>'form-control' ,"required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('model_id', __('model')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('model_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2-modal','options'=>$model ,"required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->


        </div>
        <div class="modal-footer text-right">
            <button type="submit" class="btn btn-primary" ><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>


<script>

    $(document).ready(function() {
        validate_form();

        $(".select2-modal").select2({
            dropdownParent: $("#modal"),
            placeholder: "Select",
        });

    });
</script>
