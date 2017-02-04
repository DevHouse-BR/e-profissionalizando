<?php echo $this->Form->create('Course',array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Adicionar Curso'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('carga');
		echo $this->Form->input('valor');
		echo $this->Form->input('imagem', array('type' => 'file'));
		echo $this->Form->input('dir', array('type' => 'hidden'));
		echo $this->Form->input('mimetype', array('type' => 'hidden'));
		echo $this->Form->input('filesize', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>

