<?php
/**
 * Joomla! 1.5 component Analytics
 *
 * @version $Id: controller.php 2009-07-17 10:34:47 svn $
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

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );

/**
 * Analytics Controller
 *
 * @package Joomla
 * @subpackage Analytics
 */
class AnalyticsController extends JController {
    /**
     * Constructor
     * @access private
     * @subpackage Analytics
     */
    function __construct() {
        //Get View
        if(JRequest::getCmd('view') == '') {
            JRequest::setVar('view', 'default');
        }
        $this->item_type = 'Default';
        parent::__construct();
    }
}
?>