<?php
/**
* @package   Warp Theme Framework
* @file      preset.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

class JElementPreset extends JElement {

	var	$_name = 'Preset';

	function fetchElement($name, $value, &$node, $control_name) {
		
		// load config
		require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
        
		return $warp->template->render('admin/controls/presets');
	}

}