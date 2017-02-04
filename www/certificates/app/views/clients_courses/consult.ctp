<?php if(isset($dados)){ ?>
	<h2><?php echo utf8_encode('Certificado válido'); ?></h2>
	<p>Nome: <strong><?php echo $dados['Client']['nome']; ?></strong></p><br />
	<p><?php echo utf8_encode('Concluído em') ?> <strong><?php echo $formatacao->data($dados['ClientsCourse']['conclusao']); ?></strong></p><br />
	<p>Curso de <strong><?php echo $dados['Course']['nome']; ?></strong></p><br />
	<?php echo $this->Html->link(__('Imprimir certificado', true), array('action' => 'adding', $dados['Client']['id'], $dados['Course']['id'])); ?>
	<br /><br /><br /><br />
	<h3><?php echo $this->Html->link(__('Fazer nova busca', true), array('action' => 'consult')); ?></h3>
<?php } else { ?>
	<?php echo $this->Form->create('ClientsCourse');?>
		<fieldset>
			<legend><?php echo 'Consulta de certificados'; ?></legend>
			<?php echo $this->Form->input('codigo'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Consultar', true));?>
<?php } ?>