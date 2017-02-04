<?php
/**
 * Sitemap Generator Module Entry Point
 * 
 * @package    
 * @subpackage 
 * @link http://dasinfomedia.com
 * @license        http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * This module generate sitemap.
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
require( JModuleHelper::getLayoutPath( 'mod_sitemapgenerator' ) );
?>
