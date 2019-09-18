<div class="panel">
    <div class="panel-heading">
        <h2>
            活動報告書批閱評語
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Eventfinalreport', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('id', array("value"=>$eventfinalreport_id)); ?>
        <div class="form-group">
            <?php echo $this->Form->label('Approvalrecord.approvalrecordstatus_id', "結果", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('Approvalrecord.approvalrecordstatus_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('Approvalrecord.comment', "評語", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('Approvalrecord.comment', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> <? echo ' '.__('確定');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

</div>


<script>
    $( document ).ready(function() {

        // Multiselect
        $(".select2_modal").select2({
            allowClear: true
        });

        validate_form();
    });

</script>

