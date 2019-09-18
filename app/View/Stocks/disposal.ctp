<?php
//echo $this->Html->script('jquery.dataTables.js');

?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

<div class="page-header">

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 flashMessage">
            <i class="fa fa-archive page-header-icon"></i>&nbsp;&nbsp;銷貨清單
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

    <div class="col-sm-3">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-unit",'options'=>$unit,
                'placeholder'=>__("所屬單位")
            )
        ); ?>
    </div>
    <div class="col-sm-2">
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-location",'options'=>$location,
                'placeholder'=>__("位置")
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
        <?php echo $this->Form->input('unit', array(
                'div'=>false, 'label'=>false,
                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                'id'=>"filter-reason",'options'=>$reason,
                'placeholder'=>__("原因")
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
                    <th style="width:15%"><?php echo  __('相片'); ?></th>
                    <th style="width:15%"><?php echo  __('名稱'); ?></th>
                    <th style="width:10%"><?php echo __('所尋單位'); ?></th>
<!--                    <th style="width:15%">--><?php //echo __('可供借出'); ?><!--</th>-->
                    <th style="width:15%"><?php echo __('現時持有'); ?>/<br>預期歸還日</th>
                    <th style="width:15%"><?php echo __('位置'); ?></th>
                    <th style="width:15%"><?php echo __('銷貨原因'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
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
                    { "name": "unit", "value": $("#filter-unit").val() },
                    { "name": "disposal", "value":1 },
                    { "name": "reason", "value":$("#filter-reason").val()  },
                    { "name": "location", "value": $("#filter-location").val() },
                    { "name": "holder_id", "value": $("#filter-user").val() },
                );
            },

            "aoColumns": [
//                {mData:"id"},
                {mData:"image"},
                {mData:"name"},
                {mData:"unit"},
                // {mData:"valid"},
                {mData:"holder"},
                {mData:"location"},
                {mData:"reason"},
                {mData:"action"}
            ],
            "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

                $(nRow).find('.minus').on('click',function(){
//                    console.log($(this).attr('data-id'));
                    $.ajax({
                        type: "POST",
                        url: "<?=$this->Html->url(array('action'=>'ajax_minus'))?>",
                        data: {id:$(this).attr('data-id')},
                        dataType: 'json'
                    })
                        .done(function (data) {
                            if(data.success){
                                table.fnDraw();
                            }
                            else{
                                alert("刪除失敗");
                            }
                        });

                });

                $(nRow).find('.add').on('click',function(){
//                    console.log($(this).attr('data-id'));

                    $.ajax({
                        type: "POST",
                        url:  "<?=$this->Html->url(array('action'=>'ajax_add'))?>",
                        data: {id:$(this).attr('data-id')},
                        dataType: 'json'
                    })
                        .done(function (data) {
                            if(data.success){
                                table.fnDraw();
                            }
                            else{
                                alert("失敗");
                            }
                        });
                });

            },
            "fnDrawCallback": function( oSettings ) {

                $('.switcher').click(function(){
                    var obj = $(this).find('input[type=checkbox]');

                    if(!obj.attr('disabled')){
                        var id = obj.attr('data-id');
                        var checkval = obj.is(':checked')?1:0;


                        $.ajax({
                            type: "POST",
                            url: "<?=$this->Html->url(array("action"=>"changeactive"))?>",
                            data: {id:id, valid:checkval},
                            dataType: 'json'
                        })
                            .done(function(data) {
                                if(data.result){
                                    obj.val(parseInt(data.valid));
                                    if(obj.val() == 1){
                                        obj.attr('checked', 'checked');
                                    }else{
                                        obj.removeAttr('checked');
                                    }
                                }
                                else
                                {
                                    alert('Update Fail!');
                                }


                            })
                            .fail(function() {
                                alert('Active Fail! Please try again');
                            });
                    }

                });

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

        $("#filter-name").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-date").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-type").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


        $("#filter-hkid").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-unit").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-location").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-user").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-reason").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });



        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
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