<div class="row">
    <div class="col-sm-12">
        <div class="modal-header">
            <h2>
                <?php echo __('Parameters'); ?> - <?php echo h($model_name); ?>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </h2>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <?foreach($key_list as $key){?>
                        <th><?php echo $this->Paginator->sort($key, __($key)); ?></th>
                    <?}?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($para_list as $para): ?>
                    <tr>
                        <?foreach($key_list as $key){?>
                            <td><?php echo h($para[$model][$key]); ?>&nbsp;</td>
                        <?}?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>