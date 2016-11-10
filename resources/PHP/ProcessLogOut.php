<?php
	SESSION_START();
	
	if (isset($_SESSION['loggedIn']))
	{
		$_SESSION['loggedIn'] = false;
		unset($_SESSION['loggedIn']);
	}
	if (isset($_SESSION['username']))
	{
		$_SESSION['username'] = "";
		unset($_SESSION['username']);
	}
	if (isset($_COOKIE['rememberme']))
	{
		unset($_COOKIE['rememberme']);
		setcookie ("rememberme", "", time() - 3600, "/");
	}
	
	if (isset($_SESSION['loggedIn']) || isset($_SESSION['username']) || isset($_COOKIE['rememberme']))
	{
		$_SESSION['tmpMessage'] = "Not fully logged out.";
	}
	else
	{
		$_SESSION['tmpMessage'] = "You have been logged out successfully.";
	}
	
	header("Location: " . $_SESSION['currPage']);
?>