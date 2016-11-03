<?php
	SESSION_START();
	
	require_once "connection.php";
	require_once "users.php";
	
	$expected = array("name", "password");
	$required = array("name", "password");
	
	$missing = array();
	
	foreach ($_POST as $key => $value)
	{
		$temp = is_array($value) ? $value : trim($value);
		strip_tags($temp);
		htmlentities($temp, ENT_QUOTES);
		
		if (empty($temp) && in_array($key, $required))
		{
			array_push($missing, $key);
			${$key} = '';
		}
		elseif (in_array($key, expected))
		{
			
		}
	}
	
	$dbUser = new Users($conn);
	
	header("Location: ../../" . $_SESSION['currPage']);
?>