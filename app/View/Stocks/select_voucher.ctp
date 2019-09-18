

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <span class="panel-title"><?php echo __('選擇單據'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <?php echo $this->Form->label('voucher_id', __('單據'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('voucher_id', array('div'=>false,'label'=>false, 'class'=>'select2-modal form-control select2-offscreen','options'=>$voucher, 'placeholder'=>'選擇', 'required'=>'required', 'empty'=>false));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="modal-footer text-right">
            <?=$this->Html->link('未有單據',array('action'=>'add'),array('class'=>'btn btn-info','escape'=>'false'))?>
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>


    $(document).ready(function() {
        validate_form();


        if($("#modal").length){
            $(".select2-modal").select2({
                dropdownParent: $("#modal"),
                placeholder: "請選擇",
                minimumInputLength: 1,
                allowClear:true,
                //ajax: {
                //    url: "<?//=$this->Html->url(array('controller'=>'vouchers', 'action'=>'ajax_select2_list'))?>//",
                //    dataType: 'json',
                //    type: "GET",
                //    quietMillis: 50,
                //    processResults: function (data) {
                //        return {
                //            results: data
                //        };
                //    }
                //}
            });
        }else{
            $(".select2-modal").select2({
                // dropdownParent: $("#modal"),
                placeholder: "請選擇",
                minimumInputLength: 1,
                allowClear:true,
                //ajax: {
                //    url: "<?//=$this->Html->url(array('controller'=>'vouchers', 'action'=>'ajax_select2_list'))?>//",
                //    dataType: 'json',
                //    type: "GET",
                //    quietMillis: 50,
                //    processResults: function (data) {
                //        return {
                //            results: data
                //        };
                //    }
                //}
            });
        }



    });

</script>