<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;<?=__("個案清單")?>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-2">

        <label for="show_my_case" class="switcher switcher-success">
            <input type="checkbox" name="show_my_case" id="show_my_case" value="1" checked>
            <div class="switcher-indicator">
                <div class="switcher-yes"><i class="fa fa-check "></i></div>
                <div class="switcher-no" ><i class="fa fa-close"></i></div>
            </div>
            只顯示我的個案
        </label>

    </div>
    <div class="col-sm-3">

        <?php echo $this->Form->input('status', array(
                'div'=>false, 'label'=>false, 'default'=>1,
                'class'=>'form-control no-padding-hr select2 filterauto ', 'placeholder'=>__("選擇顯示方式"), "options"=>array(1=>__("顯示所有"), 2=>__("顯示進行中"), 3=>__("顯示已結束")),
                'id'=>"filter-status",
            )
        ); ?>

    </div>

</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th style="width:15%">編號</th>
                    <th style="width:15%">申請人</th>
                    <th style="width:20%">個案類別</th>
                    <th style="width:20%">個案性質</th>
<!--                    <th style="width:15%">個案申請日期</th>-->
                    <th style="width:15%">負責職員</th>
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

        var show_my_case = 1;

        var table = $('#jq-datatables').dataTable({
            dom: '<"top"<"toolbar">f<"clear">>rt<"bottom"lip<"clear">>',
            // columnDefs: [
            //     {
            //         className: 'control',
            //         orderable: false,
            //         targets:   [0,1,2,3,4,5]
            //     }
            // ],
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
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "status", "value": $('#filter-status').val() } ,
                    { "name": "show_my_case", "value": 1 } ,
                );
            },

            "aoColumns": [
                {mData:"code"},
                {mData:"member"},
                {mData:"casetype"},
                {mData:"casenature"},
                {mData:"user"},
                {mData:"action"}
            ],
        });


        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $(".filterauto").on("change", function(){
            $(this).closest("form").submit();
        });

        $('#show_my_case').click(function(){
            var obj = $(this);
            show_my_training = obj.is(':checked')?1:0;
            table.fnDraw();
        });

        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });


    });
</script>