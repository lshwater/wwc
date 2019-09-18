<?php
//echo $this->Html->script('select2v4.min');

?>
<style>
    .no-space {
        margin-bottom: 2px;
        margin-top: 2px;
        border: 0px;
    }
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->



    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
                採購請求
            </h1>

        </div>
    </div>


    <div class="row">
    <div class="col-sm-2">
        <?php echo $this->Form->input('name', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin filterauto',
                'id'=>"filter-name",
                'placeholder'=>__("存貨名稱")
            )
        ); ?>
    </div>

    <div class="col-sm-2">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-type",'options'=>$stock_type,
                'placeholder'=>__("類別")
            )
        ); ?>
    </div>

    <div class="col-sm-2" id="button" hidden>
        <?=$this->Html->link('新增PO',array('action'=>'newpo' ,'ajax'=>true),array('class'=>'modalbtn btn btn-success', 'escape'=>false,'data-toggle'=>'modal', 'data-target'=>'#modal' ));?>

    </div>
</div>


<div class="row m-t-1">
    <div class="col-sm-12">
<!--        <div class="text-right col-xs-12 col-sm-auto hidden">-->
<!--            --><?php //echo $this->Html->link(__('提交'), array("action"=>"export", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-success btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--            --><?php //echo $this->Html->link(__('取消'), array("action"=>"exportaddrlabel", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-default  btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--        </div>-->
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                <thead>
                <tr>
                    <th style="width:20%"><?php echo  __('名稱'); ?></th>
                    <th style="width:10%"><?php echo  __('類別'); ?></th>
                    <th style="width:4%"><?php echo  __('數量'); ?></th>
                    <th style="width:8%"><?php echo  __('原因'); ?></th>
                    <th style="width:10%"><?php echo __('申請人'); ?></th>
                    <th style="width:10%"><?php echo __('單位'); ?></th>
                    <th style="width:18%"><?php echo __('Actions'); ?></th>
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

    var total = 0;
    $(document).ready(function () {
//        $('#jq-datatables').DataTable( {
////            "stateSave": true
//        } );


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
            "pageLength": 10,
            "bProcessing": true,
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    // { "name": "assessment_date", "value": $("#filter-date").val() } ,
                    { "name": "name", "value": $("#filter-name").val() },
                    { "name": "voucher_id", "value": $("#filter-voucher").val() },
                    { "name": "type", "value": $("#filter-type").val() },
                    { "name": "status", "value": $("#filter-status").val() },
                    { "name": "location", "value": $("#filter-location").val() },
                    { "name": "holder_id", "value": $("#filter-user").val() },
                );
            },

            "aoColumns": [
//                {mData:"id"},
//                 {mData:"image"},
                {mData:"name"},
                {mData:"type"},
                {mData:"quantity"},
                {mData:"remark"},
                {mData:"requester"},
                {mData:"unit"},
                {mData:"action"}
            ],
            "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                $(nRow).find('input[type="checkbox"]').on('click',function(){
                    if($(this).is(':checked')){
                        total ++;
                    } else {
                        total --;
                    }

                    if(total >0){
                        $('#button').show();
                    }else{
                        $('#button').hide();
                    }
                });

                $('.quickselect').quickselect({
                    activeButtonClass: 'btn-primary active',
                    buttonClass: 'btn btn-default',
                    breakOutAll: true,
                    selectDefaultText: 'Other',
                    wrapperClass: 'btn-group'
                });

            },
            "fnDrawCallback": function( oSettings ) {
                $('.quickselect').quickselect({
                    activeButtonClass: 'btn-info active',
                    buttonClass: 'btn btn-default',
                    breakOutAll: true,
                    selectDefaultText: 'Other',
                    wrapperClass: 'btn-group'
                });
                // $('.switcher').switcher({
                //     on_state_content: 'ON',
                //     off_state_content: 'OFF'
                // });


                //$('.switcher').click(function(){
                //    var obj = $(this).find('input[type=checkbox]');
                //
                //    if(!obj.attr('disabled')){
                //        var id = obj.attr('data-id');
                //        var checkval = obj.is(':checked')?1:0;
                //
                //
                //        $.ajax({
                //            type: "POST",
                //            url: "<?//=$this->Html->url(array("action"=>"changeactive"))?>//",
                //            data: {id:id, valid:checkval},
                //            dataType: 'json'
                //        })
                //            .done(function(data) {
                //                if(data.result){
                //                    obj.val(parseInt(data.valid));
                //                    if(obj.val() == 1){
                //                        obj.attr('checked', 'checked');
                //                    }else{
                //                        obj.removeAttr('checked');
                //                    }
                //                }
                //                else
                //                {
                //                    alert('Update Fail!');
                //                }
                //
                //
                //            })
                //            .fail(function() {
                //                alert('Active Fail! Please try again');
                //            });
                //    }
                //
                //});

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


        //$('.active-switcher').switcher({
        //    on_state_content: '<span class="fa fa-check"></span>',
        //    off_state_content: '<span class="fa fa-times"></span>'
        //});
        //
        //$('.active-switcher').click(function () {
        //    var obj = $(this);
        //    var member_id = obj.attr('data-user');
        //    var checkval = obj.is(':checked') ? 1 : 0;
        //    obj.switcher('disable');
        //
        //    $.ajax({
        //        type: "POST",
        //        url: '<?//=$this->Html->url(array('controller'=>'Members', 'action'=>'changeactive'))?>//',
        //        data: {member_id: member_id, active: checkval},
        //        dataType: 'json'
        //    })
        //        .done(function (data) {
        //            if (data.result) {
        //                obj.val(data.active);
        //                if (obj.val() == 1) {
        //                    obj.switcher('on');
        //                } else {
        //                    obj.switcher('off');
        //                }
        //                obj.switcher('enable');
        //            }
        //            else {
        //                alert('Active Fail! Please try again');
        //            }
        //
        //
        //        })
        //        .fail(function () {
        //            alert('Active Fail! Please try again');
        //        });
        //});


        var typingTimer;                //timer identifier
        var doneTypingInterval = 200;  //time in ms (5 seconds)

        $('#filter-name').keyup(function(){
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });



        function doneTyping () {
            table.fnDraw();
        }


        $("#filter-voucher").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        var table2 = null;
        $('#filter-voucher').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log(data);


            $('#vouchertable').show();

            if($.fn.dataTable.isDataTable(table2)){
                table2.fnClearTable();
                table2.fnDestroy();
            }

            table2 = $('#jq-voucher-datatables').dataTable({

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
                "pageLength": 10,
                "bInfo" : false,
                "bPaginate": false,
                "bProcessing": true,
                "searching":false,
                "bServerSide": true,
                "sAjaxSource": "<?=$this->Html->url(array('controller'=>'vouchers',"action"=>"ajax_list"))?>",
                fnServerParams: function ( aoData ) {
                    aoData.push(
                        // { "name": "assessment_date", "value": $("#filter-date").val() } ,
                        { "name": "voucher_id", "value": data },
                    );
                },

                "aoColumns": [
//                {mData:"id"},
                    {mData:"code"},
                    {mData:"voucher_date"},
                    // {mData:"invoice_no"},
                    // {mData:"invoice_date"},
                    {mData:"source_of_fund"},
                    // {mData:"acquired_from"},
                    {mData:"action"}
                ]
            } );

            // }
        });

        $('#filter-voucher').on('select2:unselect', function (e) {
            $('#vouchertable').hide();
            table2.fnClearTable();
            table2.fnDestroy();
        });

        $("#filter-voucher").select2({
            placeholder: "單據",
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

        <?if($this->request->query['voucher']){?>

        $('#filter-voucher').val('<?=$this->request->query['voucher']?>').trigger('change');
//
       $('#vouchertable').show();

        table2 = $('#jq-voucher-datatables').dataTable({

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
            "pageLength": 10,
            "bInfo" : false,
            "bPaginate": false,
            "bProcessing": true,
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array('controller'=>'vouchers',"action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "voucher_id", "value": <?=$this->request->query['voucher']?> },
                );
            },
            "fnDrawCallback": function( oSettings ) {

            },
            "aoColumns": [
                {mData:"code"},
                {mData:"voucher_date"},
                {mData:"invoice_no"},
                {mData:"invoice_date"},
                {mData:"source_of_fund"},
                {mData:"acquired_from"},
                {mData:"action"}
            ]
        } );

        <?}?>



        $("#filter-date").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-type").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $("#filter-hkid").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-user").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-location").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-type").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $("#filter-user").select2({
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