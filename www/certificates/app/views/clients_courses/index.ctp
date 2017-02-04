	<h2><?php __('Consultando dados');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Curso');?></th>
			<th><?php echo $this->Paginator->sort('Cliente');?></th>
			<th><?php echo $this->Paginator->sort('Data de conclusao');?></th>
			<th class="actions"><?php __('Acoes');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($clientsCourses as $clientsCourse):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($clientsCourse['Course']['nome'], array('controller' => 'courses', 'action' => 'view', $clientsCourse['Course']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientsCourse['Client']['nome'], array('controller' => 'clients', 'action' => 'view', $clientsCourse['Client']['id'])); ?>
		</td>
		<td><?php echo $clientsCourse['ClientsCourse']['conclusao']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $clientsCourse['ClientsCourse']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $clientsCourse['ClientsCourse']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $clientsCourse['ClientsCourse']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $clientsCourse['ClientsCourse']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>