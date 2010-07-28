<?php
	require_once('../includes/general.php');		//all other required files and database conection
	$meta_title = "View Web Feed";
	$meta_description = "Application for managing web feeds.";
	$meta_keywords = "feeds, xml, web feeds";
	
	include (PATH_WEB_TEMPLATES."header.php");  	//meta data and css/script links
	include (PATH_WEB_TEMPLATES."top.php");			//top of web interface
	include (PATH_WEB_TEMPLATES."left_menu.php");	//left navigation items
?>

	<?
		$feed = new Feeds();
		$feed->generate_csv_and_show($_GET['feed_id']);
		
	?>
	
	
<?
	include (PATH_WEB_TEMPLATES."footer.php");		//footer and close tags
?>