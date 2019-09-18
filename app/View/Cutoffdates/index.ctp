<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-calendar page-header-icon"></i>&nbsp;&nbsp;截止日期
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="btn-label icon fa fa-plus"></span> 新增日期', array('action' => 'add'), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'style'=>'width:100%;')); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

        <div class="table-default">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('date', "此日期前"); ?></th>
                    <th><?php echo $this->Paginator->sort('activedate', "生效日期"); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cutoffdates as $cutoffdate):
                    if($curcutoffdate['Cutoffdate']['id'] == $cutoffdate['Cutoffdate']['id']){
                        $cutlabel = '<span class="label label-success label-tag"><i class="fa fa-calendar"></i> Current</span>';
                    }else{
                        $cutlabel = "";
                    }
                ?>
                    <tr>
                        <td><?php echo h($cutoffdate['Cutoffdate']['name']); ?> <?=$cutlabel?></td>
                        <td><?php echo h($cutoffdate['Cutoffdate']['activedate']); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $cutoffdate['Cutoffdate']['id'], 'ajax'=>true), array('class'=>'btn btn-sm btn-warning modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                            <?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $cutoffdate['Cutoffdate']['id']), array('class'=>'btn btn-sm btn-danger', 'escape'=>false), __('Are you sure you want to delete # %s?', $cutoffdate['Cutoffdate']['name'])); ?>
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

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('#jq-datatables').dataTable(
            {
                "order": [[ 0, "desc" ]],
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
            }
        );

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
    });
</script>