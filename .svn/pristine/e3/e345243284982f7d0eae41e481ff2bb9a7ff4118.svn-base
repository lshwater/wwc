<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder page-header-icon"></i>&nbsp;&nbsp;所有批閱項目
        </h1>

    </div>
</div>

<div class="row">


    <div class="col-sm-2">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-type",'options'=>$stock_type,
                'placeholder'=>__("項目")
            )
        ); ?>
    </div>
    <div class="col-sm-2">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-type",'options'=>$stock_type,
                'placeholder'=>__("批閱項目")
            )
        ); ?>
    </div>
    <div class="col-sm-2">
        <?php echo $this->Form->input('name', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin filterauto',
                'id'=>"filter-name",
                'placeholder'=>__("提交者")
            )
        ); ?>
    </div>

    <div class="col-sm-2">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-type",'options'=>$stock_type,
                'placeholder'=>__("批閱狀態")
            )
        ); ?>
    </div>


</div>
<br>

<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table nowrap" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th style="width:5%"></th>
                    <th style="width:5%">項目</th>
                    <th style="width:15%">名稱</th>
                    <th style="width:10%">提交者</th>
                    <th style="width:10%">批閱項目</th>
                    <th style="width:15%">改變</th>
                    <th style="width:10%">批閱狀態</th>
                    <th style="width:10%">最後更新時間</th>
                    <th class="actions" style="width:10%"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <tr class="active">
                    <td><span class="badge badge-warning"><i class="fa fa-plus"></i></span></td>
                    <td>會員</td>
                    <td>馮XX</td>
                    <td>陳大文</td>
                    <td>普通會藉</td>
                    <td><span class="label label-info">失效</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">生效</span></td>
                    <td><span class="label">等待批閱</span></td>
                    <td>2019-06-19 18:05:43</td>
                    <td><button class="btn btn-sm btn-danger">批閱</button></td>
                </tr>
                <tr class="active">
                    <td><span class="badge"><i class="fa fa-minus"></i></span></td>
                    <td>服務計劃</td>
                    <td>兒童及青少年古箏組 - 初級</td>
                    <td>陳大文</td>
                    <td>狀態</td>
                    <td><span class="label label-info">通過1級批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過2級批閱</span></td>
                    <td><span class="label">等待批閱</span></td>
                    <td>2019-06-19 18:05:43</td>
                    <td><button class="btn btn-sm btn-danger">批閱</button></td>
                </tr>
                <tr class="info">
                    <th rowspan="4"></th>
                    <th rowspan="4">詳細批閱記錄</th>
                    <th>時間</th>
                    <th>批閱者</th>
                    <th>批閱項目</th>
                    <th>改變</th>
                    <th>批閱狀態</th>
                    <th colspan="2">備註</th>
                </tr>
                <tr class="info">
                    <td>2019-06-19 16:10:51</td>
                    <td>潘柏希</td>
                    <td>狀態</td>
                    <td><span class="label label-info">通過1級批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過2級批閱</span></td>
                    <td><span class="label ">等待批閱</span></td>
                    <td colspan="2"></td>
                </tr>
                <tr class="info">
                    <td>2019-06-19 13:00:03</td>
                    <td>梁美顏</td>
                    <td>狀態</td>
                    <td><span class="label label-info">等待批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過1級批閱</span></td>
                    <td><span class="label label-success">已批閱</span></td>
                    <td colspan="2"></td>
                </tr>
                <tr class="info">
                    <td>2019-06-19 10:08:15</td>
                    <td>梁美顏</td>
                    <td>狀態</td>
                    <td><span class="label label-info">等待批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過1級批閱</span></td>
                    <td><span class="label label-danger">請更新內容(拒絕)</span></td>
                    <td colspan="2">個案資料有錯，請更新</td>
                </tr>

                <tr class="active">
                    <td><span class="badge "><i class="fa fa-minus"></i></span></td>
                    <td>服務計劃</td>
                    <td>180 哈佛思維遊戲</td>
                    <td>陳大文</td>
                    <td>狀態</td>
                    <td><span class="label label-info">通過1級批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過2級批閱</span></td>
                    <td><span class="label label-danger">請更新內容(拒絕)</span></td>
                    <td>2019-06-19 18:05:43</td>
                    <td></td>
                </tr>
                <tr class="info">
                    <th rowspan="3"></th>
                    <th rowspan="3">詳細批閱記錄</th>
                    <th>時間</th>
                    <th>批閱者</th>
                    <th>批閱項目</th>
                    <th>改變</th>
                    <th>批閱狀態</th>
                    <th colspan="2">備註</th>
                </tr>
                <tr class="info">
                    <td>2019-06-19 18:05:43</td>
                    <td>梁美顏</td>
                    <td>狀態</td>
                    <td><span class="label label-info">通過1級批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過2級批閱</span></td>
                    <td><span class="label label-danger">請更新內容(拒絕)</span></td>
                    <td colspan="2">個案資料已更新，請重新檢查</td>
                </tr>
                <tr class="info">
                    <td>2019-06-19 16:10:51</td>
                    <td>潘柏希</td>
                    <td>狀態</td>
                    <td><span class="label label-info">等待批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過1級批閱</span></td>
                    <td><span class="label label-success">已批閱</span></td>
                    <td colspan="2"></td>
                </tr>

                <tr class="active">
                    <td><span class="badge badge-warning"><i class="fa fa-plus"></i></span></td>
                    <td>存貨</td>
                    <td>愛心米 2KG 一包</td>
                    <td>陳大文</td>
                    <td>採購(數量：300)</td>
                    <td><span class="label label-info">通過4級批閱</span>  <i class='fa fa-caret-right'></i> <span class="label label-warning">通過5級批閱</span></td>
                    <td><span class="label label-success">已批閱</span></td>
                    <td>2019-06-19 18:05:43</td>
                    <td><button class="btn btn-sm btn-info">查看</button></td>
                </tr>

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

        //var table = $('#jq-datatables').dataTable({
        //    language: {
        //        "sProcessing":   "<?//=__('sProcessing')?>//",
        //        "sLengthMenu":   "<?//=__('sLengthMenu')?>//",
        //        "sZeroRecords":  "<?//=__('sZeroRecords')?>//",
        //        "sInfo":         "<?//=__('sInfo')?>//",
        //        "sSearch":         "<?//=__('sSearch')?>//",
        //        "sInfoEmpty":    "<?//=__('sInfoEmpty')?>//",
        //        "sInfoFiltered": "<?//=__('sInfoFiltered')?>//",
        //        "oPaginate": {
        //            "sFirst":    "<?//=__('sFirst')?>//",
        //            "sPrevious": "<?//=__('sPrevious')?>//",
        //            "sNext":     "<?//=__('sNext')?>//",
        //            "sLast":     "<?//=__('sLast')?>//"
        //        }
        //    },
        //    "bProcessing": true,
        //    "searching":true,
        //    "bServerSide": true,
        //    "sAjaxSource": "<?//=$this->Html->url(array("action"=>"my_approval_list"))?>//",
        //    // fnServerParams: function ( aoData ) {
        //        // aoData.push(
        //            // { "name": "status", "value": $("#filter-status").val() } ,
        //            // { "name": "membertype", "value": $("#filter-type").val() },
        //        // );
        //    // },
        //    "aoColumns": [
        //        {mData:"model"},
        //        {mData:"model_id_name"},
        //        {mData:"requester"},
        //        {mData:"field"},
        //        {mData:"change"},
        //        {mData:"status"},
        //        {mData:"created"},
        //        {mData:"action"}
        //    ],
        //});

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