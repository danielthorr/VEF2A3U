<?php
	SESSION_START();
	
	$continue = true;
	
	//Variables to check for missing values
	$required = array("firstName", "lastName", "username", "email", "password");
	//We compare variables to the hidden array to see if we want to copy it, 
	//in cases such as passwords we don't want a copy of them, we let them die
	$hidden = array("password");
	//The missing array handles empty fields
	$missing = array();
	//The autocomplete array holds the text the user entered and fills it back into the form if there is an error
	$autocomplete = array();
	//The login array handles the login information, we use it to send to our mysql server
	$login = array();
	
	foreach ($_POST as $key => $value)
	{
		$temp = is_array($value) ? $value : trim($value);
		strip_tags($temp);
		htmlentities($temp, ENT_QUOTES);
		
		//We check if a field is empty and is required for our operation
		if (empty($temp) && in_array($key, $required))
		{
			//We add the name of that field to our missing array
			array_push($missing, $key);
		}
		//If it is not empty but is in our required field we continue
		elseif (in_array($key, $required))
		{
			//We add the value to our login array to compare with our mysql database
			array_push($login, $value);
		}
		
		//If the field should not be hidden we push the field name and value to our autocomplete array
		if (!in_array($key, $hidden) && in_array($key, $required))
		{
			array_push($autocomplete, array($key => $value));
		}
	}
	
	require_once "connection.php"; 
	require_once "Users.php";
	
	$dbUsers = new Users($conn);
	
	//Variable that returns true on successful login
	$_SESSION['success'] = false;
	
	//We check if anything is missing
	if (!empty($missing))
	{
		$_SESSION['missing'] = $missing;
	}
	//If nothing is missing we can send it to our database
	else
	{
		$_SESSION['success'] = $dbUsers->newUser($login[0], $login[1], $login[3], $login[2], $login[4]);
	}
	
	//If we didn't manage to connect to our database we create a session variable to use for our autocomplete
	if (!$_SESSION['success'])
	{
		$_SESSION['autocomplete'] = $autocomplete;
	}
	//If everything worked out we destroy our autocomplete, missing and login arrays
	else
	{
		unset($_SESSION['autocomplete']);
		unset($_SESSION['missing']);
		unset($login);
	}
	
	//Finally we redirect the user to the last page
	header("Location: " . $_SESSION['currPage'] . "/index.php");
?>