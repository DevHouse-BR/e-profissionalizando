<?php
class UsersController extends AppController {
	var $name = 'Users';
	var $layout = 'admin';
	var $scaffold;
	var $components = array('Auth');

	function area_restrita(){

	}

	function login(){
		
	}

	function logout(){
	$this->redirect($this->Auth->logout()); // Efetuamos logout
	}
}
?>