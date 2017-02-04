<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		:: Gerenciador de certificados :: v1.0 ::
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>:: Gerenciador de certificados :: v1.0 ::</h1>
		</div>
		<div id="content">
			<div id="menu">
				<ul id="menu_">
					<li><?php echo $html->link('Adicionar novo curso','/courses/add'); ?></li>
					<li><?php echo $html->link('Adicionar novo cliente','/clients/add'); ?></li>
					<li><?php echo $html->link('Gerar certificado','/clients/find'); ?></li>
					<li><?php echo $html->link('Consultar dados','/clients_courses/find'); ?></li>
					<li><?php echo $html->link('Relatorios','/clients_courses/report'); ?></li>
					<li><?php echo $html->link('Logout','/users/logout'); ?></li>
				</ul>
			</div>

			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			Desenvolvido por Anderson V.
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>