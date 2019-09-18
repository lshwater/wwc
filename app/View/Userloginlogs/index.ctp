<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-list page-header-icon"></i>&nbsp;&nbsp;<?=__("職員登入記錄")?>
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
    <div class="col-sm-12">

        <div class="table-default">
            <table cellspacing="0" class="table table-striped nowrap"  id="jq-datatables" width="100%">
                <thead>
                <th><?=__('職員')?></th>
                <th><?=__('登入時間')?></th>
                <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- /5. $DEFAULT_TABLES -->

    </div>
</div>

<script>
    $(document).ready(function () {

        var table = $('#jq-datatables').DataTable( {
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
            "order": [[ 0, "desc" ]],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_search"))?>",
            "aoColumns": [
                {mData:"User.name"},
                {mData:"Userloginlog.created"}
            ]
        } );
    });

</script>