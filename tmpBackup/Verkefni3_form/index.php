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
			<?php 
				require_once "../resources/connection.php"; 
				require_once "../resources/Users.php";
			?>
			
			<form method="post" action="php_modules/signuptest.php">
				<p>
					<label for="firstName">First Name:</label>
					<input name="firstName" id="firstName" type="text" />
				</p>
				<p>
					<label for="lastName">Last Name:</label>
					<input name="lastName" id="lastName" type="text" />
				</p>
				<p>
					<label for="userName">Username:</label>
					<input name="userName" id="userName" type="text" />
				</p>
				<p>
					<label for="email">Email:</label>
					<input name="email" id="email" type="text" />
				</p>
				<p>
					<label for="password">Password:</label>
					<input name="password" id="password" type="text" />
				</p>
				<p>
					<input name="submit" type="submit" value="Sign Up" />
				</p>
			</form>
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