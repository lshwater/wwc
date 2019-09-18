<div class="userinputfields index">
	<h2><?php echo __('Userinputfields'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('inputtype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('selectionlist_id'); ?></th>
			<th><?php echo $this->Paginator->sort('group'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($userinputfields as $userinputfield): ?>
	<tr>
		<td><?php echo h($userinputfield['Userinputfield']['id']); ?>&nbsp;</td>
		<td><?php echo h($userinputfield['Userinputfield']['title']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userinputfield['Inputtype']['id'], array('controller' => 'inputtypes', 'action' => 'view', $userinputfield['Inputtype']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userinputfield['Selectionlist']['id'], array('controller' => 'selectionlists', 'action' => 'view', $userinputfield['Selectionlist']['id'])); ?>
		</td>
		<td><?php echo h($userinputfield['Userinputfield']['group']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userinputfield['Userinputfield']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userinputfield['Userinputfield']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userinputfield['Userinputfield']['id']), array(), __('Are you sure you want to delete # %s?', $userinputfield['Userinputfield']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Userinputfield'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inputtypes'), array('controller' => 'inputtypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inputtype'), array('controller' => 'inputtypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Selectionlists'), array('controller' => 'selectionlists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Selectionlist'), array('controller' => 'selectionlists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
