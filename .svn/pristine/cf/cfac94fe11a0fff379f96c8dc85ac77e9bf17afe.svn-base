<?//
//Configure::write('debug', 2);
//debug($volunteers);
//?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-user-md page-header-icon"></i>&nbsp;&nbsp;<?=__("護老者管理")?>
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
            <table cellspacing="0"  class="table table-striped nowrap" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th><?=__('編號')?></th>
                    <th><?=__('姓名')?></th>
                    <th class="actions"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($volunteers as $volunteer): ?>
                    <tr>
                        <td></td>
                        <td><?php echo h($volunteer['Volunteer']['code']); ?>&nbsp;</td>
                        <td><?php echo h($volunteer['Volunteer']['c_name'].' '.$volunteer['Volunteer']['e_name']);?></td>
                        <td class="actions">
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $volunteer['Volunteer']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape'=>false));  ?>
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('action' => 'edit', $volunteer['Volunteer']['id'], 'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

        $('#jq-datatables').dataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
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
            deferRender: true
        });
<!--        $('#jq-datatables_wrapper .table-caption').text('--><?//=__('volunteers_index_table_title')?><!--');-->
<!--        $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '--><?//=__('volunteers_index_table_placeholder')?><!--');-->

        $('.active-switcher').switcher({
            on_state_content: 'ON',
            off_state_content: 'OFF'
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