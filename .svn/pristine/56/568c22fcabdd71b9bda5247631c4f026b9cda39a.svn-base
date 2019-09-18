<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<?
//configure::write('debug',2);
?>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("存貨清單"), array("action"=>"index"))?>
    </li>
    <li class="active"><?=__("新增")?></li>
</ul>
<?php echo $this->Form->create('Stock', array('class'=>'form-horizontal validate_form preventDoubleSubmission','type'=>'file')); ?>

<?if($voucher){?>

<?php echo $this->Form->hidden('voucher_id', array('value'=>$voucher['Voucher']['id']));?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('單據'); ?></span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table cellspacing="0" class="table table-striped nowrap" width="100%">
                        <thead>
                        <tr>
                            <th>Voucher No.</th>
                            <th>Voucher Date</th>
<!--                            <th>Invoice No.</th>-->
<!--                            <th>Invoice Date</th>-->
                            <th>Source of Fund</th>
                            <th>購自</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=h($voucher['Voucher']['code'])?></td>
                                <td><?=h($voucher['Voucher']['voucher_date'])?></td>
<!--                                <td>--><?//=h($voucher['Voucher']['invoice_no'])?><!--</td>-->
<!--                                <td>--><?//=h($voucher['Voucher']['invoice_date'])?><!--</td>-->
                                <td><?=h($voucher['Voucher']['source_of_fund'])?></td>
                                <td><?=h($voucher['Voucher']['acquired_from'])?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('此單據的所有物品'); ?></span>
            </div>
            <div class="panel-body">
                <?if(!empty($voucher['Stock'])){?>
                    <div class="table-responsive">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                            <thead>
                            <tr>
                                <th style="width:15%"><?php echo  __('相片'); ?></th>
                                <th style="width:15%"><?php echo  __('名稱'); ?></th>
                                <th style="width:10%"><?php echo  __('類別'); ?></th>
                                <th style="width:10%"><?php echo __('所尋單位'); ?></th>
                                <th style="width:15%"><?php echo __('現時持有'); ?>/<br>預期歸還日</th>
                                <th style="width:15%"><?php echo __('位置'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?}else{
                    echo "沒有物品";
                }?>

            </div>
        </div>

    </div>
</div>

<?
}else if(!empty($this->request->data['Voucher']['code'])){?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo __('新增單據'); ?></span>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.unit_id', __('單位 *'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.unit_id', array('div'=>false,'label'=>false, 'class'=>'form-control select2', 'options'=>$unit, 'required'=>'required', 'empty'=>false));?>
                        </div>
                    </div> <!-- / .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.code', __('Voucher No. *'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.code', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'編號','required'=>'required'));?>
                        </div>
                    </div> <!-- / .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.voucher_date', __('Voucher Date *'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.voucher_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker','required'=>'required'));?>
                        </div>
                    </div> <!-- / .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.account_code', __('Account Code'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.account_code', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Account Code'));?>
                        </div>
                    </div> <!-- / .form-group -->

