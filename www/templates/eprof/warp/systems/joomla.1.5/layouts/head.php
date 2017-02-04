<?php
/**
* @package   Warp Theme Framework
* @file      head.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

// load mootools
JHTML::_('behavior.mootools');

$style_urls  = array();
$script_urls = array();

if ($compression = $this->warp->config->get('compression')) {
	
	// get compressed styles and scripts
    $style_urls  = $this->warp->cache->processStylesheets(array_keys($this->warp->stylesheets->get()), $compression);
    $script_urls = $this->warp->cache->processJavascripts(array_keys($this->warp->javascripts->get()), $compression);

} else {
    $style_urls  = array_keys($this->warp->stylesheets->get());
	$script_urls = array_keys($this->warp->javascripts->get());
}

// add styles
foreach ($style_urls as $style) {
	$this->warp->system->document->addStyleSheet($style);
}

// add scripts
foreach ($script_urls as $script) {
	$this->warp->system->document->addScript($script);
}

// add style declarations
foreach ($this->warp->stylesheets->getDeclarations() as $type => $style) {
	$this->warp->system->document->addStyleDeclaration($style, $type);
}

// add script declarations
foreach ($this->warp->javascripts->getDeclarations() as $type => $script) {
	$this->warp->system->document->addScriptDeclaration($script, $type);
} 

?>
<jdoc:include type="head" />
<?php $this->output('head'); ?>