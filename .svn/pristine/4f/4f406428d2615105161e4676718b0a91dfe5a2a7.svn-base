
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Voucher', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <span class="panel-title"><?php echo __('修改單據'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('unit_id', __('單位 *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('unit_id', array('div'=>false,'label'=>false, 'class'=>'form-control select2-modal', 'options'=>$unit, 'required'=>'required', 'empty'=>false));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('code', __('Voucher No. *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('code', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'編號','required'=>'required', 'default'=>$this->request->query['voucher']));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('voucher_date', __('Voucher Date *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('voucher_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker','required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

<!--            <div class="form-group">-->
<!--                --><?php //echo $this->Form->label('invoice_no', __('Invoice No.'), 'col-sm-2 control-label'); ?>
<!--                <div class="col-sm-10">-->
<!--                    --><?php //echo $this->Form->input('invoice_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Invoice No.'));?>
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group">-->
<!--                --><?php //echo $this->Form->label('invoice_date', __('Invoice Date'), 'col-sm-2 control-label'); ?>
<!--                <div class="col-sm-10">-->
<!--                    --><?php //echo $this->Form->input('invoice_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker'));?>
<!--                </div>-->
<!--            </div>-->

            <div class="form-group">
                <?php echo $this->Form->label('source_of_fund', __('Source of Fund'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('source_of_fund', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'編號'));?>
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

        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "zh-TW",
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
            container: '#modal'
        });


        //$(".datetimepicker").daterangepicker(
        //    {
        //        autoUpdateInput: false,
        //        ranges: {
        //            '<?//=__('today')?>//': [moment(), moment()],
        //            '<?//=__('yesterday')?>//': [moment().subtract('days', 1), moment().subtract('days', 1)],
        //            '<?//=__('last_7')?>//': [moment().subtract('days', 6), moment()],
        //            '<?//=__('last_30')?>//': [moment().subtract('days', 29), moment()],
        //            '<?//=__('this_month')?>//': [moment().startOf('month'), moment().endOf('month')],
        //            '<?//=__('prev_month')?>//': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        //        },
        //        dateLimit: { months: 2 },
        //        separator: " to ",
        //        locale: {
        //            applyLabel: '<?//=__('submit')?>//',
        //            cancelLabel: '<?//=__('cancel')?>//',
        //            fromLabel: '<?//=__('from')?>//',
        //            toLabel: '<?//=__('to')?>//',
        //            format: 'YYYY-MM-DD',
        //            customRangeLabel: '<?//=__('custom')?>//'
        //        }
        //    }
        //);

        $('.datetimepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('.datetimepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('.datetimepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $(".select2-modal").select2({
            dropdownParent: $("#modal"),
            placeholder: "請選擇",
        });


    });
</script>

