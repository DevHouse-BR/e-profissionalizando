<?php
/**
 * Joomla! 1.5 component Analytics
 *
 * @version $Id: install.analytics.php 2009-07-17 10:34:47 svn $
 * @author Kinshuk Kulshreshtha
 * @package Joomla
 * @subpackage Analytics
 * @license GNU/GPL
 *
 * Show Google Analytics in Joomla Backend
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Initialize the database
$db =& JFactory::getDBO();
$update_queries = array ();

// Perform all queries - we don't care if it fails
foreach( $update_queries as $query ) {
    $db->setQuery( $query );
    $db->query();
}
?>