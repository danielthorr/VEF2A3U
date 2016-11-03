<?php
	
	//Variables
		$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
			
		//Path to our php files
		$path = "php_modules/";
	
	$title = "Title not working";
	
	if (strtolower($currentPage) == "index.php")
	{
		$title = "Home";
	}
	else
	{
		$title = ucfirst(basename($currentPage, ".php"));
	}
	
			
	require_once "../resources/connection.php"; 
	require_once "../resources/Users.php";
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="mainpage.css">
	<title>		<?php echo $title; ?>	</title>

</head>	
<body>

	<div id="preHeader"></div>

	<?php
		include $path . "header.php";
		CreateHeader(Array("Home", "Page 1", "Page 2"), Array("index.php", "#", "#"));
	?>

	<section id="bgSection">
		<section class="submenu">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Log In</a></li>
				<li><a href="#">Sign Up</a></li>
			</ul>
		</section>
	
		<section class="sectionCard">
			
			<form method="post" action="php_modules/ProcessLogin.php">
				<p>
					<label for="username"></label>
					<input name="username" id="username" type="text"  />
				</p>
				<p>
					<label for="password"></label>
					<input name="password" id="password" type="password"  />
				</p>
				<input name="submit" type="submit" value="Log In"/>
			
			</form>
			
			
			<?php 
				
				$dbUser = new Users($conn);
				
				$user1 = $dbUser->getUser(1);
				$user2 = $dbUser->getUser(2);
				
				print_r($user1);
				echo "<br />";
				print_r($user2);
			?>
		</section>
		
		<div>
			
		</div>
		
	</section>

	<footer>
		<p>
			What a footer, you blow my mind!
		</p>
	</footer>

<script type="text/javascript" src="jQuery/jquery-2.2.0.js"></script>
<script type="text/javascript" src="jQuery/testScript.js"></script>
</body>
</html>