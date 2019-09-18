<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Member', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="panel-heading">
            <span class="panel-title">離開確定 - <?=$member['Member']['c_name']?> (<?=$member['Member']['e_name']?>)</span>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>

            <?php echo $this->Form->hidden('active', array('value'=>0));?>
            <div class="alert">
                <strong>注意!</strong> 你確定學生 <?=$member['Member']['c_name']?> (<?=$member['Member']['e_name']?>) 離開家舍嗎?
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('o_date', __('離院日期'), 'col-sm-1 control-label'); ?>
                <div class="col-sm-11">
                    <?php echo $this->Form->input('o_date', array('div'=>false,'type'=>'text','label'=>false, 'class'=>'form-control datepicker', 'placeholder'=>'離院日期'));?>
                </div>
            </div>

        </div>
        <div class="panel-footer text-right">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-remove-sign"></i> '.__('Cancel'), $this->request->referer(), array('escape'=>false, 'class'=>'btn btn-primary')); ?>
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i> 確定</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });
        validate_form();

        $(".datepickercus").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });

</script>