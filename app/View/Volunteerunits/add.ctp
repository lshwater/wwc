<div class="panel">
    <div class="panel-heading">
        <h2>
            新增義工機構
        </h2>
    </div>
    <?php echo $this->Form->create('Volunteerunit', array('class'=>'form-horizontal validate_form')); ?>
    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('name', __('機構名稱*'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('name', array('div' => false, 'label' => false, 'class' => 'form-control volname', 'required' => 'required', 'placeholder'=>'機構名稱', "id"=>"volname")); ?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('contactname', __('聯絡人'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('contactname', array('div' => false, 'label' => false, 'class' => 'form-control ', 'placeholder'=>'聯絡人')); ?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('contacttel', __('聯絡電話'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('contacttel', array('div' => false, 'label' => false, 'class' => 'form-control vd_phone', 'placeholder'=>'聯絡電話')); ?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('email', __('聯絡電郵'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('email', array('div' => false, 'label' => false, 'class' => 'form-control vd_email',  'placeholder'=>'聯絡電郵')); ?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('remarks', __('備註'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('remarks', array('div' => false, 'label' => false, 'class' => 'form-control ',  'placeholder'=>'備註')); ?>
            </div>
        </div> <!-- / .form-group -->

    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('新增');?></button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script>
    $(document).ready(function() {
        validate_form();

        $.validator.addClassRules("volname", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'name',
                    value: function() {
                        return $("#volname").val();
                    }
                }
            }
        });


    });
</script>


