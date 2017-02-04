<?php
/**
 * Joomla! 1.5 component VisitTracer
 *
 * @version $Id: visittracer.php 2010-08-24 14:26:29 svn $
 * @author Leonardo
 * @package Joomla
 * @subpackage VisitTracer
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * Exibe lista de páginas visitádas pelo usuário.
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Define constants for all pages
 */
define( 'COM_VISITTRACER_DIR', 'images'.DS.'visittracer'.DS );
define( 'COM_VISITTRACER_BASE', JPATH_ROOT.DS.COM_VISITTRACER_DIR );
define( 'COM_VISITTRACER_BASEURL', JURI::root().str_replace( DS, '/', COM_VISITTRACER_DIR ));

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Require the base controller
require_once JPATH_COMPONENT.DS.'helpers'.DS.'helper.php';

// Initialize the controller
$controller = new VisittracerController( );

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>