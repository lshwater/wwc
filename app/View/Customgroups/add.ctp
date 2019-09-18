
<div class="row">
	<div class="col-sm-12">
		<?php echo $this->Form->create('Customgroup', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
		<div class="modal-header">
			<h3 class="modal-title">
				Add Group
				<button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</h3>
		</div>
		<?php echo $this->Form->hidden('type_id',array('value'=>$type_id))?>


		<div class="modal-body">

			<div class="form-group">
				<?php echo $this->Form->label('display_name', __('Name'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('display_name', array('div'=>false, 'label'=>false,'class'=>'form-control', 'required'=>'required' ));?>
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

	});
</script>
