<div class="clientsCourses form">
<?php echo $this->Form->create('ClientsCourse');?>
	<fieldset>
 		<legend><?php __('Edit Clients Course'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('course_id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('conclusao');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ClientsCourse.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ClientsCourse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Clients Courses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course', true), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>