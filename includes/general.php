<?php
	require_once( dirname(__FILE__) . '/constants.php');
	function __autoload($class_name)
	{
		require_once( dirname(__FILE__) . '/'.$class_name.'.php');
		
		/* Check to see if the include defined the class */ 
	    if (!class_exists($class_name, false)) 
	    { 
	        trigger_error("Unable to load class $class_name", E_USER_ERROR); 
	    }
	}
?>