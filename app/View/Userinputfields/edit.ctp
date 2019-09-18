<div class="userinputfields form">
<?php echo $this->Form->create('Userinputfield'); ?>
	<fieldset>
		<legend><?php echo __('Edit Userinputfield'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('inputtype_id');
		echo $this->Form->input('selectionlist_id');
		echo $this->Form->input('group');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Userinputfield.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Userinputfield.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Userinputfields'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Inputtypes'), array('controller' => 'inputtypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inputtype'), array('controller' => 'inputtypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Selectionlists'), array('controller' => 'selectionlists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Selectionlist'), array('controller' => 'selectionlists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
