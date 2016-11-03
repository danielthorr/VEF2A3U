<?php
# Að tengjast MySQl með PHP bls. 96-105 í PHP & MySQL, novice to ninja
# tenging við database með PDO, http://php.net/manual/en/intro.pdo.php


# Ef þú sleppur að nota catch þá hættir php að keyra ef villa og birtir ljóta kóðameldingu handa notanda
try{

	# Hér þarf að koma tegund og nafn á gagnagrunni
	$source = 'mysql:host=tsuts.tskoli.is;dbname=kennitala_highscores';  
	# Notendanafn (kennitala)
	$user = 'kennitala';
	# lykilorð (mypassword)
	$password = 'lykilorð';

	# notum pdo class til fyrir tengingu
	$pdo = new PDO($source, $user, $password);

	# stillum af hvernig hann meðhöndlar villur
	# Það sem er í sviganum eru fastar, :: segir til um að þetta séu fastar sem eru hluti af PDO klasanum 
	# línan þýðir: ,,We want to set the PDO attribute that control the error mode (Attr_ERRMODE) to the mode (ERRMODE_EXCEPTION)that throws exceptions 
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	# Við getum notað exec fyrir INSERT; UPDATE og DELETE
	# notum utf-8 og gerum það með exec() sem sendir sql skipun til gagnagrunns.
	$pdo->exec('SET NAMES "utf8"');

}
catch (PDOException $e){
	
	# Skemmtilegri skilaboð til notanda sjá kóða t.d. bls. 99
	echo "tenging tókst ekki". "<br>" . $e->getMessage();
	
}
?>