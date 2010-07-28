<?php
class Database  //handles all db connections and queries
{
	//vars to connect to db
	  private static $host_name;
	  private static $db_username;
	  private static $db_password;
	  private static $database;
	
	  // Store the single instance of Database
      private static $m_pInstance; 
	  
	  
	 //makes connection
     private function __construct()
     {
	     $host_name 	= DATABASE_HOST;
		 $db_username 	= DATABASE_USERNAME;
		 $db_password 	= DATABASE_PASSWORD;
		 $database 		= DATABASE_DB;
		 @$link = mysql_connect($host_name, $db_username, $db_password);
		 if (!$link) 
		 {
		 	 echo "There is no connection to the database!";
			 exit();
		 }
		 $my_database = mysql_select_db($database);
		 if (!$my_database) 
		 {
			 echo "Database not found";
			 exit();
		 }
    }
    
    public static function getInstance()
	{
	    if (!self::$m_pInstance)
	    {
	        self::$m_pInstance = new Database();
	    }
	
	    return self::$m_pInstance;
	} 
    
    //close the connection
    public function Close()
    {
  		mysql_close($link);
  	}
  	
	//Do mysql query
	public function Query($sql)
	{
	  $query 			= mysql_query($sql) or die(mysql_error());
	  return $query;
	}
	  
	//fetch mysql row
	public function FetchRow($query)
	{
	  $rows 			= mysql_fetch_row($query);
	  return $rows;
	 }
	 
	//fetch mysql array
	public function FetchArray($query)
	{
	  $array 			= mysql_fetch_array($query);
	  return $array;
	}
	public function Affectedrows()
	{
	  $rows 			= mysql_affected_rows();
	  return $rows;
	}
	
	//fetch mysql number of rows
	public function FetchNum($query)
	{
	  $num 				= mysql_num_rows($query);
	  return $num;
	}
	
	//fetch mysql object
	public function FetchObj($query)
	{
	  $row 				= mysql_fetch_object($query);
	  return $row;
	}
	
	//last insert id
	public function Insertid()
	{
	  $id 				= mysql_insert_id();
	  return $id;
	}
	
	public function escape_string($string)
	{
	  $string 			= mysql_real_escape_string($string);
	  return $string;
	}
	public function strip_string($string)
	{
		$string 		= stripslashes($string);
		return $string;	  
	}
  	
    
}
?>