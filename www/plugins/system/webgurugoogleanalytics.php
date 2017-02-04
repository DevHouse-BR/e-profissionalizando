<?php

/**
 *  Copyright (c) 2009 Webguru Ltd. All rights reserved.
 *
 *  This file is part of Webguru's Google Analytics plugin for Joomla 1.5.
 *
 *  Webguru's Google Analytics plugin for Joomla 1.5.x is free software:
 *  you can redistribute it and/or modify it under the terms of the
 *  GNU General Public License as published by the Free Software Foundation,
 *  either version 3 of the License, or (at your option) any later version.
 *
 *
 *  Webguru's Google Analytics plugin for Joomla 1.5.x is distributed in the
 *  hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
 *  implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *  See the GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 * 
 *  (Last updated: October 16th, 2009 - version 0.6)
 */
 
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * Google analytics plugin for joomla provided by Webguru.
 * It's scope is system wide and affects every page.
 * It has very usefull features. You can filter user groups using provided options
 * in plugin's preference page.
 */
class plgSystemWebgurugoogleanalytics extends JPlugin {
/**
 * Constructor
 *
 * For php4 compatibility we must not use the __constructor as a constructor for plugins
 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
 * This causes problems with cross-referencing necessary for the observer design pattern.
 *
 * @access	protected
 * @param	object	$subject The object to observe
 * @param 	array   $config  An array that holds the plugin configuration
 * @since	1.0
 */
    function plgSystemWebgurugoogleanalytics(& $subject, $config) {
        parent :: __construct($subject, $config);
    }

    function onPrepareContent() {

        global $mainframe;

        if($mainframe->isAdmin()) {
            JPlugin::loadLanguage( 'plg_system_webgurugoogleanalytics' );
        } else {
            JPlugin::loadLanguage( 'plg_system_webgurugoogleanalytics', 'administrator' );
        }
    }

    /**
     * Gets current user and check group ID and params.
     * After that decides wether to insert GA javascript or not.
     * onAfterRender
     */
    function onAfterRender() {

        $this->_plugin = JPluginHelper :: getPlugin('system', 'webgurugoogleanalytics');
        $this->_params = new JParameter($this->_plugin->params);

        global $mainframe;
        $db =& JFactory::getDBO();
        $user = & JFactory :: getUser();
        $ga_javascript = $this->params->get('ga_javascript', '');
        $log_admin_area = $this->params->get('log_admin_area', '');
        $log_error_page = $this->params->get('log_error_page', '');
        $log_search = $this->params->get('log_search', '');
        $log_outgoing_link = $this->params->get('log_outgoing_link', '');
        $log_super_administrator = $this->params->get('log_super_administrator', '');
        $log_administrator = $this->params->get('log_administrator', '');
        $log_manager = $this->params->get('log_manager', '');
        $log_publisher = $this->params->get('log_publisher', '');
        $log_editor = $this->params->get('log_editor', '');
        $log_author = $this->params->get('log_author', '');
        
        $group_id = $user->get('gid');
        $user_id = $user->get('userid');
 
        if ($ga_javascript != '') {

            $response_buffer = JResponse :: getBody();

            $this->insertCodeError($ga_javascript, $log_error_page);
            $response_buffer = $this->getLinks($response_buffer, $log_outgoing_link);

            $position = strrpos($response_buffer, "</body>");

            if ($position > 0 && isset ($_REQUEST['searchword'])) {
                JResponse :: setBody($this->getLinks($this->insertCodeSearch($ga_javascript, $response_buffer, $position, $log_search), $log_outgoing_link));
            } elseif ($mainframe->isAdmin() && $log_admin_area == true){
                $tmpResponse_buffer = $this->insertCodeOutgoing($ga_javascript, $response_buffer, $position, $log_outgoing_link);
                JResponse :: setBody($tmpResponse_buffer);
                
                return;
            } elseif ($mainframe->isSite()){
                foreach ($_COOKIE as $name => $value) {

                    $query="SELECT gid
                            FROM jos_session
                            WHERE session_id = '".$value."'";
                    $db->setQuery($query);

                    $result = $db->loadRow();

                    if ($result[0] === '25' && $log_super_administrator == true ||
                        $result[0] === '24' && $log_administrator == true ||
                        $result[0] === '23' && $log_manager == true ||
                        $result[0] === '21' && $log_publisher == true ||
                        $result[0] === '20' && $log_editor == true ||
                        $result[0] === '19' && $log_author == true) {

                        $tmpResponse_buffer = $this->insertCodeOutgoing($ga_javascript, $response_buffer, $position, $log_outgoing_link);
                        JResponse :: setBody($tmpResponse_buffer);

                        return;
                    }
                }
            }
            $response_buffer = substr($response_buffer, 0, $position) . $ga_javascript . substr($response_buffer, $position);
            JResponse :: setBody($response_buffer);
        } else {
            return;
        }

        return true;
    }

