<?
Configure::write('debug', 2);
//debug($prepayment); return;

?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Prepayment', array('class'=>'panel form-horizontal validate_form')); ?>

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('更新預支款項'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <?echo $this->Form->input('id', array('value'=>$prepayment['Prepayment']['id']));?>
        <?echo $this->Form->hidden('financialbudget_id', array('value'=>$prepayment['Prepayment']['financialbudget_id']));?>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('date', __('預支日期'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?
                    echo $this->Form->input("date", array(
                            'value'=>$prepayment['Prepayment']['date'],
                            'label'=>false,
                            'div'=>false,
                            'type'=>'text',
                            'class'=>'form-control datepicker',
                            'placeholder'=>__('yyyy-mm-dd'),
                            'required'=>true
                        )
                    );
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('amount', __('預支金額'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?
                    echo $this->Form->input("amount", array(
                            'value'=>$prepayment['Prepayment']['amount'],
                            'label'=>false,
                            'div'=>false,
                            'type'=>'text',
                            'class'=>'form-control vd_isnumber',
                            'placeholder'=>'',
                            'required'=>true
                        )
                    );
                    ?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('cheque_no', __('支票號碼'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?
                    echo $this->Form->input("cheque_no", array(
                            'value'=>$prepayment['Prepayment']['cheque_no'],
                            'label'=>false,
                            'div'=>false,
                            'type'=>'text',
                            'class'=>'form-control',
                            'placeholder'=>'',
                            'required'=>true
                        )
                    );
                    ?>
                </div>
            </div> <!-- / .form-group -->

        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $( document ).ready(function() {
        validate_form();
    });
</script>