<?php
	SESSION_START();
	
	$continue = true;
	
	foreach ($_POST as $key => $value)
	{
		strip_tags($value);
		htmlentities($value, ENT_QUOTES);
		trim($value);
		
		if (empty($value))
		{
			echo "<p>$value is empty</p>";
			$_SESSION[$key] = "$key is empty";
			$continue = false;
		}
		else
		{
			$_SESSION[$key] = "$key is not empty";
		}
		
		echo "<p>$_SESSION[$key]</p>";
	}
	
	if ($continue)
	{
		echo "<script type='text/javascript'>alert('Success!')</script>";
		header("Location: index.php");
	}
	else
	{
		echo "<script type='text/javascript'>alert('Failed!')</script>";
		header("Location: index.php");
	}
	
?>