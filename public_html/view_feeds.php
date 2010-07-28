<?php
	require_once('../includes/general.php');		//all other required files and database conection
	$meta_title 			= "View Web Feeds";
	$meta_description 		= "Application for managing web feeds.";
	$meta_keywords 			= "feeds, xml, web feeds";
	
	include (PATH_WEB_TEMPLATES."header.php");  	//meta data and css/script links
	include (PATH_WEB_TEMPLATES."top.php");			//top of web interface
	include (PATH_WEB_TEMPLATES."left_menu.php");	//left navigation items
?>

	<h1>Saved Web Feeds</h1>
	<?
		$feed 				= new Feeds();
		$feed->show_feeds();
	?>
	
	
<?
	include (PATH_WEB_TEMPLATES."footer.php");		//footer and close tags
?>