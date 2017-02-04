<?php
class AppController extends Controller {

	var $name = 'App';
	
	function beforeFilter(){
		$this->Auth->allow(array('consult','adding','viewPdf'));
		Security::setHash('sha256'); // Setamos o algoritmo que iremos utilizar, o padrão é sha1
	}
}
?>