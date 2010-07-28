<?php
	require_once('../includes/general.php');		//all other required files and database conection
	$meta_title 		= "Web Feeds";
	$meta_description 	= "Application for managing web feeds.";
	$meta_keywords 		= "feeds, xml, web feeds";
	
	include (PATH_WEB_TEMPLATES."header.php");  	//meta data and css/script links
	include (PATH_WEB_TEMPLATES."top.php");			//top of web interface
	include (PATH_WEB_TEMPLATES."left_menu.php");	//left navigation items
?>
<h1>Web Feeds Application</h1>
<p>Please select an option on the left navigaion.</p>
<?
	include (PATH_WEB_TEMPLATES."footer.php");		//footer and close tags
?>