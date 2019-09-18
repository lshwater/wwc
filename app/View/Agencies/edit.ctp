
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Agency', array('class'=>'panel form-horizontal validate_form')); ?>

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('Edit Agency'); ?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('code', __('Code'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('code', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_code', 'placeholder'=>'Code', 'id'=>'code'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('name', __('Name'), 'col-sm-2 control-label vd_name'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'Name'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('address', __('Address'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_address', 'placeholder'=>'Address'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('phone', __('Phone'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_phone', 'placeholder'=>__('Phone')));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('fax', __('Fax'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('fax', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_phone', 'placeholder'=> __('Fax')));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('email', __('Email'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_email', 'placeholder'=>'Email'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('remark', __('Remark'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remark', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Remark'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<script>
    $( document ).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });

        validate_form();

        $.validator.addClassRules("vd_code", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'code',
                    value: function() {
                        return $("#code").val();
                    },
                    recordid: '<?=$this->data['Agency']['id']?>'
                }
            }
        });
    });
</script>
