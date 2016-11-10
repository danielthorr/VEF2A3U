<?php
	use File\Upload;
	
	SESSION_START();
	
	$_SESSION['currPage'] = dirname($_SERVER['PHP_SELF'] . "/root.php");
	
	//Variables
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
	$root = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/";	
	$resources = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/";		
	//Path to our php files
	$path = $resources . "PHP/";
	
	require_once $path . "variables.php";
	
	//MySql connections
	require_once $path . "connection.php"; 
	require_once $path . "Users.php";
	require_once $path . "MysqlCommands.php";
	
	//Create a class of MysqlCommands to use
	$sendSql = new MysqlCommands($conn);
	
	//Checking if user is logged in
	require_once $path . "CheckLoggedIn.php";
	
	require_once $path . "variables.php";
	
	$title = "Title not working";
	
	//We check if we're on the root page, which is our home page
	if (strtolower($currentPage) == "root.php")
	{
		$title = "Home";
	}
	//If not we find the name of the folder we're in and take away port of it so end up with only the name of the project
	else
	{
		$titlePath = basename(dirname($_SERVER['PHP_SELF']));
		$titleName = substr($titlePath, (strpos($titlePath, '_') + 1));
		$title = ucfirst($titleName);
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="resources/css/mainpage.css">
	<title>		<?php echo $title; ?>	</title>

</head>	
<body>

	<?php
		require_once $path . "header.php";
	?>

	<section id="bgSection" style="height:auto;">
		
		<?php
			require_once $path . "SubHeader.php";
		?>
	
		<h2 class="title" style="font-size:1.5em;">
		<?php
			if (isset($_SESSION['tmpMessage']) && !empty($_SESSION['tmpMessage']))
			{
				echo $_SESSION['tmpMessage'];
				$_SESSION['tmpMessage'] = null;
				unset($_SESSION['tmpMessage']);
			}
		?>
		</h2>
	
		<section class="sectionCard">
				<?php
					if (isset($_SESSION['loggedIn']) && !empty(['loggedIn']))
					{
						?>
						<h1 class="title">Góðan daginn!</h1>
						<p>Þú ert skráð/ur inn sem <?php echo $_SESSION['username'] ?></p>
				<?php
					}
					else
					{
						?>
						<h2 class="title">Vertu velkomin</h2>
						<p>Þú ert ekki skráður inn á vefsíðuna. Ef þú hefur áhugi að gerast meðlimur vinsamlegast smelltu á "Sign Up" hnappan.</p>
						<p>Ef þú ert meðlimur og ert ekki skráður inn er hægt að gera það með því að smella á "Log In" hnappinn.</p>
				<?php
					}
					?>
		</section>
		
		<section class="sectionCard" style="height:auto; padding:20px 0px;">
			
		</section>
		
		<div>
			
		</div>
		
	</section>

	<footer style="position:relative; bottom:0;">
		<p>
			What a footer, you blow my mind!
		</p>
	</footer>

<script type="text/javascript" src="jQuery/jquery-2.2.0.js"></script>
<script type="text/javascript" src="jQuery/testScript.js"></script>
</body>
</html>