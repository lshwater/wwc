

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <span class="panel-title"><?php echo __('再採購'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('quantity', __('數量'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('quantity', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'數量'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('remark', __('原因'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remark', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'原因'));?>
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


        $("#voucher").select2({
            dropdownParent: $("#modal"),
            placeholder: "請選擇",
            minimumInputLength: 1,
            allowClear:true,
            ajax: {
                url: "<?=$this->Html->url(array('controller'=>'vouchers', 'action'=>'ajax_select2_list'))?>",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "zh-TW",
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
            container: '#modal'
        });

        var location_detail = $("#location_detail");
        location_detail.typeahead({
            source: <?=json_encode($ld)?>,
            autoSelect: true
        });

        $(".select2-modal").select2({
            dropdownParent: $("#modal"),
            placeholder: "請選擇",
        });

    });

</script>