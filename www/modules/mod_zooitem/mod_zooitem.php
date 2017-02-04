<?php
/**
* @package   ZOO Item Module
* @file      mod_zooitem.php
* @version   2.0.0 May 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2010 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// load config
require_once(JPATH_ADMINISTRATOR.'/components/com_zoo/config.php');

$items = ZooModuleHelper::getItems($params);

// load template
if (count($items)) {

	// set renderer
	$renderer = new ItemRenderer();
	$renderer->addPath(array(dirname(__FILE__), ZOO_SITE_PATH));

	include(JModuleHelper::getLayoutPath('mod_zooitem', $params->get('theme', 'list-v')));
}