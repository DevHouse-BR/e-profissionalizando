<?php
/**
* @package   Warp Theme Framework
* @file      system.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
	Class: WarpHelperSystem
		Joomla system helper class, provides Joomla CMS integration
*/
class WarpHelperSystem extends WarpHelper {

	/* application */
	var $application;

	/* document */
	var $document;

	/* system path */
	var $path;

	/* system url */
	var $url;

	/* template path */
	var $template_path;

	/* template url */
	var $template_url;

	/* cache path */
	var $cache_path;

	/* cache time */
	var $cache_time;
    
	/*
		Function: Constructor
			Class Constructor.
	*/
	function __construct() {
		parent::__construct();		

		// init vars
		$this->application =& JFactory::getApplication();

		// init helpers
        $path   =& $this->getHelper('path');
		$config =& $this->getHelper('config');
		
		if ($this->application->isSite()) {

			// init vars
			$jconfig             =& JFactory::getConfig();
            $this->document      =& JFactory::getDocument();
            $this->path          = JPATH_ROOT;
            $this->url           = JURI::base(true);
            $this->template_url  = $this->document->baseurl.'/templates/'.$this->document->template;
            $this->template_path = JPATH_ROOT.'/templates/'.$this->document->template;
            $this->cache_path    = JPATH_CACHE.'/template';
            $this->cache_time    = $jconfig->getValue('config.cachetime') * 60;

			// set paths
            $path->register($this->path.'/administrator', 'admin');
            $path->register($this->path, 'site');
            $path->register($this->path.'/cache/template', 'cache');
			$path->register($path->path('warp:systems/joomla.1.5/menus'), 'menu');

			// set config
			$config->set('language', $this->document->language); 
			$config->set('direction', $this->document->direction); 
			$config->set('actual_date', JHTML::_('date', 'now', JText::_('DATE_FORMAT_LC')));

            // get template params
            $config->loadArray($this->document->params->toArray());
            
            // get page class suffix params
            $params = $this->application->getParams();
            $config->parseString($params->get('pageclass_sfx'));
            
			// dynamic presets ?
            if ($config->get('allow_dynamic_preset')) {
                if ($var = JRequest::getVar($this->warp->preset_var, null, 'default', 'alnum')) {
                    $this->application->setUserState('_current_preset', $var);
                }
                $config->set('_current_preset', $this->application->getUserState('_current_preset'));
            }

			// mootools 1.1 ?
			if (!JPluginHelper::isEnabled('system', 'mtupgrade')) {
				$path->register($this->warp->path->path('warp:systems/joomla.1.5/js'), 'js');        
			}
        }
	}

}