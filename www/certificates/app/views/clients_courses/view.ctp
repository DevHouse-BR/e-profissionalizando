<div class="clientsCourses view">
<h2><?php  __('Clients Course');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clientsCourse['ClientsCourse']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Course'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clientsCourse['Course']['id'], array('controller' => 'courses', 'action' => 'view', $clientsCourse['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Client'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clientsCourse['Client']['id'], array('controller' => 'clients', 'action' => 'view', $clientsCourse['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Conclusao'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clientsCourse['ClientsCourse']['conclusao']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Clients Course', true), array('action' => 'edit', $clientsCourse['ClientsCourse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Clients Course', true), array('action' => 'delete', $clientsCourse['ClientsCourse']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $clientsCourse['ClientsCourse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients Courses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clients Course', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course', true), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
