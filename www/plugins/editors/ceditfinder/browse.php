<?php

	//error_reporting( E_ALL );
	//ini_set("display_errors", 1);

	define("ceditFinder", 1);	

	// Check authentication
	require_once( '_config.php' );
	require_once( '_authjoomla.php' );
	//echo '<pre>'; print_r($cfconfig); echo '</pre>';

	$showfolder = true;
	$message = '';

	// get the subfolder path
	if ( isset( $_REQUEST['folder'] ) ) {
		$folder = $_REQUEST['folder'];
		if ( !file_exists( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $folder ) ) $folder = '';
	} else $folder = '';

	if ( $folder != '' ) {
		if ( $folder[strlen( $folder ) - 1] != '/' ) $folder .= '/';
	}

	if ( isset($_GET['action']) &&  $_GET['action'] == 'edit' ) {
		$editimage = $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'];
		if ( $folder[0] == '/' ) { $editimage .= substr($folder,1); } else $editimage .= $folder;
		$editimage .= $_GET['name'];
		$head = '	<style type="text/css">@import "imageeditor/ImageEditor.css";</style>
	<script type="text/javascript" src="imageeditor/PageInfo.js"></script>
	<script type="text/javascript" src="imageeditor/ImageEditor.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		window.onload = function(){
			ImageEditor.init("' . urlencode($editimage) . '","' .  'imageeditor/' . '");
		};
	//]]>
	</script>
';
	}

	require_once( '_header.php' );
	require_once( "simpleimage.php");
	require_once( "_browse.php");

	// Read CKEditor parameters
	$CKEditor = $_GET['CKEditor'];
	$langCode = $_GET['langCode'];
	$CKEditorFuncNum = $_GET['CKEditorFuncNum'];
	if (!isset($browseURL)) {
		$browseURL = "browse.php?CKEditor=$CKEditor&amp;langCode=$langCode&amp;CKEditorFuncNum=$CKEditorFuncNum";
	} else {
		$browseURL = "browse.php?CKEditor=$CKEditor&amp;langCode=$langCode&amp;CKEditorFuncNum=$CKEditorFuncNum" . $browseURL;
	}


	if ( $_POST ) {
		if ( $_POST['submit'] == 'Create Folder' ) {
			// Adding subfolder
			$newfolder = $_POST['newfolder'];
			//if ( $folder[0] == DS ) $folder = substr( $folder, 1 );
			//echo '<pre>' . $cfconfig['fileroot'] . ' -> ' . $folder . ' -> ' . $newfolder . '</pre>';
			if ( mkdir( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $folder . $newfolder, 0664 ) ) {
				$message = "<div id=\"message_box\"><p class=\"success\">Folder successfully created</p></div>";
			}
		} elseif ( $_POST['submit'] == 'Add Image' ) {

			// Upload an image
			$uploadedfile=$_FILES['image']['tmp_name'];
			if ( file_exists( $uploadedfile ) ) {
				// Move the uploaded file and create thumbnail
				$filename = $folder . $_FILES['image']['name'];
				$image = new simpleimage();
				$image->load( $uploadedfile );
				if ( $image->save( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $filename ) ) {
					chmod( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $filename, 0664 );
					$message = "<div id=\"message_box\"><p class=\"success\">Image uploaded</p></div>";
				} else $message = "<div id=\"message_box\"><p class=\"error\">Failed to upload image</p></div>";
			} else $message = "<div id=\"message_box\"><p class=\"error\">Image not found</p></div>";
		}
	}

	echo '<div id="browsertitle"><h1>Image Browser</h1></div>';
	echo '<div id="viewwrapper">';
	ShowFolderTree( );
	echo '<div id="folderview">';

	if ( isset( $_GET['action'] ) ) {
		switch ( $_GET['action'] ) {
			case 'delimage': // Delete the image
				$imagename = $_GET['name'];
				if ( $imagename != '' ) $imagename = $folder . $imagename;
				if ( file_exists( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $imagename ) ) {
					if ( unlink( $cfconfig['fileroot'] . '/' . $cfconfig['imagefolder'] . $imagename ) ) {
						if ( file_exists( $cfconfig['fileroot'] . '/' . $cfconfig['imagecache'] . $imagename ) )
							unlink( $cfconfig['fileroot'] . '/' . $cfconfig['imagecache'] . $imagename );
						$message =  "<div id=\"message_box\"><p class=\"success\">Image deleted</p></div>";
					} else $message =  "<div id=\"message_box\"><p class=\"error\">Failed to delete image</p></div>";
				} else $message =  "<div id=\"message_box\"><p class=\"error\">Image not found</p></div>";
				break;

			case 'edit': // Edit an image
				$name = $_GET['name'];
				showImageEditor($folder, $name);
				$showfolder = false;
				break;

			case 'delfolder': // Delete the folder
				break;
		}
	}

	if ( $message != '' ) echo $message;

	if ( $showfolder ) {
		showFolder( $folder );
	}

	echo '</div></div>';
	include( "_footer.php" );

// end of browse.php