<h2><?php echo utf8_encode("Bem-vindo! Efetue o seu login para começar."); ?></h2>
<?php
$session->Flash('auth'); // Exibimos qualquer erro que possa ter ocorrido
echo $form->create('User' , array('action' => 'login'));
echo $form->input('username', array('label' => 'Usuario'));
echo $form->input('password', array('label' => 'Senha'));
echo $form->end('Entrar');
?>