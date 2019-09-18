
<div class="row">
	<div class="col-sm-12">
		<?php echo $this->Form->create('Customlayout', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
		<div class="modal-header">
			<h3 class="modal-title">
				新增 <p class="label label-info"><?=$field['Customfield']['alias']?></p> 至 <?=$type['Dbmodel']['oname']?> - <?=$type['Customtype']['type_oname']?>
				<button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</h3>
		</div>
		<?php echo $this->Form->hidden('model_id',array('value'=>$type['Dbmodel']['id']))?>
		<?php echo $this->Form->hidden('type_id',array('value'=>$type['Customtype']['id']))?>
		<?php echo $this->Form->hidden('field_id',array('value'=>$field['Customfield']['id']))?>


		<div class="modal-body">

			<div class="form-group">
				<?php echo $this->Form->label('default', __('default'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('default', array('div'=>false, 'label'=>false,'class'=>'form-control','value'=>$field['Customfield']['default'] ));?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('placeholder', __('placeholder'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('placeholder', array('div'=>false, 'label'=>false,'class'=>'form-control', 'value'=>$field['Customfield']['placeholder']));?>
				</div>
			</div>

            <div class="form-group">
                <?php echo $this->Form->label('div_class', __('div class *'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('div_class', array('div'=>false, 'label'=>false,'class'=>'form-control', 'required'=>'required', 'value'=>$field['Customfield']['default_div_class']));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('customgroup_id', __('cus group'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('customgroup_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2-modal', 'options'=>$group, 'empty'=>true));?>
                </div>
            </div>

        </div>
		<div class="modal-footer text-right">
			<button type="submit" class="btn btn-primary" ><? echo ' '.__('Submit');?></button>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>


<script>

	$(document).ready(function() {
		validate_form();

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $(".select2-modal").select2({
            dropdownParent: $("#modal"),
            placeholder: "請選擇",
            allowClear : true
        });

	});
</script>
