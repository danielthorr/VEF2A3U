<?php
	use File\Upload;
	
	
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
		<section class="submenu" style="height:auto;">
			<ul>
				<li><a style="height:auto;" href="#">Log In</a></li>
				<li><a style="height:auto;" href="#">Sign Up</a></li>
			</ul>
		</section>
	
		<section class="sectionCard">
			
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