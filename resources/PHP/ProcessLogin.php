<?php
	SESSION_START();
	
	//MySql connections and methods
	require_once "connection.php";
	require_once "users.php";
	
	//Create an object of the Users class
	$dbUser = new Users($conn);
	
	//Variables to check for missing values
	$required = array("username", "password");
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
			array_push($login, ${$key} = $value);
		}
		
		//If the field should not be hidden we push the field name and value to our autocomplete array
		if (!in_array($key, $hidden) && in_array($key, $required))
		{
			array_push($autocomplete, array($key => $value));
		}
	}
	
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
		$_SESSION['success'] = $dbUser->validateUser($login[0], $login[1]);
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
	
	/*
		Keep me logged in function:
		http://stackoverflow.com/questions/1354999/keep-me-logged-in-the-best-approach/17266448#17266448
		
	*/
	
	//Here we generate a "remember me cookie" if a user has selected the "keep me logged in" option
	if (isset($_POST['rememberme']) && $_POST['rememberme'] == "Yes" && $_SESSION['success'])
	{
		//We need a connection to our custom MysqlCommands class
		require_once "MysqlCommands.php";
		
		//We create an object of the class
		$sendSql = new MysqlCommands($conn);
		
		//We send our class object to a function to create the cookie and handling the token
		GenerateRememberToken($sendSql);
	}
	
	
	//Here we handle the creation and handling of our remember me cookie
	function GenerateRememberToken($sendSql)
	{
		//We take in our username to use with our database
		$user = $_POST['username'];
		
		//We generate the token from a different function
		$token = GenerateToken();
		//We send the username and token to our database, so it can attach the token to the correct user
		$sendSql->StoreTokenForUser($user, $token);
		
		//Then we merge the user and token
		$cookie = $user . ":" . $token;
		
		//We generate a hash to use for our cookie by using the 'sha256' algorithm and combining our current cookie and a super secret string
		//which we generated and store on our fileserver
		$mac = hash_hmac('sha256', $cookie, GetSecret());
		//Now we merge our cookie with our new hash
		$cookie .= ":" . $mac;
		//Then we set the cookie and make it last for 30 days
		setcookie('rememberme', $cookie, time()+(60*60*24*30), "/");
	}
	
	//Here we generate the token for use in our cookie and to store in our database
	function GenerateToken()
	{
		//We use a do-while loop to make sure we get a cryptographically safe token
		do
		{
			$tmpToken = openssl_random_pseudo_bytes(64, $cstrong);
		}
		while ($cstrong == false);
		
		//Then we convert it to hex so we can store it as a string in our database
		$tmpToken = bin2hex($tmpToken);
		
		//And we return the token
		return $tmpToken;
	}
	
	//This is a function which gets the super secret key for our hash generation
	function GetSecret()
	{
		$myFile = fopen("../super_secret.txt", "r");
		$returnString = fread($myFile, filesize("../super_secret.txt"));
		fclose($myFile);
		return $returnString;
	}
	
	//Finally we redirect the user to the last page
<<<<<<< HEAD
	header("Location: " . $_SESSION['currPage'] . "/index.php");
=======
	header("Location: ../../" . $_SESSION['currPage']);
>>>>>>> origin/master
?>


