<div class="userinputfields view">
<h2><?php echo __('Userinputfield'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userinputfield['Userinputfield']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($userinputfield['Userinputfield']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inputtype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userinputfield['Inputtype']['id'], array('controller' => 'inputtypes', 'action' => 'view', $userinputfield['Inputtype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Selectionlist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userinputfield['Selectionlist']['id'], array('controller' => 'selectionlists', 'action' => 'view', $userinputfield['Selectionlist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo h($userinputfield['Userinputfield']['group']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userinputfield'), array('action' => 'edit', $userinputfield['Userinputfield']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userinputfield'), array('action' => 'delete', $userinputfield['Userinputfield']['id']), array(), __('Are you sure you want to delete # %s?', $userinputfield['Userinputfield']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userinputfields'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userinputfield'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inputtypes'), array('controller' => 'inputtypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inputtype'), array('controller' => 'inputtypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Selectionlists'), array('controller' => 'selectionlists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Selectionlist'), array('controller' => 'selectionlists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($userinputfield['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userinputfield['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['code']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['active']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
