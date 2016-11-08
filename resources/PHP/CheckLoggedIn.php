<?php
<<<<<<< HEAD
	//MySql connections
	require_once $path . "/connection.php"; 
	require_once $path . "MysqlCommands.php";
	
	//Create a class of MysqlCommands to use
	$sendSql = new MysqlCommands($conn);
=======
>>>>>>> origin/master

	if (isset($_SESSION['loggedIn']))
	{
		$cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
		if ($cookie)
		{
			list ($user, $token, $mac) = explode(":", $cookie);
			if (!hash_equals(hash_hmac('sha256', $user . ":" . $token, GetSecret()), $mac))
			{
				echo "FALSE!";
				return false;
			}
			$usertoken = $sendSql->FetchTokenByUserName($user);
			if (hash_equals($usertoken, $token))
			{
				$_SESSION['loggedIn'] = true;
				$_SESSION['username'] = $user;
			}
		}
	}
		
	function GetSecret()
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/";
		$myFile = fopen($path . "super_secret.txt", "r");
		$returnString = fread($myFile, filesize($path . "super_secret.txt"));
		fclose($myFile);
		return $returnString;
	}
?>