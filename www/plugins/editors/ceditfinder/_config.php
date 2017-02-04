<?php

	// This is the basic configuration for ceditFinder

	// Note that config parameters may be overridden in the _auth.php file depending upon the environment

	//

	defined( 'ceditFinder' ) or die( 'Restricted access' );

	if (!function_exists('removeFileRoot')) {
		function removeFileRoot( $path ) {
			// Remove the fileroot from the given path to leave a relative path
			$path = str_replace( "\\", "/", $path );  // Change Windows directory separator
			if (strtolower(substr($path, 0, strlen($_SERVER["DOCUMENT_ROOT"]))) == strtolower($_SERVER["DOCUMENT_ROOT"]) ) {	
				return substr($path, strlen($_SERVER["DOCUMENT_ROOT"]));
			} else return $path;
		}
	}
	

	$cfconfig = array(
		'thumbwidth' => 100,									// Thumbnail width
		'thumbheight' => 100,									// Thumbnail height
		'imagefolder' => 'images/',							// Image folder (relative to fileroot and baseurl)
		'baseurl' => $_SERVER["HTTP_HOST"],						// URL of site can contain subfolder
		'fileroot' => $_SERVER["DOCUMENT_ROOT"],				// File root of site (file equivalent of baseurl)
		'imagecache' => removeFileRoot(dirname(__FILE__) . '/imgcache'),	// Folder for the thumbnail cache
		'confirmdelete' => true									// Whether to confirm image deletion

	);

	if ( strtolower( substr( $cfconfig['baseurl'], 7 ) ) != 'http://' )
		$cfconfig['baseurl'] = 'http://' . $cfconfig['baseurl'];

// end of _config.php