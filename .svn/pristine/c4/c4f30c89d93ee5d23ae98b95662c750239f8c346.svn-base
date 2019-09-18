
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Dbfield', array('class'=>'form-horizontal validate_form')); ?>

        <div class="modal-header">
            <span class="panel-title"><?=__('更新Field')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body">
            <?php echo $this->Form->hidden('id'); ?>
            <?php echo $this->Form->hidden('model_id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('db_field', __('db_field'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('db_field', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'db_field', 'required'=>'required'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('oname', __('oname'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('oname', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'oname' , 'required'=>'required'));?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $this->Form->label('type', __('type'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('type', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'type' , 'required'=>'required'));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('length', __('length'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('length', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'length' ));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('is_dropdown', __('is_dropdown'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('is_dropdown', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('is_date', __('is_date'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('is_date', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('is_time', __('is_time'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('is_time', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('required', __('required'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('required', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('can_filter', __('can filter'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('can_filter', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('default_filter', __('default filter'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('default_filter', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('log', __('log'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('log', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('hidden', __('hidden'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('hidden', array('div'=>false, 'label'=>false, 'class'=>'form-control '));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('cus_id', __('cus_id'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cus_id', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'cus_id' ));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('cus_class', __('cus_class'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cus_class', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'cus_class' ));?>
                </div>
            </div>

            <?if($this->request->data['Dbfield']['is_dropdown']){
                $dropdown[] = null;
                foreach($this->request->data['Dbfielddropdown'] as $item){
                    $dropdown[$item['value']] = $item['oname'];
                }
                ?>
            <div class="form-group">
                <?php echo $this->Form->label('default_value', __('default'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('default_value', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'options'=>$dropdown,'placeholder'=>'default_value' ));?>
                </div>
            </div>

            <?}else{?>
                <div class="form-group">
                    <?php echo $this->Form->label('default_value', __('default'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('default_value', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'default_value' ));?>
                    </div>
                </div>


            <?}?>

            <div class="form-group">
                <?php echo $this->Form->label('associated_model', __('asso. Model'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('associated_model', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'associated_model' ));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('associated_model_ref', __('asso. Model ref'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('associated_model_ref', array('div'=>false, 'label'=>false, 'class'=>'form-control ', 'placeholder'=>'associated_model_ref' ));?>
                </div>
            </div>




        </div>
        <div class="modal-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<script>
    $( document ).ready(function() {

    });
</script>
