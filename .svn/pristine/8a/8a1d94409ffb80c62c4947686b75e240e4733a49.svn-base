<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Member', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="panel-heading">
            <span class="panel-title">學生資料確認 - <?=$member['Member']['c_name']?> (<?=$member['Member']['e_name']?>)</span>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>


            <div class="form-group">
                <?php echo $this->Form->label('Level', "設定學生的等級", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Level', array('div'=>false, 'options'=>$levels,'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'Select a Member Level', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('lastestindate', "設定最新入住日期 (計算等級用)", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('lastestindate', array('type' => 'text', 'div'=>false, 'label'=>false, 'class'=>'datepickercus form-control', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <?php
                    echo $this->Form->unlockField('active');
                    echo $this->Form->hidden('active', array('value'=>0));
                    ?>
                    <div class="checkbox">
                        <label>
                            <?php echo $this->Form->input('active', array('div'=>false, 'class'=>'px', 'type'=>'checkbox', 'label'=>false, 'hiddenField'=>false));?>
                            <span class="lbl">住院中</span>
                        </label>
                    </div>
                </div>
                </div> <!-- / .form-group -->
            <?php echo $this->Form->hidden('checked', array('value' => '1'));?>

        </div>
        <div class="panel-footer text-right">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-remove-sign"></i> '.__('Cancel'), array('action'=>'index'), array('escape'=>false, 'class'=>'btn btn-primary')); ?>
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });
        validate_form();

        $(".datepickercus").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });

</script>