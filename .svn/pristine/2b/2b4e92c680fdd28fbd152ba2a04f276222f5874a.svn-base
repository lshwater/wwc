

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <span class="panel-title"><?php echo __('更新存貨'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('voucher_id', __('單據 *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('voucher_id', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'單據','id'=>'voucher','required'=>'required', 'options'=>$voucher));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('fix_asset_no', __('Fix Asset Label No. *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('fix_asset_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Fix Asset Label No. ','required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('unit_id', __('所屬單位 *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('unit_id', array('div'=>false, 'options'=>$units,'label'=>false, 'class'=>'select2-modal form-control select2-offscreen', 'placeholder'=>'Select a Member Level', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('name', __('名稱'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'名稱','required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('type', __('類別 *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('type', array('div'=>false, 'options'=>$type,'label'=>false, 'class'=>'select2-modal form-control select2-offscreen', 'placeholder'=>'Select a Member Level', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('location', __('所地在'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('location', array('div'=>false, 'options'=>$location,'label'=>false, 'class'=>'select2-modal form-control select2-offscreen', 'placeholder'=>'Select a Member Level'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('location_detail', __('位置'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('location_detail', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'位置', 'required'=>'required', 'id'=>'location_detail'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('cost', __('價格'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cost', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'價格'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('acquired_from', __('購自'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('acquired_from', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'購自'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('invoice_no', __('Invoice No.'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('invoice_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Invoice No.'));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('invoice_date', __('Invoice Date'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('invoice_date', array('div'=>false,'label'=>false, 'class'=>'form-control datepicker', 'placeholder'=>'Invoice Date'));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('description', __('簡介'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('description', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'簡介'));?>
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