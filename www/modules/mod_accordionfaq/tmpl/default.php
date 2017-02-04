<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$html = "";
$document = &JFactory::getDocument();
$db		  = &JFactory::getDBO();
$helper	  = new modAccordionfaqHelper();

$cssfile = $params->get("cssfile","modules/mod_accordionfaq/css/accordionfaq.css");
$faqid = $params->get("faqid","accordion1");
$faqclass = $params->get("faqclass","");
$header = $params->get("header","h3");
$autoheight = $params->get("autoheight","1");
$autonumber = $params->get("autonumber","0");
$alwaysopen = $params->get("alwaysopen","1");
$warnings = $params->get("warnings","1");
$event = $params->get('event',"click");
$animation = $params->get("animation","none");
$active = $params->get("active","");
$faqline = "Accordionfaq module: faqid=".$faqid." ";
if (! $helper->editNumeric( "scrolltime", $params, 1000, $scrolltime, $html))
{
	echo $helper->formattedError( $html, $faqline );
	return;
}
$scrolltime = max( $scrolltime, 1);
if (! $helper->editNumeric( "scrolloffset", $params, 0, $scrolloffset, $html))
{
	echo $helper->formattedError( $html, $faqline );
	return;
}
if ($active == "")
{
	$active = "false";
}
else
{
	if (! is_numeric($active))
	{
		$active = "'#".$active."'";
	}
}
$faqitem = JRequest::getString( 'faqitem', '' );
if ($faqitem != "")
{
	if (JString::strpos( $faqitem, $faqid ) === 0)
	{
		$faqitemparts = JString::str_split( $faqitem, JString::strlen( $faqid) );
		if (isset( $faqitemparts[1]))
		{
			if (is_numeric($faqitemparts[1]))
			{
				$faqitemid = (int)$faqitemparts[1];
				$active = $faqitemid;
				$jumpto = $faqitem;
			}
			else
			{
				$active = "'#".$faqitemparts[1]."'";
				$jumpto = $faqitemparts[1];
			}
		}
		else
		{
			$jumpto = $faqitem;
		}
	}
}

if ($animation == "")
{
	$animation = "none";
}
if ($animation == "none")
{
	$animation = "false";
}
else
{
	$animation = "'".$animation."'";
}
if ($event == "")
{
	$event = "click";
}

jimport('joomla.environment.browser');
jimport('joomla.filesystem.file');
$browser	= &JBrowser::getInstance();
$isIE6		= false;

if ($browser->getBrowser() == "msie" && $browser->getMajor() <= 6)
{
	$isIE6 = true;
	$ie6css = JPATH_BASE . DS . $cssfile;
	$ie6css = JPath::clean( $ie6css, DS );
	if (JString::substr($ie6css, JString::strlen( $ie6css ) - 4, 4) == '.css')
	{
		$ie6css = JString::substr_replace($ie6css, '-ie6.css', JString::strlen( $ie6css ) - 4, 4 );
	}
	if (JFile::exists($ie6css))
	{
		$styledata = JFile::read($ie6css);
		$newtext = preg_replace( "/src=( )*'( )*([^' ]+)'/i", "src='" . JURI::root(true) . "\\3" . "'", $styledata );
		$newtext = preg_replace( "/url\(( )*'( )*([^' ]+)'/i", "url('" . JURI::root(true) . "\\3" . "'", $newtext );
		$document->addStyleDeclaration($newtext);
	}
}
$document->addStyleSheet( JURI::root(true)."/".$cssfile );

