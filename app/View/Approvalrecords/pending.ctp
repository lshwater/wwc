<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder page-header-icon"></i>&nbsp;&nbsp;待批閱項目
        </h1>

    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table table-striped nowrap" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th>項目</th>
                    <th>項目名稱</th>
                    <th>提交者</th>
                    <th>批閱項目</th>
                    <th>改變</th>
                    <th>批閱狀態</th>
                    <th>提交時間</th>
                    <th class="actions"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {

        var table = $('#jq-datatables').dataTable({
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
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"my_approval_list"))?>",
            // fnServerParams: function ( aoData ) {
                // aoData.push(
                    // { "name": "status", "value": $("#filter-status").val() } ,
                    // { "name": "membertype", "value": $("#filter-type").val() },
                // );
            // },
            "aoColumns": [
                {mData:"model"},
                {mData:"model_id_name"},
                {mData:"requester"},
                {mData:"field"},
                {mData:"change"},
                {mData:"status"},
                {mData:"created"},
                {mData:"action"}
            ],
        });

        //$('#jq-datatables_wrapper .table-caption').text('<?//=__('members_index_table_title')?>//');
        //$('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?//=__('members_index_table_placeholder')?>//');
        //
        //
        //
        //$("#filter-type").on("change", function() {
        //    table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        //});
        //
        //$("#filter-status").on("change", function() {
        //    table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        //});
        //
        //$('#modal').on('hidden.bs.modal', function () {
        //    $('#modal').removeData('bs.modal')
        //});
        //
        //$('#modal').on('loaded.bs.modal', function () {
        //    $('.modalonly').show();
        //    $('.modaloff').hide();
        //});

    });
</script>