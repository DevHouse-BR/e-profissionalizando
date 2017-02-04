<div class="courses form">
<?php echo $this->Form->create('Course');?>
	<fieldset>
 		<legend><?php __('Edit Course'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('carga');
		echo $this->Form->input('valor');
		echo $this->Form->input('imagem');
		echo $this->Form->input('Client');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Course.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Course.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>