$cssbase = JPATH_BASE . DS . $cssfile;
$cssbase = JPath::clean( $cssbase, DS );
$cssfilename = JFile::getName( $cssbase );
$cssbase = str_replace( $cssfilename, '', $cssbase );
$faqbase = str_replace( $cssfilename, '', $cssfile );
$faqclassarray = preg_split( "/[\s]+/", $faqclass );
for($i = 0; $i < count($faqclassarray); $i++)
{
	if (preg_match("/(.*)faq$/i", $faqclassarray[$i], $match ))
	{
		$faqfile = $cssbase.$faqclassarray[$i].".css";
		if (JFile::exists($faqfile))
		{
			$document->addStyleSheet( JURI::root(true)."/".$faqbase.$faqclassarray[$i].".css" );
			if ($isIE6)
			{
				$ie6css = $cssbase.$faqclassarray[$i]."-ie6.css";
				if (JFile::exists($ie6css))
				{
					$styledata = JFile::read($ie6css);
					$newtext = preg_replace( "/src=( )*'( )*([^' ]+)'/i", "src='" . JURI::root(true) . "\\3" . "'", $styledata );
					$newtext = preg_replace( "/url\(( )*'( )*([^' ]+)'/i", "url('" . JURI::root(true) . "\\3" . "'", $newtext );
					$document->addStyleDeclaration($newtext);
				}
			}
		}
		else
		{
			if ($warnings == '1')
			{
				$warntext = "WARNING: CSS file for faqclass ".$faqclassarray[$i]." does not exist (".$faqfile.").";
				$html .= $helper->formattedError( $warntext, $faqline );
			}
		}
	}
	else
	{
		if ($warnings == '1')
		{
			if (! $helper->editFaqClass( $faqclassarray[$i], $warntext))
			{
				$html .= $helper->formattedError( $warntext, $faqline );
			}
		}
	}
}

$includejquery = $params->get('includejquery');
if ($includejquery != 0)
{
	if ($includejquery == 1)
	{
		JHTML::_('script', 'jquery-1.4.2.js', 'modules/mod_accordionfaq/js/' );
	}
	else
	{
		JHTML::_('script', 'jquery-1.4.2.min.js', 'modules/mod_accordionfaq/js/' );
	}
}
if ($animation != "none")
{
	JHTML::_('script', 'jquery.easing.js', 'modules/mod_accordionfaq/js/' );
}
JHTML::_('script', 'jquery.dimensions.js', 'modules/mod_accordionfaq/js/' );
JHTML::_('script', 'jquery.accordion.js', 'modules/mod_accordionfaq/js/' );
JHTML::_('script', 'preparefaq.js', 'modules/mod_accordionfaq/js/' );
if (isset($jumpto))
{
	JHTML::_('script', 'bookmarkscroll.js', 'modules/mod_accordionfaq/js/' );
}

$script  = "jQuery.noConflict();\n";
$script .= "jQuery(document).ready(function(){ \n";
$script .= "	var preparefaq = new prepareFaq();\n";
$script .= "	preparefaq.exec( { id: '".$faqid."', header: '".$header."', autonumber: ".$autonumber."e } );\n";
$script .= "	jQuery('#".$faqid."').accordion( { \n";
$script .= "		  header: '".$header."'\n";
$script .= "		, autoheight: ".$autoheight."e\n";
$script .= "		, alwaysOpen: ".$alwaysopen."e\n";
$script .= "		, active: ".$active."\n";
$script .= "	 	, animated: ".$animation."\n";
$script .= "	 	, event: '".$event."'\n";
$script .= "	} );\n";
if (isset($jumpto))
{
	$script .= "/***********************************************\n";
	$script .= "* Scrolling HTML bookmarks- © Dynamic Drive DHTML code library (www.dynamicdrive.com)\n";
	$script .= "* This notice MUST stay intact for legal use\n";
	$script .= "* Visit Project Page at http://www.dynamicdrive.com for full source code\n";
	$script .= "***********************************************/\n";
	$script .= "	bookmarkscroll.scrollTo( '".$jumpto."', {duration: ".$scrolltime.", yoffset: ".$scrolloffset." } );\n";
}
$script .= "});\n";
$document->addScriptDeclaration( $script );

$html 	.= "<div id=\"".$faqid."\" class=\"accordionfaq ".$faqclass."\">";
$html 	.= "<p></p>";
$html 	.= "</div>";
$id		 = $params->get('article');
if ($id != -1)
{
	$query = "SELECT * from `#__content` WHERE `id` = ".$id;
	$db->setQuery( $query );
	if ($db->query())
	{
		$article = $db->loadObject();
		$html .= $article->introtext;
	}
}

echo $html;
