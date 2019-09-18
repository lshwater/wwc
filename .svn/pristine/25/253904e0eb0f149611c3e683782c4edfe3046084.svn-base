<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-university page-header-icon"></i>&nbsp;&nbsp;義工機構
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="btn-label icon fa fa-plus"></span> 新增義工機構', array('action' => 'add'), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'style'=>'width:100%;')); ?>
                </div>
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
                    <th></th>
                    <th><?=__("機構")?></th>
                    <th class="actions"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($volunteerunits as $volunteerunit):?>
                    <tr>
                        <td></td>
                        <td><?php echo h($volunteerunit['Volunteerunit']['name']); ?> </td>
                        <td class="actions">
                            <?php echo $this->Html->link('<i class="fa fa-info"></i>', array('action' => 'view', $volunteerunit['Volunteerunit']['id']), array('class'=>'btn btn-sm btn-info ', 'escape'=>false));  ?>
                            <?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $volunteerunit['Volunteerunit']['id']), array('class'=>'btn btn-sm btn-warning ', 'escape'=>false));  ?>
<!--                            --><?php //echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $volunteerunit['Volunteerunit']['id'], 'ajax'=>true), array('class'=>'btn btn-sm btn-warning modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                            <?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $volunteerunit['Volunteerunit']['id']), array('class'=>'btn btn-sm btn-danger', 'escape'=>false), __('Are you sure you want to delete # %s?', $volunteerunit['Volunteerunit']['name'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
        <!-- /5. $DEFAULT_TABLES -->

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
//        validate_form();

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
            }
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