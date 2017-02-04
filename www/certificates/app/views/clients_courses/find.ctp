

<?php echo $this->Form->create('Clients_courses',array('type' => 'post'));?>
	<fieldset>
 		<legend><?php __('Consultar dados'); ?></legend>
	<div class="input text">
		<label for="Clients_coursesStr">buscar por:</label>
		<select name="data[Clients_courses][field]" >
		  <option value="nome">Nome</option>
		  <option value="email">E-mail</option>
		  <option value="endereco">Endereco</option>
		</select>
	</div>
	<?php
		echo $this->Form->input('str',array('label' => 'Busca'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>










<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo 'Nome';?></th>
		<th><?php echo 'Endereco';?></th>
		<th><?php echo 'Email';?></th>
		<th class="actions"><?php __('Acoes');?></th>
	</tr>

<?php foreach($dados as $value) { ?>
	<tr>
		<td><?php echo $value['clients']['nome']; ?>&nbsp;</td>
		<td><?php echo $value['clients']['endereco']; ?>&nbsp;</td>
		<td><?php echo $value['clients']['email']; ?>&nbsp;</td>
		<td class="actions"> <?php echo $this->Html->link(__('Detalhes', true), array('action' => '../clients/view', $value['clients']['id'])); ?> </td>
	</tr>
<?php } ?>
</table>