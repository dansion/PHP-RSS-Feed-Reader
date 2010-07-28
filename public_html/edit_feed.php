<?php
	require_once('../includes/general.php');		//all other required files and database conection
	$meta_title = "Edit Web Feeds";
	$meta_description = "Application for managing web feeds.";
	$meta_keywords = "feeds, xml, web feeds";
	
	include (PATH_WEB_TEMPLATES."header.php");  	//meta data and css/script links
	include (PATH_WEB_TEMPLATES."top.php");			//top of web interface
	include (PATH_WEB_TEMPLATES."left_menu.php");	//left navigation items
	
	$feed = new Feeds();
	if(isset($_POST['submit']))
	{
		$update_feed = $feed->update_feed($_POST['feed_id'], $_POST['feed_name'], $_POST['feed_link']);
	}
	
	if(isset($_POST['submit']) && $update_feed == true)
	{
		?>
		<h1>Feed Updated Sucessfully</h1>
		<p><a href="<?=$_SERVER['HTTP_REFERER']?>" title="Back">Click here to go back</a></p>
		<?
	}
	else
	{
		if($_GET['feed_id'] !='')
		{
			$feed_id = $_GET['feed_id'];
		}
		else
		{
			$feed_id = $_POST['feed_id'];	
		}
		
		$feed->get_feed_details($feed_id);	
?>
	<h1>Edit Feed Details</h1>
	<p>* Indicated required fields.</p>
	<? 
		if($feed->is_errors == true)
		{
			$feed->show_errors(); 
		}
	?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="add_feed">
		<input type="hidden" name="feed_id" value="<?=$feed_id?>" />
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
					<td width="20%"><div align="right"><p>Feed Created:</p></div></td>
					<td>
						<p><?=date('jS, F, Y',$feed->created)?></p>
					</td>
				  </tr>
				  <tr>
					<td width="20%"><div align="right"><p>Feed Modified:</p></div></td>
					<td>
						<p><?=date('jS, F, Y',$feed->modified)?></p>
					</td>
				  </tr>
				  <tr>
					<td><div align="right"><p></p></div></td>
					<td><input type="submit" name="submit" value="Edit Feed" class="button" /></td>
				  </tr>
		</table>
	</form>	
<?
	}
	include (PATH_WEB_TEMPLATES."footer.php");		//footer and close tags
?>