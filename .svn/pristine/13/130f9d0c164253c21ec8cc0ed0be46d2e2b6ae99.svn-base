<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-university page-header-icon"></i>&nbsp;&nbsp;<?php echo __('Agencies'); ?></h1>
        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="btn-label icon fa fa-plus"></span>'.__('Create New Agency'), array('action' => 'add'), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'style'=>'width:100%;')); ?>
                </div>
                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>

                <!-- Search field -->
                <form action="" class="pull-right col-xs-12 col-sm-6 allowentersubmit">
                    <div class="input-group no-margin">
                        <span class="input-group-addon" style="border:none;background: #fff;background: rgba(0,0,0,.05);"><i class="fa fa-search"></i></span>
                        <input type="text" placeholder="<?php echo __('Search...'); ?>" class="form-control no-padding-hr" style="border:none;background: #fff;background: rgba(0,0,0,.05);">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">&nbsp;</span>
                <div class="panel-heading-controls">
                    <ul class="pagination pagination-xs">
                        <?php echo $this->Paginator->prev('« ', array('tag'=>"li"), null, array('style' => 'display:none'));?>
                        <?php echo $this->Paginator->numbers(array('separator' => '', 'tag'=>"li", 'currentTag'=>"a", "currentClass"=>"active"));?>
                        <?php echo $this->Paginator->next(' »', array('tag'=>"li"), null, array('style' => 'display:none'));?>
                    </ul> <!-- / .pagination -->
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('code', __('Code')); ?></th>
                        <th><?php echo $this->Paginator->sort('name', __('Name')); ?></th>
                        <th><?php echo $this->Paginator->sort('phone', __('Phone')); ?></th>
                        <th><?php echo $this->Paginator->sort('fax', __('Fax')); ?></th>
                        <th><?php echo $this->Paginator->sort('email', __('Email')); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($agencies as $agency): ?>
                        <tr>
                            <td><?php echo h($agency['Agency']['code']); ?>&nbsp;</td>
                            <td><?php echo h($agency['Agency']['name']); ?>&nbsp;</td>
                            <td><?php echo h($agency['Agency']['phone']); ?>&nbsp;</td>
                            <td><?php echo h($agency['Agency']['fax']); ?>&nbsp;</td>
                            <td><?php echo h($agency['Agency']['email']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $agency['Agency']['id'], 'ajax'=>true), array('class'=>'modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                                <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('action' => 'edit', $agency['Agency']['id'], 'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                                <?php echo $this->Form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-times"></i></button>', array('action' => 'delete', $agency['Agency']['id']), array('escape'=>false), __('Are you sure you want to delete %s?', $agency['Agency']['name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th><?php echo __('Code'); ?></th>
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Phone'); ?></th>
                        <th><?php echo __('Fax'); ?></th>
                        <th><?php echo __('Email'); ?></th>
                        <th><?php echo __('Actions'); ?></th>
                    </tr>
                    </tfoot>
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
        $('.active-switcher').switcher({
            on_state_content: 'ON',
            off_state_content: 'OFF'
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
