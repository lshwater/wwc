<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("Update Log")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
<!--                    --><?php //echo $this->Html->link('<span class="btn-label icon fa fa-print"></span>'.__('Export Smart Card'), array("action"=>"export", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--                    --><?php //echo $this->Html->link('<span class="btn-label icon fa fa-print"></span>'.__('Export Address Label'), array("action"=>"exportaddrlabel", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
                </div>

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

        <div class="table-default">
            <table cellspacing="0" class="table table-striped nowrap" id="jq-datatables" width="100%">
                <thead>
                <tr>
<!--                    <th></th>-->
                    <th><?php echo __('Model'); ?></th>
                    <th><?php echo __('Item'); ?></th>
                    <th><?php echo __('Action'); ?></th>
                    <th><?php echo __('Field'); ?></th>
<!--                    <th>--><?php //echo __('Before'); ?><!--</th>-->
<!--                    <th>--><?php //echo __('After'); ?><!--</th>-->
                    <th><?php echo __('Change'); ?></th>
                    <th><?php echo __('By'); ?></th>
                    <th><?php echo __('時間'); ?></th>
<!--                    <th class="actions">--><?//=__('Actions')?><!--</th>-->
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
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "status", "value": $("#filter-status").val() } ,
                    { "name": "membertype", "value": $("#filter-type").val() },
                );
            },

            "aoColumns": [
                {mData:"item_model"},
                {mData:"item_id"},
                {mData:"type"},
                {mData:"field"},
                // {mData:"before"},
                // {mData:"after"},
                {mData:"change"},
                {mData:"user_id"},
                {mData:"created"},
                // {mData:"action"}
            ],
        });

        $('#jq-datatables_wrapper .table-caption').text('<?=__('members_index_table_title')?>');
        $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?=__('members_index_table_placeholder')?>');



        $("#filter-type").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });
</script>