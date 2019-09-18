<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Backupsetting', array('class'=>'panel form-horizontal validate_form')); ?>
        <div class="panel-heading">
            <span class="panel-title"><?php echo __('Backup Setting'); ?></span>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->hidden('id', array('class' => 'span12')); ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <?php echo $this->Form->input('daily', array('div'=>false, 'class'=>'px', 'type'=>'checkbox', 'label'=>false));?>
                            <span class="lbl"><?=__('Daily')?></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <?php echo $this->Form->input('weekly', array('div'=>false, 'class'=>'px', 'type'=>'checkbox', 'label'=>false));?>
                            <span class="lbl"><?=__('Weekly')?></span>
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer text-right">
            <?=$this->Form->button('<i class="glyphicon glyphicon-ok-sign"></i> '.__('Submit'), array('class'=>'btn btn-primary', 'type'=>'submit', 'escape'=>false))?>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
</div>