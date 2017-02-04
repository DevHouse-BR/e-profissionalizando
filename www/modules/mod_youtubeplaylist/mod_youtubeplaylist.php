<?php
/**
 * Youtubeplaylist Module
 *
 * @version 1.0.0
 * @package Youtubeplaylist
 * @author Nguyen Hoang Viet
 * @copyright Copyright (C) 2008 Luyenkim.net. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
//$counterID = $module->id;
$html = modYoutubeplaylistHelper::getContent($params,'m'.$module->id);
require(JModuleHelper::getLayoutPath('mod_youtubeplaylist'));
?>