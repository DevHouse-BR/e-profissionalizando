<?php
/**
 * @version		$Id: ceditckeditor.php $
 * @package		ceditckeditor
 * @copyright	Copyright (C) 2010 David Barrett. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Do not allow direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * ceditCKEditor: CKEditor WYSIWYG Editor Plugin
 *
 * @package Editors
 * @since 1.5
 */
class plgEditorceditckeditor extends JPlugin
{
	var $settings;

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param 	object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgEditorceditckeditor(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	function getBoolParam( $param, $default = 'true') {
		$default = ( $default == 'true' ) ? 1 : 0 ;
		$value = $this->params->get( $param, $default );
		if ( $value == 1 ) return 'true';
		return 'false';
	}

	/**
	 * Method to handle the onInit event.
	 *  - Initializes the CKEditor WYSIWYG Editor
	 *
	 * @access public
	 * @return string JavaScript Initialization string
	 * @since 1.5
	 */
	function onInit()
	{
		$mainframe = &JFactory::getApplication();
		$this->settings = '';

		// Retrieve basic settings
		$this->settings .= 'skin : \'' . $this->params->get( 'skin', 'kama' ) . '\',';
		$this->settings .= 'toolbar : \'' . ucfirst($this->params->get( 'toolbar', 'Full' )) . '\',';
		$this->settings .= 'toolbarCanCollapse : ' . $this->getBoolParam('toolbar_collapsible', 'true') . ',';
		$this->settings .= 'entities : ' . $this->getBoolParam('html_entities', 'true') . ',';
		$this->settings .= 'htmlEncodeOutput : ' . $this->getBoolParam('html_encode', 'false') . ',';
		$this->settings .= 'resize_enabled : ' . $this->getBoolParam('resize_enabled', 'true') . ',';
		$this->settings .= 'baseHref : \'' . JURI::root() . '\',';
		
		
		// Retrieve language setting
		$lang = JFactory::getLanguage();
		$language_mode = $this->params->get('language_mode', 0);
		if ( $language_mode == 1 ) {
			// Use Joomla! default language
			$language = substr( $lang->getTag(), 0, 2);
			$this->language_mode = 'language : \'' . $language . '\',';
			if ( $lang->isRTL() ) {
				$this->settings .= 'contentsLangDirection: \'rtl\',';
			} else {
				$this->settings .= 'contentsLangDirection: \'ltr\',';
			}
		}
		

		$invalid_elements	= $this->params->def( 'invalid_elements', 'script,applet,iframe' );
		$extended_elements	= $this->params->def( 'extended_elements', '' );
		
		// Add CKEditor script to document
		//$doc->addScript( '/plugins/editors/ceditckeditor/ckeditor.js' );
		return '<script type="text/javascript" src="'.JURI::root().'plugins/editors/ceditckeditor/ckeditor.js"></script>';
		return '';
	}

	/**
	 * CKEditor WYSIWYG Editor - get the editor content
	 *
	 * @param string 	The name of the editor
	 */
	function onGetContent( $editor ) {
		return "CKEDITOR.instances.$editor.getData();";
	}

	/**
	 * CKEditor WYSIWYG Editor - set the editor content
	 *
	 * @param string 	The name of the editor
	 */
	function onSetContent( $editor, $html ) {
		return "CKEDITOR.instances.$editor.setData('$html');";
	}

	/**
	 * CKEditor WYSIWYG Editor - copy editor content to form field
	 *
	 * @param string 	The name of the editor
	 */
	function onSave( $editor ) {
		return ''; 
	}

	/**
	 * CKEditor WYSIWYG Editor - display the editor
	 *
	 * @param string The name of the editor area
	 * @param string The content of the field
	 * @param string The width of the editor area
	 * @param string The height of the editor area
	 * @param int The number of columns for the editor area
	 * @param int The number of rows for the editor area
	 * @param mixed Can be boolean or array.
	 */
	function onDisplay( $name, $content, $width, $height, $col, $row, $buttons = true)
	{
		// Only add "px" to width and height if they are not given as a percentage
		if (is_numeric( $width )) {
			$width .= 'px';
		}
		if (is_numeric( $height )) {
			$height .= 'px';
		}
		
		$user =& JFactory::getUser();
		if ( $user->guest ) return 'Not logged in'; // No editing for guests!
		if ( $user->id<1 ) return 'Not logged in';
		$mainframe = JFactory::getApplication();
		if ( $mainframe->isSite() ) {
			$site = 'site';
		} elseif ( $mainframe->isAdmin() ) {
			$site = 'administrator';
		} else $site = 'unknown';
		
		// Retrieve CSS styles
		$doc =& JFactory::getDocument();
		$css = '';
		foreach ( $doc->_styleSheets as $url => $value ) {
			if ( $css != '' ) $css .= ',';
			$css .= "'$url'";
		}
		//if ( $css != '' )	$this->settings .= "contentsCss = $css,";
		// config.contentsCss = ['/css/mysitestyles.css', '/css/anotherfile.css'];

		$config = 	$this->settings .
						"filebrowserImageBrowseUrl : '" . JURI::root() . "plugins/editors/ceditfinder/browse.php?site=$site'";

		$editor  = "<textarea id=\"$name\" name=\"$name\" cols=\"$col\" rows=\"$row\" style=\"width:{$width}; height:{$height};\" >$content</textarea>\n" .
		"<script type=\"text/javascript\">CKEDITOR.replace( '" . $name . "', {" . $config . "});</script>";
		
		// Show extended editor buttons
		$editor .= $this->_displayButtons($name, $buttons);
		return $editor;
	}

	function _displayButtons($name, $buttons)
	{
		// Load modal popup behavior
		JHTML::_('behavior.modal', 'a.modal-button');

		$args['name'] = $name;
		$args['event'] = 'onGetInsertMethod';

		$return = '';
		$results[] = $this->update($args);
		foreach ($results as $result) {
			if (is_string($result) && trim($result)) {
				$return .= $result;
			}
		}

		if(!empty($buttons))
		{
			$results = $this->_subject->getButtons($name, $buttons);

			/*
			 * This will allow plugins to attach buttons or change the behavior on the fly using AJAX
			 */
			$return .= "\n<div id=\"editor-xtd-buttons\">\n";
			foreach ($results as $button)
			{
				/*
				 * Results should be an object
				 */
				if ( $button->get('name') )
				{
					$modal		= ($button->get('modal')) ? 'class="modal-button"' : null;
					$href		= ($button->get('link')) ? 'href="'.JURI::base().$button->get('link').'"' : null;
                    $onclick	= ($button->get('onclick')) ? 'onclick="'.$button->get('onclick').'"' : 'onclick="IeCursorFix(); return false;"';
					$return .= "<div class=\"button2-left\"><div class=\"".$button->get('name')."\"><a ".$modal." title=\"".$button->get('text')."\" ".$href." ".$onclick." rel=\"".$button->get('options')."\">".$button->get('text')."</a></div></div>\n";
				}
			}
			$return .= "</div>\n";
		}

		return $return;
	}
	
	function onGetInsertMethod($name)
	{
		$doc =& JFactory::getDocument();
		$js= "
			function jInsertEditorText( text, editor ) {
				CKEDITOR.instances[editor].insertHtml(text);
				return true;
			}";

		$doc->addScriptDeclaration($js);
		return true;
	}

}
