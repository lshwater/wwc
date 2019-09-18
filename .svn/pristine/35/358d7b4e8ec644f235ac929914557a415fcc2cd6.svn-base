<div class="panel">
    <div class="panel-heading">
        <h2>
            <?php echo h($agency['Agency']['name']); ?>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-5">
                </colgroup>
                <thead>
                <tr>
                    <th><?php echo __('table_content'); ?></th>
                    <th><?php echo __('table_details'); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo __('Code'); ?></td>
                    <td><?php echo h($agency['Agency']['code']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Name'); ?></td>
                    <td><?php echo h($agency['Agency']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Address'); ?></td>
                    <td><?php echo h($agency['Agency']['address']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Phone'); ?></td>
                    <td><?php echo h($agency['Agency']['phone']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Fax'); ?></td>
                    <td><?php echo h($agency['Agency']['fax']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Email'); ?></td>
                    <td><?php echo h($agency['Agency']['email']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Remark'); ?></td>
                    <td><?php echo h($agency['Agency']['remark']); ?>&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modaloff" >
    <div class="row" >
        <div class="col-sm-12">
            <?php echo $this->Html->link('<span class="btn-primary"></span>'.__('Edit Agency'), array('action' => 'edit', $agency['Agency']['id']), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
        </div>
    </div>

    <h2><?php echo __('Related Units'); ?></h2>
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
                        <?php foreach ($agency['Unit'] as $unit): ?>
                            <tr>
                                <td><?php echo $unit['code']; ?></td>
                                <td><?php echo $unit['name']; ?></td>
                                <td><?php echo $unit['phone']; ?></td>
                                <td><?php echo $unit['fax']; ?></td>
                                <td><?php echo $unit['email']; ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('controller' => 'units', 'action' => 'view', $unit['id']), array('class'=>'', 'escape'=>false)); ?>
                                    <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('controller' => 'units', 'action' => 'edit', $unit['id']), array('class'=>'', 'escape'=>false)); ?>
                                    <?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'units', 'action' => 'delete', $unit['id']), array(), __('Are you sure you want to delete # %s?', $unit['id'])); ?>
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

    <div class="row">
        <div class="col-sm-12">
            <?php echo $this->Html->link('<span class="btn-label icon fa fa-plus"></span>'.__('New Unit'), array('controller' => 'units', 'action' => 'add'), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
        </div>
    </div>
</div>
