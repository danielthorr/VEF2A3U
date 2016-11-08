<?php

$source = 'mysql:host=tsuts.tskoli.is;dbname=0806933629_picturebase';
$user = '0806933629';
$passw = 'letmein';

// Sjá nánar um PDO t.d.: http://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/ 
try {
	$conn = new PDO($source, $user, $passw);   
 	# Notum utf-8 og gerum það með SQL fyrirspurn exec sendir sql fyrirspurnir til database
 	$conn->exec('SET NAMES "utf8"');

} catch (PDOException $e) {
		echo 'Tenging mistókst: ' . $e->getMessage();
}

?>