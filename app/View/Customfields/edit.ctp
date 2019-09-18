
<div class="row">
	<div class="col-sm-12">
		<?php echo $this->Form->create('Customfield', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
		<div class="modal-header">
			<h3 class="modal-title  ">
				<?=__("Update")?>
				<button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</h3>
		</div>
		<?php echo $this->Form->hidden('id'); ?>
		<?php echo $this->Form->hidden('type_id'); ?>

		<div class="modal-body">

            <div class="form-group">
                <?php echo $this->Form->label('type', __('type')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">

                    <?php echo $this->Form->input('type', array('div'=>false, 'label'=>false,'class'=>'form-control','options'=>$type ,"required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

			<div class="form-group">
				<?php echo $this->Form->label('alias', __('alias')."*", 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('alias', array('div'=>false, 'label'=>false,'class'=>'form-control' ,"required"=>"required"));?>
				</div>
			</div> <!-- / .form-group -->

			<div class="form-group">
				<?php echo $this->Form->label('label', __('label'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('label', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
				</div>
			</div> <!-- / .form-group -->

			<div class="form-group">
				<?
				$options2 = array(
						0=>'No',
						1=>'Yes'
				);
				?>
				<?php echo $this->Form->label('required', __('required'), 'col-sm-2 control-label'); ?>
				<div class="col-sm-10">
					<?php echo $this->Form->input('required', array('div'=>false, 'label'=>false,'class'=>'form-control','options'=>$options2 ,"required"=>"required"));?>
				</div>
			</div> <!-- / .form-group -->

			<?if($this->request->data['Customfield']['type'] == "select"){?>
				<div class="form-group">
					<?php echo $this->Form->label('multiple', __('multiple'), 'col-sm-2 control-label'); ?>
					<div class="col-sm-10">
						<?php echo $this->Form->input('multiple', array('div'=>false, 'label'=>false,'options'=>array(0=>'No',1=>'Yes'),'class'=>'form-control', 'value'=>$multiple));?>
					</div>
				</div>
			<?}?>
				<div class="form-group">
					<?php echo $this->Form->label('default', __('default'), 'col-sm-2 control-label'); ?>
					<div class="col-sm-10">
						<?php echo $this->Form->input('default', array('div'=>false, 'label'=>false,'class'=>'form-control' ));?>
					</div>
				</div>

            <div class="form-group">
                <?php echo $this->Form->label('can_filter', __('can filter'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('can_filter', array('div'=>false, 'label'=>false,'class'=>'form-control' ));?>
                </div>
            </div>


<!--			--><?//}?>

                <div class="form-group">
                    <?php echo $this->Form->label('placeholder', __('placeholder'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('placeholder', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
                    </div>
                </div>
<!---->
            <div class="form-group">
                <?php echo $this->Form->label('default_div_class', __('div class'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('default_div_class', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
                </div>
            </div>


		</div>
		<div class="modal-footer text-right">
			<button type="submit" class="btn btn-primary" ><? echo ' '.__('Submit');?></button>
		</div>
		<?php echo $this->Form->end(); ?>


		<?if($this->request->data['Customfield']['type'] == "select"){

			if(!empty($select_item)){
				echo '<div class="modal-body">';
				echo '<div class="row">';
				echo "<label class='col-sm-2'>Options:</label>";
				echo '<div class="col-sm-10">';
				foreach($select_item as $k=>$item){?>
					<label><?=$item['Customfield']['label']?></label>
					<?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-arrow-up"></i></button>', array('controller'=>'Customfields','action' => 'moveup', $item['Customfield']['id']), array('escape'=>false));  ?>
					<?php echo $this->Html->link('<button class="btn btn-sm btn-success" style="width: 30px;"><i class="fa fa-arrow-down"></i></button>', array('controller'=>'Customfields','action' => 'movedown', $item['Customfield']['id']), array('escape'=>false));  ?>
					<?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $item['Customfield']['id']), array('class' => 'btn btn-sm btn-danger', 'escape' => false), __('確定刪除嗎?'));?>

					<br>

					<!-- / .form-group -->
				<?}
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
		}?>
	</div>
</div>


<script>

	$(document).ready(function() {
		validate_form();

	});
</script>
