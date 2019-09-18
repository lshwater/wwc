<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-pencil-square-o page-header-icon"></i>&nbsp;&nbsp;<?= __("參加者報名記錄") ?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!--                <div class="pull-right col-xs-12 col-sm-auto">-->
                <!--                    --><?php //echo $this->Html->link('<i class="fa fa-refresh fa-spin"></i>', array('action' => 'refresh'), array('escape'=>false, 'class'=>'btn btn-success')); ?>
                <!--                </div>-->

                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="btn-label icon fa fa-print"></span>'.__('匯出紀錄'), array("action"=>"export_histories", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal_view')); ?>

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
                <th><?= __('參加者') ?></th>
                <th><?= __('活動') ?></th>
                <th><?= __('報名日期') ?></th>
                <th><?= __("總金額") ?> / <?= __('收據編號') ?></th>
                <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
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


    $(document).ready(function () {

        $('#jq-datatables').DataTable({
            "order": [
                [ 2, "desc" ]
            ],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("controller"=>"Activityapplicants", "action"=>"ajax_histories"))?>",
            columnDefs: [
                {
                    targets: [2],   //first name & last name
                    orderable: true
                },
                {
                    targets: [0, 1, 3],
                    orderable: false
                }
            ],
            "aoColumns": [
                {mData: "Activityapplicant.name"},
                {mData: "Activity.name"},
                {mData: "Activityapplication.date"},
                {mData: "Activityapplication.date"},
                {mData: "Activityapplication.date"}
            ],
            language: {
                "sProcessing": "<?=__('sProcessing')?>",
                "sLengthMenu": "<?=__('sLengthMenu')?>",
                "sZeroRecords": "<?=__('sZeroRecords')?>",
                "sInfo": "<?=__('sInfo')?>",
                "sSearch": "<?=__('sSearch')?>",
                "sInfoEmpty": "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst": "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext": "<?=__('sNext')?>",
                    "sLast": "<?=__('sLast')?>"
                }
            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $('td:eq(0)', nRow).html(aData.Activityapplicant.membercode + "<br />" + aData.Activityapplicant.c_name + "<br />" + aData.Activityapplicant.e_name);
                $('td:eq(3)', nRow).html("$"+aData.Activityapplicant.cost + '<br /><a href="<?=$this->Html->url(array('controller'=>'activityapplications', 'action'=>'receipt'))?>/' + aData.Activityapplication.id + '" class="openasnew">' + aData.Activityapplication.payment_code + ' <i class="fa fa-search"></i></a>');
                $('td:eq(4)', nRow).html('<a href="<?=$this->Html->url(array('controller'=>'activityapplications', 'action'=>'edit'))?>/' + aData.Activityapplication.id + '" class=""> <i class="fa fa-pencil"></i> 修改</a>');

            }
        });

        $('#modal_error').on('hidden.bs.modal', function () {
            $('#modal_error').removeData();
        });

        $('#modal_view').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });
</script>