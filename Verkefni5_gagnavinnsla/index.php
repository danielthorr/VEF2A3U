<?php
	SESSION_START();
	
	$_SESSION['currPage'] = "verkefni5/index.php";
	
	//Variables
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
	$resources = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/";		
	//Path to our php files
	$path = $resources . "PHP/";
	
	require_once $path . "variables.php";
	
	$title = "Title not working";
	
	if (strtolower($currentPage) == "index.php")
	{
		$title = "Home";
	}
	else
	{
		$title = ucfirst(basename($currentPage, ".php"));
	}
	
	require_once $path . "/connection.php"; 
	require_once $path . "/Users.php";
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../resources/css/mainpage.css">
	<title>		<?php echo $title; ?>	</title>

</head>	
<body>

	<?php
		require_once $path . "header.php";
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
			
			<form method="post" action="../resources/PHP/ProcessLogin.php">
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
				
				$users = $dbUser->userList();
				
				foreach ($users as $user)
				{
					print_r($user);
					echo "<br />";
				}
				echo "<br />";
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