<?php

class Feeds 
{
	public function __construct()
	{
		$this->connection 				= Database::getInstance(); 	
	}
	
	public function add_feed($feed_name, $feed_link)
	{
		$this->feed_name 				= $feed_name;
		$this->feed_link 				= $feed_link;
		
		$this->errors = array();
		
		if($this->feed_name =='' || strlen($this->feed_name) < 2 || strlen($this->feed_name) > 255)
		{
			$this->errors[] 			= "Invalid Name of feed";
		}
		if($this->feed_link =='' || strlen($this->feed_link) < 2 || strlen($this->feed_link) > 255)
		{
			$this->errors[] 			= "Invalid Feed URL";
		}
		
		if(self::is_errors() ==false)
		{
				$insert_query 			= "INSERT INTO 
													web_feeds 
														(feed_id, 
														feed_name, 
														feed_link, 
														created, 
														modified) 
													VALUES 
														('NULL', 
														'".$this->connection->escape_string($this->feed_name)."', 
														'".$this->connection->escape_string($this->feed_link)."', 
														NOW(), 
														NOW())";
			
			$query_result 				= $this->connection->Query($insert_query);
			$query_result_number 		= $this->connection->Affectedrows();
			
			if($query_result_number ==1)
			{
				return true;
			}
			else
			{
				return false;
				$this->errors[] 		= "Data failed to be inserted";
			}
		}
		else
		{
			return false;	
		}
		
	}
	
	public function show_errors()
	{
		
		foreach($this->errors as $this->error)
		{
			echo '<p class="red">'.$this->error.'</p>';
		}	
		
	}
	
