<div class="page-header">
<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 flashMessage">
            <i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;借出記錄
        </h1>

    </div>
</div>


<div class="row">
    <div class="col-sm-3">
        <?php echo $this->Form->input('name', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin filterauto',
                'id'=>"filter-name",
                'placeholder'=>__("存貨名稱")
            )
        ); ?>
    </div>

    <div class="col-sm-2">
        <?php echo $this->Form->input('date', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin filterauto datepicker',
                'id'=>"filter-date",
                'placeholder'=>__("日期")
            )
        ); ?>
    </div>
    <div class="col-sm-2">

        <?php echo $this->Form->input('user', array(
                'div'=>false, 'label'=>false,'options'=>array(),
                'class'=>'form-control select2-remote allowClear', 'empty'=>true,
                'id'=>"filter-user",
                'placeholder'=>__("持有人")
            )
        ); ?>

    </div>

    <div class="col-sm-1">
        <?php echo $this->Form->input('status', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-status",'options'=>array(1=>'已歸還', 2=>'愈期未還'),
                'placeholder'=>__("狀態")
            )
        ); ?>
    </div>

</div>

<br>
<div class="row">
    <div class="col-sm-12">

        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                <thead>
                <tr>
                    <th></th>
                    <th style="width:12%"><?php echo __('相片'); ?></th>
                    <th style="width:12%"><?php echo __('Fix Asset No.'); ?></th>
                    <th style="width:10%"><?php echo __('物品名稱'); ?></th>
                    <th style="width:10%"><?php echo __('職員名稱'); ?></th>
                    <th style="width:8%"><?php echo __('Unit'); ?></th>
<!--                    <th style="width:10%">--><?php //echo __('數量'); ?><!--</th>-->
                    <th style="width:15%">借出時間</th>
                    <th style="width:10%">預期歸還日</th>
                    <th style="width:15%">實際歸還時間</th>
                    <th><?=__('行動')?></th>
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

    $( document ).on( "click", "a.openmodal", function(ev) {
        //alert("HI");
        ev.preventDefault();
        var target = $(this).attr("href");

        // load the url and show modal on success
        $("#modal .modal-content").load(target, function() {
            $('#modal .modalonly').show();
            $('#modal .modaloff').hide();
        });
    });

    $( document ).ready(function() {



        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('#modal .modalonly').show();
            $('#modal .modaloff').hide();
        });

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
            "order": [[ 5, "desc" ]],
            "bProcessing": true,
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("controller"=>"attendances","action"=>"ajax_list"),true)?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "name", "value": $('#filter-name').val() },
                    { "name": "date", "value": $('#filter-date').val() },
                    { "name": "user_id", "value": $('#filter-user').val() },
                    { "name": "status", "value": $('#filter-status').val() },
                    // { "name": "order_by_modified", "value": 1 },
//                    { "name": "year_id", "value": $("#filter-year").val() },
                );
            },

            "aoColumns": [
                {mData:"id"},
                {mData:"image"},
                {mData:"fix_asset_no"},
                {mData:"item_name"},
                {mData:"user_name"},
                {mData:"unit"},
                // {mData:"count"},
                {mData:"out_time"},
                {mData:"expected_return_time"},
                {mData:"in_time"},
                {mData:"action"}
            ],
            "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
//                 $(nRow).click(function(){
// //                    console.log(iDisplayIndex);
// //                    console.log(nRow);
// //                    console.log(aData);
// //                    console.log("test");
// //                    console.log(this);
//                     $(this).toggleClass('success added');
//                 });

            },
            "aoColumnDefs":[
//                {
//                    "aTargets": [ 9 ],
//                    bSortable: false,
//                    "mRender": function ( aData, type, full ) {
////                        console.log(aData[1]);
////                        console.log(full);
////                        return "123";
////                        return ""full.Shippingstockstatus.name+" ( "+full.Warehouse.Country.name+" - "+full.Warehouse.name+" )";
//                        return '<a class="modalbtn" data-toggle="modal" data-target="#modal" href="'+aData[0]+'"><button class="btn btn-sm btn-info" style="width:30px"><i class="fa fa-info"></i></button></a>' +
//                            '&nbsp;' +
//                            '<a class="modalbtn" data-toggle="modal" data-target="#modal" href="'+aData[1]+'"><button class="btn btn-sm btn-warning" style="width:30px"><i class="fa fa-pencil"></i></button></a>';
//                    }
//                },
                {
                    "aTargets": [ 0 ],
                    bSortable: false,
                    bVisible: false
                },
                {
//                    "aTargets": [ 3 ],
//                    bSortable: false
                },
                {
//                    "aTargets": [ 4 ],
//                    bSortable: false
                }
                ,
                {
//                    "aTargets": [ 5 ],
//                    bSortable: false
                }
                ,
                {
//                    "aTargets": [ 6 ],
//                    bSortable: false
                }
            ]
        } );

        $("#filter-name").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-date").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-user").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $(".select2-remote").select2({
            minimumInputLength: 1,
            allowClear:true,
            placeholder:"持有人",
            ajax: {
                url: "<?=$this->Html->url(array('controller'=>'users', 'action'=>'ajax_select2_list'))?>",
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


    });
</script>