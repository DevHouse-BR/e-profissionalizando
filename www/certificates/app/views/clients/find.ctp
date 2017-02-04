

<?php echo $this->Form->create('Clients',array('type' => 'post'));?>
	<fieldset>
 		<legend><?php __('Gerar certificado'); ?></legend>
	<?php
		echo $this->Form->input('nome');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo 'Nome';?></th>
		<th><?php echo 'Endereco';?></th>
		<th><?php echo 'Email';?></th>
		<th><?php echo utf8_encode('Ações');?></th>
	</tr>

<?php foreach($dados as $value) { ?>
	<tr>
		<td><?php echo $value['clients']['nome']; ?>&nbsp;</td>
		<td><?php echo $value['clients']['endereco']; ?>&nbsp;</td>
		<td><?php echo $value['clients']['email']; ?>&nbsp;</td>
		<td class="actions"> <?php echo $this->Html->link(__('Gerar certificado', true), array('action' => '../clients_courses/add', $value['clients']['id'])); ?> </td>
	</tr>
<?php } ?>
</table>