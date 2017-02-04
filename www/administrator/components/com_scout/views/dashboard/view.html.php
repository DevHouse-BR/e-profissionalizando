<?php
/**
 * @version    1.5
 * @package    Scout
 * @author     Dioscouri Design
 * @link     http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

JLoader::import( 'com_scout.views._base', JPATH_ADMINISTRATOR.DS.'components' );

class ScoutViewDashboard extends ScoutViewBase
{
    /**
     * The default toolbar for a list
     * @return unknown_type
     */
    function _defaultToolbar()
    {
    }
}