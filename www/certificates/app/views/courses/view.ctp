<div class="courses view">
<h2><?php  __('Course');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Carga'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['carga']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['valor']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['imagem']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course', true), array('action' => 'edit', $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Course', true), array('action' => 'delete', $course['Course']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Clients');?></h3>
	<?php if (!empty($course['Client'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nome'); ?></th>
		<th><?php __('Endereco'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Conclusao'); ?></th>
		<th><?php __('Envio'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($course['Client'] as $client):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $client['id'];?></td>
			<td><?php echo $client['nome'];?></td>
			<td><?php echo $client['endereco'];?></td>
			<td><?php echo $client['email'];?></td>
			<td><?php echo $client['conclusao'];?></td>
			<td><?php echo $client['envio'];?></td>
			<td><?php echo $client['created'];?></td>
			<td><?php echo $client['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'clients', 'action' => 'view', $client['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'clients', 'action' => 'edit', $client['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'clients', 'action' => 'delete', $client['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $client['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
