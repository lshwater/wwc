
<?
//Configure::write('debug', 2);
////
//debug($memberapplications); exit();
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-address-card page-header-icon"></i>&nbsp;&nbsp;<?=__("續會記錄")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-2">
        <?php echo $this->Form->input('membertype', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control filterauto select2 allowClear', "empty"=>true,
                'id'=>"filter-membertype",
                "options"=>$membertypes,
                'placeholder'=>__("會藉")
            )
        ); ?>
    </div>

    <div class="col-md-2">
        <?php echo $this->Form->input('membercode', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control filterauto',
                'id'=>"filter-membercode",
                'placeholder'=>__("會員編號")
            )
        ); ?>
    </div>

    <div class="col-md-2">
        <?php echo $this->Form->input('membername', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control filterauto',
                'id'=>"filter-membername",
                'placeholder'=>__("會員姓名")
            )
        ); ?>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon no-border"><i class="fa fa-calendar"></i></span>
                <?php echo $this->Form->input('range', array('class'=>'form-control', 'placeholder'=>'選擇續會日期','type'=>'text', 'label'=>false ,'div'=>false, "default"=>"", "id"=>"filter-date")); ?>

            </div>
        </div>
    </div>

    <div class="col-md-2">
        <?php echo $this->Form->input('valid', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control filterauto select2 allowClear', "empty"=>true,
                'id'=>"filter-valid",
                "options"=>array(1=>"有效", 0=>"無效"),
                'placeholder'=>__("有效")
            )
        ); ?>
    </div>

</div>
<hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed table-hover" id="datatables">
        <thead>
        <tr>
            <th><?=__('會藉')?></th>
            <th>類別</th>
            <th><?=__('編號')?></th>
            <th><?=__('會員姓名')?></th>
            <th><?=__('續會日期')?></th>
            <th><?=__('開始日期')?></th>
            <th><?=__('完結日期')?></th>
            <th><?=__('狀態')?></th>
            <th><?=__('Actions')?></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal_view">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var startdate = "";
    var enddate = "";

    $(document).ready(function() {

        var table = table = $('#datatables').dataTable({
            dom: '<"top"<"toolbar"><"clear">>rt<"bottom"lip<"clear">>',

            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets:   1
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   8
                },
            ],
            order: [ 1, 'asc' ],
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
            "bProcessing": true,
            "searching":true,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "membertype", "value": $("#filter-membertype").val() } ,
                    { "name": "membercode", "value": $("#filter-membercode").val() } ,
                    { "name": "membername", "value": $("#filter-membername").val() } ,
                    { "name": "valid", "value": $("#filter-valid").val() } ,
                    { "name": "startdate", "value": startdate },
                    { "name": "enddate", "value": enddate },
                );
            },

            "aoColumns": [
                {mData:"Membertype.name"},
                {mData:"Membershiprecordtype.name"},
                {mData:"Membership.code"},
                {mData:"Member.displayname"},
                {mData:"Membershiprecord.created"},
                {mData:"Membershiprecord.startdate"},
                {mData:"Membershiprecord.enddate"},
                {mData:"Membershiprecord.valid"},
                {mData:"action"}
            ],
        });

        $('#filter-date').daterangepicker({
            opens: 'left',
            timePicker24Hour: true,
            autoUpdateInput: false,
            ranges: {
                '本月': [moment().startOf('month'), moment().endOf('month')],
                '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '最近30天': [moment().subtract('days', 29), moment()],
            },

            locale: {
                format: 'YYYY-MM-DD',
                separator: " 至 ",
                applyLabel: "確定",
                cancelLabel: "取消",
                fromLabel: "由",
                toLabel: "至",
                customRangeLabel: "自定",
                weekLabel: "W",
                daysOfWeek: [
                    "日",
                    "一",
                    "二",
                    "三",
                    "四",
                    "五",
                    "六"
                ],
                monthNames: [
                    "1月",
                    "2月",
                    "3月",
                    "4月",
                    "5月",
                    "6月",
                    "7月",
                    "8月",
                    "9月",
                    "10月",
                    "11月",
                    "12月"
                ],
            }
        });

        $('#filter-date').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));

            startdate = picker.startDate.format('YYYY-MM-DD');
            enddate = picker.endDate.format('YYYY-MM-DD');
            table.fnDraw();
        });

        $('#filter-date').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            startdate = "";
            enddate = "";
            table.fnDraw();
        });

        $("#filter-membertype").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-membercode").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-membername").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-valid").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
    });

</script>
