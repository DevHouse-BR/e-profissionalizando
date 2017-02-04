<?php echo $this->Form->create('ClientsCourse');?>
	<fieldset>
 		<legend><?php echo 'Gerar certificado'; ?></legend>
	<?php
		echo '<br /><br /><h2>Aluno: <b>'.$nome['Client']['nome'].'</b></h2>';
		echo $this->Form->input('course_id', array('label' => 'Curso'));
		// echo $this->Form->input('client_id');
	?>
		<input name="data[ClientsCourse][client_id]" id="ClientsCourseClientId" type="hidden" value="<?php echo $nome['Client']['id']; ?>">
	<?php
		echo $this->Form->input('conclusao');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>