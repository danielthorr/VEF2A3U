<?php
	SESSION_START();
	
	$_SESSION['success'] = false;
	
	require_once "connection.php";
	require_once "users.php";
	
	$expected = array("username", "password");
	$required = array("username", "password");
	
	$missing = array();
	
	$dbUser = new Users($conn);
	
	$login = [];
	
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
		elseif (in_array($key, $expected))
		{
			array_push($login, ${$key} = $value);
		}
	}
	
	$_SESSION['success'] = $dbUser->validateUser($login[0], $login[1]);
	
	//header("Location: ../../" . $_SESSION['currPage']);
	
	/*
		Keep me logged in button:
		http://stackoverflow.com/questions/1354999/keep-me-logged-in-the-best-approach/17266448#17266448
		
	*/
	
	require_once "MysqlCommands.php";
	
	$sendSql = new MysqlCommands($conn);
	
	GenerateRememberToken($sendSql);
	
	function GenerateRememberToken($sendSql)
	{
		$user = $_POST['username'];
		
		$token = GenerateToken();
		//echo $token;
		$sendSql->StoreTokenForUser($user, $token);
		
		$cookie = $user . ":" . $token;
		
		$mac = hash_hmac('sha256', $cookie, GetSecret());
		$cookie .= ":" . $mac;
		setcookie('rememberme', $cookie, time()+60*60*24*7*30, "/");
	}
	
	function GenerateToken()
	{
		do
		{
			$tmpToken = openssl_random_pseudo_bytes(64, $cstrong);
		}
		while ($cstrong == false);
		
		$tmpToken = bin2hex($tmpToken);
			
		return $tmpToken;
	}
	
	function GetSecret()
	{
		$myFile = fopen("../super_secret.txt", "r");
		$returnString = fread($myFile, filesize("../super_secret.txt"));
		fclose($myFile);
		return $returnString;
	}
	
	
	function EchoStuff($stuff)
	{
		echo "<br/>$stuff<br/>";
	}
	
	header("Location: ../../" . $_SESSION['currPage']);
?>


