<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		:: <?php echo utf8_encode('Consulta P�blica'); ?> ::
	</title>
	<?php
		echo $this->Html->css('cake.generic');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">

		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">
			Desenvolvido por Anderson V.
		</div>
	</div>
</body>
</html>