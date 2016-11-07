<?php
	SESSION_START();
	
	require_once "connection.php"; 
	require_once "Users.php";
	
	$continue = true;
	
	foreach ($_POST as $key => $value)
	{
		strip_tags($value);
		htmlentities($value, ENT_QUOTES);
		trim($value);
	}
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	
	$dbUsers = new Users($conn);
	
    $status = $dbUsers->newUser($firstName,$lastName,$email,$userName,$password);

    if ($status) {
		echo "<script type='text/javascript'>alert('Success!')</script>";
		header("Location: ../../root.php");
    }else{
		echo "<script type='text/javascript'>alert('Failed!')</script>";
		header("Location: ../../root.php");
    } 
	
	if ($continue)
	{
		echo "<script type='text/javascript'>alert('Success!')</script>";
		header("Location: ../../root.php");
	}
	else
	{
		echo "<script type='text/javascript'>alert('Failed!')</script>";
		header("Location: ../../root.php");
	}
	
?>