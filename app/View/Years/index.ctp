<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-cog page-header-icon"></i>&nbsp;&nbsp;年度</h1>
        <div class="pull-right col-xs-12 col-sm-auto">
            <?php echo $this->Html->link('<span class="btn-label icon fa fa-plus"></span> 新增年度', array('action' => 'add'), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'style'=>'width:100%;')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                <thead>
                <tr>
                    <th>年度</th>
                    <th>生效日期</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($years as $year):
                    if($curyear['Year']['id'] == $year['Year']['id']){
                        $cutlabel = '<span class="label label-success label-tag"><i class="fa fa-calendar"></i> Current</span>';
                    }else{
                        $cutlabel = "";
                    }
                ?>
                    <tr>
                        <td><?php echo h($year['Year']['start']); ?>&nbsp;-&nbsp;<?php echo h($year['Year']['end']); ?> <?=$cutlabel?></td>
                        <td><?php echo h($year['Year']['activedate']); ?></td>
                        <td>
                            <?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $year['Year']['id']), array('class'=>'btn btn-sm btn-warning', 'escape'=>false)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


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
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
        })

</script>