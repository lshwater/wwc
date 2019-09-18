<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-database page-header-icon"></i>&nbsp;&nbsp;<?php echo __('Backup Records'); ?></h1>
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
                        <th><?php echo $this->Paginator->sort('date', __('Date')); ?></th>
                        <th><?php echo $this->Paginator->sort('filesize', __('Filesize')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($backuprecords as $backuprecord):
                        $numDays = floor(abs(time() - strtotime($backuprecord['Backuprecord']['created']))/60/60/24);
                        ?>
                        <tr>
                            <td><?php echo h($backuprecord['Backuprecord']['created'])." (".$numDays.__('Before').")"; ?>&nbsp;</td>
                            <td><?php echo h($backuprecord['Backuprecord']['filesize']); ?>&nbsp;</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th><?php echo __('Date'); ?></th>
                        <th><?php echo __('Filesize'); ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
