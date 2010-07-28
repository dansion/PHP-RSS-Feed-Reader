<?php
	require_once('../includes/general.php');		//all other required files and database conection
	$meta_title = "Add Web Feeds";
	$meta_description = "Application for managing web feeds.";
	$meta_keywords = "feeds, xml, web feeds";
	
	include (PATH_WEB_TEMPLATES."header.php");  	//meta data and css/script links
	include (PATH_WEB_TEMPLATES."top.php");			//top of web interface
	include (PATH_WEB_TEMPLATES."left_menu.php");	//left navigation items
	
	$feed = new Feeds();
	if(isset($_POST['submit']))
	{
		$add_feed = $feed->add_feed($_POST['feed_name'], $_POST['feed_link']);
	}
	
	if(isset($_POST['submit']) && $add_feed == true)
	{
		?>
		
	<h1>Feed Added Sucessfully</h1>
	<p><a href="<?=$_SERVER['HTTP_REFERER']?>" title="Back">Click here to go back</a></p>
	
		<?	
	}
	else
	{
?>

	<h1>Add Web News Feed</h1>
	<p>* Indicated required fields.</p>
	<?
		if(isset($_POST['submit']) && $add_feed == false)
		{
			$feed->show_errors();
		}
	?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="add_feed">
		<table width="100%" align="center" cellspacing="0" cellpadding="2" border="1">
				  <tr>
					<td width="20%"><div align="right"><p>* Name of feed:</p></div></td>
					<td>
						<input type="text" name="feed_name" value="<?=$feed->feed_name?>" />
					</td>
				  </tr>
				  <tr>
					<td width="20%"><div align="right"><p>* Feed URL:</p></div></td>
					<td>
						<input type="text" name="feed_link" value="<?=$feed->feed_link?>" />
					</td>
				  </tr>
				  <tr>
					<td><div align="right"><p></p></div></td>
					<td><input type="submit" name="submit" value="Add Feed" class="button" /></td>
				  </tr>
		</table>
	</form>	
	
<?
	}
	include (PATH_WEB_TEMPLATES."footer.php");		//footer and close tags
?>