    function get_url($link) {

        $site_url = (($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
        
        if (strpos(strtolower($link), strtolower($site_url)) === false) {
            $link = substr($link, strlen($site_url));
        }

        $link = preg_replace("/^https?:\/\/|^\/+/i", "", $link);
        $link = preg_replace("/[^a-z0-9\.\/\+\?=-]+/i", "_", $link);
        $link = trim($link, '_');
        $char = (strpos($link, '?') === false) ? '?' : '&amp;';

        return str_replace("'", "\'", "/{$link}{$char}referer={$_SERVER['HTTP_REFERER']}");

    }

    function getLinks($buffer, $log_outgoing_link) {
        if ($log_outgoing_link) {
            $buffer = preg_replace_callback("/
												<\s*a
													(?:\s[^>]*)?
													\s*href\s*=\s*
													(?:
														\"([^\"]*)\"
													|
														'([^']*)'
													|
														([^'\"\s]*)
													)
													(?:\s[^>]*)?
													\s*>
												/isUx", array (
                $this,
                'handleLink'
                ), $buffer);
        }
        return $buffer;
    }

    function handleLink($links) {

        $site_url = (($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
        $link = array_pop($links);

        if (preg_match("/^https?:\/\//i", $link) && (strpos(strtolower($link), strtolower($site_url)) !== 0)) {

            $url = plgSystemWebgurugoogleanalytics :: get_url($link);
            $function = "pageTracker._trackEvent('" . JURI :: base() . "','Outgoing','" . $url . " ');";

            if (preg_match("/onclick\s*=\s*(['\"])/iUx", $links[0], $match)) {

                if ($match[1] == "'") {
                    $onclick = str_replace("'", '"', $onclick);
                }
                $links[0] = str_replace($match[0], $match[0] . $onclick, $links[0]);
            } else {
                $links[0] = str_replace('>', " onClick=\"{$function}\">", $links[0]);
            }
        }
        return $links[0];
    }

    function insertCodeSearch($ga_javascript, $response_buffer, $position, $log_search) {

        if($log_search) {
            $tmpInsertPos = strrpos($ga_javascript, "pageTracker");
            $search_ga_javascript = preg_replace('/pageTracker\._trackPageview\(\)\;/', "pageTracker._trackPageview('/search/".$_REQUEST['searchword']." : referer=".$_SERVER['HTTP_REFERER']."');", $ga_javascript);
            $response_buffer = substr($response_buffer, 0, $position) . $search_ga_javascript . substr($response_buffer, $position);
        }

        return $response_buffer;
    }

    function insertCodeOutgoing($ga_javascript, $response_buffer, $position, $log_outgoing_link) {

        if($log_outgoing_link){
            $tmpInsertPos = strrpos($ga_javascript, "pageTracker");
            $outgoing_ga_javascript = preg_replace('/pageTracker\._trackPageview\(\)\;/', "", $ga_javascript);
            $response_buffer = substr($response_buffer, 0, $position) . $outgoing_ga_javascript . substr($response_buffer, $position);
        }

        return $response_buffer;
    }

    function insertCodeError($ga_javascript, $log_error_page) {

        $app = & JFactory :: getApplication();
        $changed = false;
        $errorPageFile = JPATH_BASE . "/templates/" . $app->getTemplate() . "/error.php";

        if (!file_exists($errorPageFile)) {
            $errorPageFile = JPATH_BASE . "/templates/system/error.php";
        }

        $buffer = fopen($errorPageFile, 'r');
        $theData = fread($buffer, filesize($errorPageFile));
        $posScript = strrpos($theData, "<!-- inserted programatically -->");
        $posBody = strrpos($theData, "</body>");
        fclose($buffer);
        $error_ga_javascript = preg_replace('/pageTracker\._trackPageview\(\)\;/', "pageTracker._trackPageview('/error/<?php echo \$this->error->code ; ?>/<?php echo \$_SERVER['REQUEST_URI'];?> : referer=<?php \$_SERVER['HTTP_REFERER']?> ');", $ga_javascript);

        if ($posScript > 0 && $log_error_page == false) {
            $theData = substr($theData, 0, $posScript) . substr($theData, $posBody);
            $changed = true;
        }
        elseif ($posBody > 0 && $log_error_page == true && $posScript === false) {
            $theData = substr($theData, 0, $posBody) . "<!-- inserted programatically -->\n" . $error_ga_javascript . substr($theData, $posBody);
            $changed = true;
        }

        if ($changed == true) {
            $buffer = fopen($errorPageFile, 'w');
            fwrite($buffer, $theData);
            fclose($buffer);
            $changed = false;
        }
    }
}