<?php defined('_JEXEC') or die('Restricted access'); 

JTable::addIncludePath(JPATH_ROOT.DS.'components'.DS.'com_visittracer'.DS.'tables');

echo('<link rel="stylesheet" href="' . JURI::base() . '/administrator/components/com_menus/assets/type.css" type="text/css" />');

$db = & JFactory::getDBO();
$user = & JFactory::getUser();

$exclusion_list = array();

$query = "SELECT id, name, link, parent FROM #__menu WHERE published = 1 AND menutype = 'mainmenu' ORDER BY parent, ordering";
$db->setQuery($query);

echo('<ul class="jtree" id="menu-item">');
foreach($db->loadAssocList() as $item){
	$query = "
		SELECT
		v.menu, v.desc, v.link, s.title as nome_secao, cat.title as nome_categoria, co.title as nome_conteudo
		FROM #__visittracer v 
		INNER JOIN #__menu m ON m.id = v.menu
		LEFT OUTER JOIN #__sections s ON s.id = v.secao
		LEFT OUTER JOIN #__categories cat ON cat.id = v.categoria
		LEFT OUTER JOIN #__content co ON co.id = v.conteudo
		WHERE v.menu = " . $item['id'] . "
		OR m.parent = " . $item['id'] . "
		ORDER BY m.ordering, s.ordering, cat.ordering, co.ordering
		";
	$db->setQuery($query);
	$result = $db->loadAssocList();
	
	if(count($result)>0){
		if(!array_search($item['id'], $exclusion_list)){
			echo('<li id="internal-node"><div class="node-open"><span></span><a href="' . $item['link'] . '">' . $item['name'] . '</a></div></li>');
			$exclusion_list[] = $item['id'];
		}
		echo('<ul>');
		foreach($result as $subitem){
			if($subitem['menu'] != $item['id']){
				if(!array_search($subitem['menu'], $exclusion_list)){
					echo('<li><div class="node-open"><span></span><a href="' . $subitem['link'] . '">' . $subitem['desc'] . '</a></div></li>');
					$exclusion_list[] = $subitem['menu'];
				}
				else{
					echo('<ul>');
					echo('<li><div class="node-open"><span></span><a href="' . $subitem['link'] . '">' . $subitem['nome_secao'] . " | " . $subitem['nome_categoria'] . " | " . $subitem['nome_conteudo'] . '</a></div></li>');
					echo('</ul>');
				}
			}
		}
		echo('</ul>');
	}
}
echo('</ul>');