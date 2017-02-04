<?php echo $this->Form->create('Client');?>
	<fieldset>
 		<legend><?php __('Adicionar cliente'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('endereco');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>