	public function is_errors()
	{
		if(count($this->errors) > 0)
		{	
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	public function show_feeds()
	{
		//$conn = new Database();
			$get_feeds 					= "SELECT 
												  feed_id,
												  feed_name, 
												  UNIX_TIMESTAMP(created)as created, 
												  UNIX_TIMESTAMP(modified)as modified 
										   FROM 
										   		  web_feeds 
										   ORDER BY 
										   		  feed_name ASC";
		$get_feeds_result 				= $this->connection->Query($get_feeds);
		$get_feeds_result_number 		= $this->connection->FetchNum($get_feeds_result);
		if($get_feeds_result_number > 0)
		{
			echo '<table width="100%" align="center" cellspacing="0" cellpadding="0" border="1">
					<tr>
						<td><div align="left"><p><strong>Feed Name</strong></p></div></td>
						<td><p><strong>Date Created</strong></p></td>
						<td><p><strong>Date Modified</strong></p></td>
						<td><p><strong>Edit Feed</strong></p></td>
						<td><p><strong>View Feed Content</strong></p></td>
						<td><p><strong>CSV Export</strong></p></td>
				    </tr>';
				    
			for($a=0; $get_feeds_result_number > $a; $a++)
			{
				$row 					= $this->connection->FetchArray($get_feeds_result);
				$this->feed_name 		= $this->connection->strip_string($row['feed_name']); 
				$this->feed_id 			= $this->connection->strip_string($row['feed_id']); 
				$this->created 			= $this->connection->strip_string($row['created']);
				$this->modified 		= $this->connection->strip_string($row['modified']);
				echo '<tr>
						<td><div align="left"><p>'.$this->feed_name.'</p></div></td>
						<td><p>'.date('jS, F, Y',$this->created).'</p></td>
						<td><p>'.date('jS, F, Y',$this->modified).'</p></td>
						<td><p><a href="edit_feed.php?feed_id='.$this->feed_id.'&" title="Edit '.$this->feed_name.' Feed Details">Edit</a></p></td>
						<td><p><a href="view_feed_content.php?feed_id='.$this->feed_id.'&" title="View '.$this->feed_name.' Feed Content">View</a></p></td>
						<td><p><a href="get_csv.php?feed_id='.$this->feed_id.'&" title="Get CSV of '.$this->feed_name.'">CSV</a></p></td>
				    </tr>';
				
				
			}
			echo '</table>';
		}
		else
		{
			echo '<p>Sorry there are currently no feeds saved.</p>';	
			echo '<p>Please <a href="/add_feed.php" title="Add Feed">click here</a> to add a feed.</p>';
		}
		
	}
	
	public function get_feed_details($feed_id)
	{
		$get_feed 						= "SELECT 
												  feed_name, 
												  feed_link, 
												  UNIX_TIMESTAMP(created)as created, 
												  UNIX_TIMESTAMP(modified)as modified 
										   FROM 
										   		  web_feeds 
										   WHERE 
										   		  feed_id='".$this->connection->escape_string($feed_id)."' 
										   LIMIT 1";
		$get_feed_result 				= $this->connection->Query($get_feed);
		$this->get_feed_result_number 	= $this->connection->FetchNum($get_feed_result);
		$row 							= $this->connection->FetchArray($get_feed_result);
		$this->feed_name 				= $this->connection->strip_string($row['feed_name']); 
		$this->feed_link 				= $this->connection->strip_string($row['feed_link']); 
		$this->created 					= $this->connection->strip_string($row['created']);
		$this->modified 				= $this->connection->strip_string($row['modified']);
	}
	
	public function update_feed($feed_id, $feed_name, $feed_link)
	{
		$this->feed_id 					= $feed_id;
		$this->feed_name 				= $feed_name;
		$this->feed_link 				= $feed_link;
		
		$this->errors = array();
		
		if($this->feed_id =='' || is_numeric($this->feed_id) == false)
		{
			$this->errors[] 			= "Invalid feed id given";
		}
		if($this->feed_name =='' || strlen($this->feed_name) < 2 || strlen($this->feed_name) > 255)
		{
			$this->errors[] 			= "Invalid Name of feed";
		}
		if($this->feed_link =='' || strlen($this->feed_link) < 2 || strlen($this->feed_link) > 255)
		{
			$this->errors[] 			= "Invalid Feed URL";
		}
		
		if(self::is_errors($this->errors) ==false)
		{
			$update_query 				= "UPDATE 
												web_feeds 
										  SET 
										  		feed_name = '".$this->connection->escape_string($this->feed_name)."', 
										  		feed_link = '".$this->connection->escape_string($this->feed_link)."', 
										  		modified = NOW() 
										  WHERE 
										  		feed_id = '".$this->connection->escape_string($this->feed_id)."'";
			
			$query_result 				= $this->connection->Query($update_query);
			$query_result_number 		= $this->connection->Affectedrows();
			
			if($query_result_number ==1)
			{
				return true;
			}
			else
			{
				return false;
				$this->errors[] 		= "Data failed to be inserted";
			}
		}
		else
		{
			return false;	
		}
		
	}
	
	public function get_and_show_feed_content($feed_id)
	{
		if($feed_id =='')
		{
			echo '<h1>Feed Error</h1>';
			echo '<p>Feed id was not given!</p>';
		}
		else
		{
			$get_feed 					= "SELECT 
												  feed_name, 
												  feed_link 
										   FROM 
										   		  web_feeds 
										   WHERE 
										   		  feed_id='".$this->connection->escape_string($feed_id)."' 
										   LIMIT 1";
			$get_feed_result 			= $this->connection->Query($get_feed);
			$get_feed_result_number 	= $this->connection->FetchNum($get_feed_result);
			$row 						= $this->connection->FetchArray($get_feed_result);
			$feed_name 					= $this->connection->strip_string($row['feed_name']); 
			$feed_link 					= trim($this->connection->strip_string($row['feed_link'])); 
			
			self::show_feed_content($feed_name, $feed_link);
			  
			

		}
	}
	
	public function show_feed_content($feed_name, $feed_link)
	{
		echo '<h1>'.$feed_name.' RSS Feed</h1>';
		$rss =  simplexml_load_file($feed_link);
		
		foreach ($rss->channel as $channel) 
		{
		   foreach ($channel->item as $item) 
			{
			   foreach ($item->title as $title) 
				{
				   echo '<h2>'.$title.'</h2>';
			    }
			   foreach ($item->description as $description) 
				{
				   echo '<p>'.$description.'</p>';
			    }
		    }
	    }
	}
	
	public function get_feed_content($feed_id)
	{
			$get_feed 					= "SELECT 
												  feed_name, 
												  feed_link 
										  FROM 
										  		  web_feeds 
										  WHERE 
										  		  feed_id='".$this->connection->escape_string($feed_id)."' 
										  LIMIT 1";
			$get_feed_result 			= $this->connection->Query($get_feed);
			$get_feed_result_number 	= $this->connection->FetchNum($get_feed_result);
			$row 						= $this->connection->FetchArray($get_feed_result);
			$this->feed_name 			= $this->connection->strip_string($row['feed_name']); 
			$this->feed_link 			= trim($this->connection->strip_string($row['feed_link'])); 
	}
	
	public function generate_csv_and_show($feed_id)
	{
		if($feed_id =='')
		{
			echo '<h1>Feed Error</h1>';
			echo '<p>Feed id was not given!</p>';
			echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" title="Back">Click here to go back</a></p>';
		}
		else
		{
			self::get_feed_content($feed_id);
			
			$rss 						=  simplexml_load_file($this->feed_link);
			$csv_name_path 				=  DOCUMENT_ROOT.'csv/'.$this->feed_name.'-'.date('d-m-y').'.csv';  //file name and path
			$csv_name 					= $this->feed_name.'-'.date('d-m-y').'.csv';
		
			
			$file = fopen($csv_name_path, 'w');
			if($file == true)
			{
				foreach ($rss->channel as $channel) 
				{
				   foreach ($channel->item as $item) 
					{
					   foreach ($item->title as $title) 
						{
						   fputcsv($file, split('#', $title));
						   
					    }
					   foreach ($item->description as $description) 
						{
						   fputcsv($file, split('#', $description));
					    }
				    }
			    }
			    echo '<h1>CSV File Generated</h1>';
			    echo '<p>Download file: <a href="/csv/'.$csv_name.'" title="'.$this->feed_name.'">'.$csv_name.'</a></p>';
			    echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" title="Back">Click here to go back</a></p>';
			    fclose($file);
		    }
		    else
		    {
			    echo '<h1>Error</h1>';
				echo '<p>File generation failed!</p>';
				echo '<p><a href="'.$_SERVER['HTTP_REFERER'].'" title="Back">Click here to go back</a></p>';
		    }
		}
	}
	
	
}

?>