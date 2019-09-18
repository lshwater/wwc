
<div class="row">
	<div class="col-sm-12">
		<?php echo $this->Form->create('Dynamicmodel', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
		<div class="modal-header">
			<h2>
				<?=__("Copy to..")?>
				<button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</h2>
		</div>

		<div class="modal-body">
			<div class="form-group">
				<?php echo $this->Form->label('name', __('name')."*", 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control' ,"required"=>"required"));?>
				</div>
			</div> <!-- / .form-group -->

			<div class="form-group">
				<?php echo $this->Form->label('code', __('code')."*", 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('code', array('div'=>false, 'label'=>false,'class'=>'form-control' ,"required"=>"required"));?>
				</div>
			</div> <!-- / .form-group -->


			<div class="form-group">
				<?php echo $this->Form->label('description', __('description'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('description', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
				</div>
			</div> <!-- / .form-group -->
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

	});
</script>
