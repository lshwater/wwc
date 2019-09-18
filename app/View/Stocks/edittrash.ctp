

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <span class="panel-title"><?php echo __('更新銷貨記錄'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('disposal', __('銷貨原因'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('disposal', array('div'=>false, 'options'=>$fadeout_reason,'label'=>false, 'class'=>'select2-modal form-control ', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('disposal_code', __('銷貨編碼'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('disposal_code', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'disposal_code'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('disposal_remark', __('備注'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('disposal_remark', array('div'=>false,'label'=>false, 'class'=>'form-control'));?>
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


    $(document).ready(function() {
        validate_form();


        var disposal_code = $("#disposal_code");
        disposal_code.typeahead({
            source: <?=json_encode($disposal_code)?>,
            autoSelect: true
        });

        $(".select2-modal").select2({
            dropdownParent: $("#modal"),
            placeholder: "請選擇",
        });

    });

</script>