<?php
	
	$serverRoot = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/";
	$root = "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/";
	
	$dirs = array_filter(glob($serverRoot . "Verkefni*"), 'is_dir');
	
	$pages = array($root . "root.php");
	$pageNames = array("Home");
	
	foreach ($dirs as $dir)
<<<<<<< HEAD
	{		
=======
	{
		echo "<br />" . $dir . "<br />";
		
>>>>>>> origin/master
		array_push($pageNames, substr($dir, strpos($dir, '_') + 1));
		
		$tmpFile = $root . substr($dir, strpos($dir, 'Annarverk/') + 10) . "/index.php";
		array_push($pages, $tmpFile);
	}
	
?>