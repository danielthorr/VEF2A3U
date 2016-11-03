<?php
	
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
	<link rel="stylesheet" href="../resources/css/mainpage.css">
	<title>		<?php echo $title; ?>	</title>

</head>	
<body>

	<?php
		require_once $path . "header.php";
	?>
	
	<div id="bgSection">
		
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