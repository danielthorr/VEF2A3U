<?php
	SESSION_START();
	
	$_SESSION['currPage'] = dirname($_SERVER['PHP_SELF'] . "/index.php");
	
	//Variables
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
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
	<link rel="stylesheet" href="../resources/css/mainpage.css">
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
	
	<div id="bgSection">
	
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
		
		<?php
			
			$images = 
			[
				["file" => "1.jpg", "caption" => "Spherical Lake"], 
				["file" => "2.jpg", "caption" => "Another World"], 
				["file" => "3.jpg", "caption" => "Li'l Bub"], 
				["file" => "4.jpeg", "caption" => "You have to be this small to ride"], 
				["file" => "5.jpeg", "caption" => "Crossroads"]
			];
			
			$randomNumber = rand(0, Count($images) - 1);
			$selectedImage = "images/{$images[$randomNumber]['file']}";
			$selectedCaption = $images[$randomNumber]['caption'];
		
			echo "<div class='title'>$selectedCaption</div>";
			
			echo 
				"<section style='height:auto; width:auto; max-width:95%; '>" .
					"<div id='imageBox' style='background-image:url(\"$selectedImage\");'></div>" .
					"<img src='$selectedImage' width='auto' height='auto' style='max-width:100%'></img>" .
				"</section>";
			
			include $path . "section.php";
		?>
		
	</div>

	<?php
		require_once $path . "footer.php";
	?>

<script type="text/javascript" src="jQuery/jquery-2.2.0.js"></script>
<script type="text/javascript" src="jQuery/testScript.js"></script>
</body>
</html>