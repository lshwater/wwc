<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-university page-header-icon"></i>&nbsp;&nbsp;Dbmodels
            <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-plus"></i></button>', array('action' => 'add' , 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>

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
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped nowrap" id="jq-datatables">
                <thead>
                <tr>
                    <th style="width:15%"><?=__('Name')?></th>
                    <th style="width:15%"><?=__('Other Name')?></th>
                    <th style="width:15%"><?=__('db_table')?></th>
                    <th style="width:15%"><?=__('model_ref')?></th>
                    <th class="actions"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><?=$model['Dbmodel']['name']?></td>
                        <td><?=$model['Dbmodel']['oname']?></td>
                        <td><?=$model['Dbmodel']['db_table']?></td>
                        <td><?=$model['Dbmodel']['model_ref']?></td>
                        <td class="actions">
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $model['Dbmodel']['id']), array('class'=>'', 'escape'=>false));  ?>
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('action' => 'edit', $model['Dbmodel']['id'], 'redirect'=>urlencode($this->here), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-success">Cus Field</button>', array('action' => 'preview', $model['Dbmodel']['id']), array('class'=>'', 'escape'=>false));  ?>
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-info">Workflow</button>', array('action' => 'workflow', $model['Dbmodel']['id']), array('class'=>'', 'escape'=>false));  ?>
                            <?php echo $this->Form->postLink("<i class='fa fa-recycle'></i>", array('controller' => 'dbmodels', 'action' => 'reload', $model['Dbmodel']['id']), array('class'=>'btn btn-sm btn-danger', 'escape'=>false), __('Are you sure you want to reload # %s?', $model['Dbmodel']['oname'])); ?>

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

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $( document ).ready(function() {
        $('#jq-datatables').dataTable({
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
        $('#jq-datatables_wrapper .table-caption').text('<?=__('units_index_table_title')?>');
        //$('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?//=__('units_index_table_placeholder')?>//');

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
    })

</script>