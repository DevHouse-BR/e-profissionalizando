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

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new VisittracerController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();
?>