<?php
	define("CMS", "Valid");
	session_start();
	require_once(getenv("DOCUMENT_ROOT").'/cms/include/site_config.php');

	require_once( getenv("DOCUMENT_ROOT").'/cms/include/_auth.php' );
?>