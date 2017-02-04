<h2><?php  __('Cliente');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Endereco'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['endereco']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Editar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link(__('Editar Cliente', true), array('action' => 'edit', $client['Client']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
<br /><br />
<div class="related">
	<h3><?php __('Cursos feitos por ');?> <b><?php echo $client['Client']['nome']; ?></b></h3>
	<?php if (!empty($client['Course'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Nome'); ?></th>
		<th><?php __('Carga'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Acoes'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['Course'] as $course):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $course['nome'];?></td>
			<td><?php echo $course['carga'];?></td>
			<td><?php echo $course['valor'];?></td>
			<td><?php echo $this->Html->link(__('Reimprimir certificado', true), array('action' => '../clients_courses/adding', $client['Client']['id'], $course['id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
