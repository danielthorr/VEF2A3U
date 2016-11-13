<?php
	SESSION_START();
	
	$_SESSION['currPage'] = dirname($_SERVER['PHP_SELF'] . "/index.php");
	
	//Variables
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
	
	//Create the current page's title
	$title = "Title not working";
	//We check if we're on the root page, which is our home page
	if (strtolower(basename($_SERVER['SCRIPT_FILENAME'])) == "root.php")
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
	<link rel="stylesheet" href="../resources/css/mainpage.css">
	<title>		<?php echo $title; ?>	</title>

</head>	
<body>

	<?php
		require_once $path . "header.php";
	?>
	
	
	<?php
		//Create an object of the image class
		require_once $path . "Images.php";
		$images = new Images();
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
	
		<section class="sectionCard" style="height:auto;padding:0;width: auto;margin-right: auto;margin-left: 20px;">
			<p style="padding:0; height:auto;"><a href="<?php echo $root . 'Verkefni4_Klasar/index.php'; ?>" style="padding:1px 0;border:1px solid black; color:white; font-size:0.8em;">Upload image</a></p>
		</section>
		
		<!-- Hér birtum við galleries hjá mismunandi notendum -->
		<?php
			if (!isset($_SESSION['username']) || empty($_SESSION['username'])){
				$user = null;
			}
			else{
				$user = $_SESSION['username'];
			}
			$imageArray = $sendSql->getImages($user);
			?>
		<section class="sectionCard">
			<?php
			foreach ($imageArray as $test)
			{
				foreach ($test as $result)
				{
					echo $result . "<br/>";
				}
			}
			?>
		</section>
		
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