<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-cogs page-header-icon"></i>&nbsp;&nbsp;<?php echo __('Parameters'); ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                        <th><?php echo $this->Paginator->sort('name', "名稱"); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parameters as $parameter): ?>
                        <tr>
                            <td><?php echo $this->Html->link(h($parameter['Parameter']['name']), array('action'=>'view', $parameter['Parameter']['model'], $parameter['Parameter']['name'], 'ajax'=>true), array('class'=>'modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));?></td>
                            <td class="actions">
                                <?php
                                if($parameter['Parameter']['status'] == 1){
                                    echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-plus"></i></button>&nbsp;', array('action' => 'add', $parameter['Parameter']['model'], $parameter['Parameter']['name'], 'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
                                    echo $this->Html->link('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-pencil"></i></button>&nbsp;', array('action' => 'edit', $parameter['Parameter']['model'], $parameter['Parameter']['name'], 'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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

    $( document ).ready(function() {
        validate_form();

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
    })

</script>
