<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemVisitTracer extends JPlugin {
	function __construct( &$subject, $config ){
		parent::__construct( $subject, $config );
	}
	function onAfterRender(){
		$db 		= & JFactory::getDBO();
		$user		= & JFactory::getUser();
		
		$app = JFactory::getApplication();
        if($app->isAdmin()) return;
					
		$itemId = JRequest::getVar( 'Itemid', JRequest::getVar( 'Itemid', '0', 'post', 'int' ), 'get', 'int' );
		$menu =& JTable::getInstance('menu');
        $menu->load($itemId);
		
		$section->id = 0;
		$category->id = 0;
		$article->id = 0;
		
		$option = JRequest::getVar( 'option' );
		if($option == 'com_content'){
			$view = JRequest::getVar( 'view', JRequest::getVar( 'view', '0', 'post', 'string' ), 'get', 'string' ) ;
			$id = JRequest::getVar( 'id', JRequest::getVar( 'id', '0', 'post', 'int' ), 'get', 'int' ) ;
			if($view == 'section'){
				$section =& JTable::getInstance('section');
				$section->load($id);
			}
			elseif($view == 'category'){
				$category =& JTable::getInstance('category');
				$category->load($id);

				$section =& JTable::getInstance('section');
				$section->load($category->section);
			}
			elseif($view == 'article'){
				$article =& JTable::getInstance('content');
				$article->load($id);
				
				$category =& JTable::getInstance('category');
				$category->load($article->catid);

				$section =& JTable::getInstance('section');
				$section->load($article->sectionid);
			}
		}
		
		JTable::addIncludePath(JPATH_ROOT.DS.'components'.DS.'com_visittracer'.DS.'tables');
		$registro = JTable::getInstance('visittracer', 'Table');
		
		$dados = array(
			'id' => 0,
			'usuario' => JFactory::getUser()->id,
			'data' => date('Y-m-d H:i:s'),
			'menu' => $menu->id,
			'secao' => $section->id,
			'categoria' => $category->id,
			'conteudo' => $article->id,
			'desc' => $menu->name,
			'link' => $_SERVER["REQUEST_URI"]
		);
		
		$query = "
		  SELECT *
			FROM #__visittracer
			WHERE usuario = " . $dados['usuario'] . "
			AND menu = " . $dados['menu'] . "
			AND secao = " . $dados['secao'] . "
			AND categoria = " . $dados['categoria'] . "
			AND conteudo = " . $dados['conteudo'];
		$db->setQuery($query);
		$resultado = $db->loadAssocList();
		
		if(count($resultado) > 0){
			$dados = $resultado[0];
			$dados['data'] = date('Y-m-d H:i:s');
		}
		
		if (!$registro->bind($dados)) {
			return JError::raiseWarning( 500, $registro->getError() );
		}
		
		if (!$registro->store()) {
			JError::raiseError( 500, $registro->getError() );
		}
	}
}