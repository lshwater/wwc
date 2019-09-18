<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;常用文件
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
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                <thead>
                <tr>
                    <th>名稱</th>
                    <th style="width:40%">簡介</th>
                    <th class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($documents as $document):
                ?>
                    <tr>
                        <td>
                            <?php echo h($document['Document']['name']); ?>
                        </td>
                        <td><?php echo h($document['Document']['des']); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link('<i class="fa fa-download"></i> Download', array("controller"=>"attachments",'action' => 'download', $document['Document']['id']), array('class' => '', 'escape' => false)); ?>
                            <?
                            if($isadmin){
                                echo $this->Form->postLink('<span class="text-danger"><i class="fa fa-times"></i>  Remove</span>', array("controller"=>"Attachments", "action"=>"delete", $document['Document']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array("class" => "", 'escape' => false), __('你確定要刪除附件 （ %s ）？', h($document['Document']['name'])));
                            }
                            ?>
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