<!--                    <div class="form-group">-->
<!--                        --><?php //echo $this->Form->label('Voucher.invoice_no', __('Invoice No.'), 'col-sm-2 control-label'); ?>
<!--                        <div class="col-sm-10">-->
<!--                            --><?php //echo $this->Form->input('Voucher.invoice_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Invoice No.'));?>
<!--                        </div>-->
<!--                    </div> -->
<!---->
<!--                    <div class="form-group">-->
<!--                        --><?php //echo $this->Form->label('Voucher.invoice_date', __('Invoice Date'), 'col-sm-2 control-label'); ?>
<!--                        <div class="col-sm-10">-->
<!--                            --><?php //echo $this->Form->input('Voucher.invoice_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker'));?>
<!--                        </div>-->
<!--                    </div> -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.source_of_fund', __('Source of Fund'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.source_of_fund', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'編號'));?>
                        </div>
                    </div> <!-- / .form-group -->

                    <div class="form-group">
                        <?php echo $this->Form->label('Voucher.acquired_from', __('購自'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('Voucher.acquired_from', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'購自'));?>
                        </div>
                    </div> <!-- / .form-group -->

                </div>

            </div>

        </div>
    </div>


<?} ?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('新增存貨'); ?></span>
            </div>

            <div class="panel-body">


                <div class="form-group">
                    <?php echo $this->Form->label('fix_asset_no', __('Fix Asset Label No. *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('fix_asset_no', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Fix Asset Label No. ','required'=>'required'));?>
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('image', __('相片'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('image', array('type'=>'file','div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'相片'));?>
                    </div>
                </div>

<!--                <div class="form-group">-->
<!--                    --><?php //echo $this->Form->label("membercard", __('配對存貨編碼'), 'col-sm-2 control-label'); ?>
<!--                    <div class="col-sm-10">-->
<!--                        --><?php //echo $this->Form->input("membercard", array('div' => false, 'label' => false, 'class' => 'form-control membercard', "readonly" => "readonly")); ?>
<!--                    </div>-->
<!--                </div>-->

                <div class="form-group">
                    <?php echo $this->Form->label('unit_id', __('所屬單位 *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('unit_id', array('div'=>false, 'options'=>$units,'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'選擇', 'required'=>'required'));?>
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('type', __('類別 *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('type', array('div'=>false, 'options'=>$type,'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'選擇', 'required'=>'required'));?>
                    </div>
                </div> <!-- / .form-group -->



                <div class="form-group">
                    <?php echo $this->Form->label('name', __('名稱 *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('name', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'名稱','required'=>'required'));?>
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('location', __('所地在 *'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('location', array('div'=>false, 'options'=>$location,'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'Select a Member Level', 'required'=>'required', 'empty'=>false));?>
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('location_detail', __('位置 *'), 'col-sm-2 control-label'); ?>
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
                        <?php echo $this->Form->input('invoice_date', array('type'=>'text', 'div'=>false,'label'=>false, 'class'=>'form-control datepicker', 'placeholder'=>'Invoice Date'));?>
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('description', __('簡介'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('description', array('div'=>false,'label'=>false, 'class'=>'form-control', 'placeholder'=>'簡介'));?>
                    </div>
                </div> <!-- / .form-group -->


            </div>

            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
            </div>
        </div>

        <?php echo $this->Form->end(); ?>
    </div>
</div>
<br>
<br>
<br>
<br>
<script>
    $(document).ready(function() {


        //var location_detail = $("#location_detail");
        //location_detail.typeahead({
        //    source: <?//=json_encode($ld)?>//,
        //    autoSelect: true
        //});


        var table = $('#jq-datatables').dataTable({
//            buttons: [
//                'selectAll',
//                'selectNone'
//            ],
            select: true,
            dom: '<"top"<"toolbar">f<"clear">>rt<"bottom"lip<"clear">>',

            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
                "sSearch":         "<?=__('sSearch')?>",
                "sInfoEmpty":    "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst":    "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext":     "<?=__('sNext')?>",
                    "sLast":     "<?=__('sLast')?>"
                }
            },
//            "order": [[ 2, "desc" ],[3,'asc']],
            "bLengthChange" : false,
            "bPaginate": false,
            "bInfo":false,
            "bProcessing": true,
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    // { "name": "assessment_date", "value": $("#filter-date").val() } ,
                    { "name": "voucher_id", "value": "<?=$voucher['Voucher']['id']?>" },
                );
            },

            "aoColumns": [
//                {mData:"id"},
                {mData:"image"},
                {mData:"name"},
                {mData:"type"},
                {mData:"unit"},
                {mData:"holder"},
                {mData:"location"},
            ],
            "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {


            },
            "aoColumnDefs":[
//
                {
//                    "sWidth": "20%",
//                    "aTargets": [ 0 ]

//                    bSortable: false,
//                    bVisible: false
                }
            ]
        } );


        $('.membercard').scannerdevice();

        $.validator.addClassRules("vd_usernameremote", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'username',
                    value: function() {
                        return $("#username").val();
                    }
                }
            }
        });

        $.validator.addClassRules("vd_code", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'code',
                    value: function() {
                        return $("#code").val();
                    }
                }
            }
        });

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

