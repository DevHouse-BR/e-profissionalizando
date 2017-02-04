<?php

defined('_JEXEC') or die();

class TableVisitTracer extends JTable
{
		var $id = 0;
		var $usuario = 0;
		var $data = 0;
		var $menu = 0;
		var $secao = 0;
		var $categoria = 0;
		var $conteudo = 0;
		var $desc = null;
		var $link = null;
        
        function __construct(&$db)
        {
			parent::__construct( '#__visittracer', 'id', $db );
        }
}
