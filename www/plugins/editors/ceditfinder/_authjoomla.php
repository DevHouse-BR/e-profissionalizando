<?php
	defined( 'ceditFinder' ) or die( 'Restricted access' );
	/* ceditFinder Auth File - Joomla authentication */
	define( '_JEXEC', 1 );
	define( 'DS', '/' );  // Windows and Linux BOTH accept this as a directory separator, so force this
	
	// Determine root Joomla path
	$mypath = str_replace('\\', '/', dirname(__FILE__));
	$path = '';
	$pathtrail = explode( '/', $mypath );
	for ( $i=0; $i<count($pathtrail)-3; $i++ ) {
		$path .= $pathtrail[$i] . '/';
	}
	define('JPATH_BASE', $path );

	
	/* Required Files */
	require_once ( JPATH_BASE . '/includes/defines.php' );
	require_once ( JPATH_BASE . '/includes/framework.php' );
	include( '_config.php' );
	
	
	/* Where are we? */
	$site = $_GET['site'];
	if ( $site != 'administrator' && $site != 'site' ) {
		// Invalid site
		die ('Configuration error');
	}
	$browseURL = "&amp;site=$site";
	
	/* Create the application  */
	$mainframe =& JFactory::getApplication($site);
	$mainframe->initialise();
	
	$user =& JFactory::getUser();
	// If we have a user, we can continue...
	if ( $user->id < 1 ) {
		// User not logged in
		die("Restricted access");
	}
	
	// Read configuration from plugin parameters
	JPluginHelper::importPlugin( 'editors', 'ceditckeditor' );
	$ceditckeditor =& JPluginHelper::getPlugin( 'editors', 'ceditckeditor' );
	$params = new JParameter($ceditckeditor->params);
	
	// Populate ceditFinder configuration array with plugin parameter values
	$imagefolder = str_replace('\\', '/', $params->get('imagesfolder', 'images'));
	while ( $imagefolder[0] == '/' ) {
		$imagefolder = substr( $imagefolder, 1 );
	}
	if ( $imagefolder[strlen($imagefolder)-1] != '/' ) $imagefolder .= '/';
	$cfconfig['imagefolder'] = $imagefolder;
	$cfconfig['thumbwidth'] = $params->get('thumbwidth', 100);
	$cfconfig['thumbheight'] = $params->get('thumbheight', 100);
	$cfconfig['confirmdelete'] = $params->get('confirmdelete', 1);
	
	// Now work out other configuration details
	$rootpath = JPATH_BASE . $imagefolder . '/';
	//echo $rootpath;
	$rooturl = '';
	$urltrail = explode( '/', JURI::root() );
	for ( $i=0; $i<count($urltrail)-4; $i++ ) {
		$rooturl .= $urltrail[$i] . '/';
	}
	$cfconfig['baseurl'] = $rooturl;
	$cfconfig['fileroot'] = JPATH_BASE;

// end of _authjoomla.php