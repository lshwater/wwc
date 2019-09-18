<div class="userloginlogs view">
<h2><?php echo __('Userloginlog'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userloginlog['Userloginlog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userloginlog['User']['id'], array('controller' => 'users', 'action' => 'view', $userloginlog['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userloginlog['Userloginlog']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userloginlog'), array('action' => 'edit', $userloginlog['Userloginlog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userloginlog'), array('action' => 'delete', $userloginlog['Userloginlog']['id']), array(), __('Are you sure you want to delete # %s?', $userloginlog['Userloginlog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userloginlogs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userloginlog'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
