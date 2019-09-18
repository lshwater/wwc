<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<?
//configure::write('debug',2);
?>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("存貨清單"), array('controller'=>'stocks',"action"=>"index"))?>
    </li>
    <li class="active"><?=__("新增單據")?></li>
</ul>
<?php echo $this->Form->create('Voucher', array('class'=>'form-horizontal validate_form preventDoubleSubmission','type'=>'file')); ?>

<?
if(!empty($this->request->query['stock'])){
    echo $this->Form->hidden('stock_id', array('value'=>$this->request->query['stock']));
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('新增單據'); ?></span>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <?php echo $this->Form->label('unit_id', __('單位 *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('unit_id', array('div'=>false,'label'=>false, 'class'=>'form-control select2', 'options'=>$unit, 'required'=>'required', 'empty'=>false));?>
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

                <div class="form-group">
                    <?php echo $this->Form->label('account_code', __('Account Code'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('account_code', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Account Code'));?>
                    </div>
                </div> <!-- / .form-group -->

<!--                <div class="form-group">-->
<!--                    --><?php //echo $this->Form->label('invoice_no', __('Invoice No.'), 'col-sm-2 control-label'); ?>
<!--                    <div class="col-sm-10">-->
<!--                        --><?php //echo $this->Form->input('invoice_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Invoice No.'));?>
<!--                    </div>-->
<!--                </div> -->
<!---->
<!--                <div class="form-group">-->
<!--                    --><?php //echo $this->Form->label('invoice_date', __('Invoice Date'), 'col-sm-2 control-label'); ?>
<!--                    <div class="col-sm-10">-->
<!--                        --><?php //echo $this->Form->input('invoice_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker'));?>
<!--                    </div>-->
<!--                </div> -->

                <div class="form-group">
                    <?php echo $this->Form->label('source_of_fund', __('Source of Fund'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('source_of_fund', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'編號'));?>
                    </div>
                </div> <!-- / .form-group -->


            </div>
            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
            </div>

        </div>

    </div>

</div>

    <?php echo $this->Form->end(); ?>

<br>
<br>
<br>
<br>
<script>
    $(document).ready(function() {



        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "zh-TW",
            autoclose: true,
            todayHighlight: true,
            clearBtn: true
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




    });
</script>

