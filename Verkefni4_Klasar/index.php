<?php
	use File\Upload;
	
	
	//Variables
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
	$resources = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/";		
	//Path to our php files
	$path = $resources . "PHP/";
	
	require_once $path . "variables.php";

	if (isset($_POST['upload'])) 
	{
    	echo "<pre>";
		print_r($_FILES);  # Skoðum skráarupplýsingar
		echo "</pre>";
		// define the path to the upload folder
		$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/images/";  # Þú þarft að breyta slóð. 
		// svo við getum notað class með t.d. move() fallið og getMessage() ogsfrv...
		require_once $path . 'UploadImg.php';
		// Because the object might throw an exception
		try {
			// búum til upload object til notkunar.  Sendum argument eða slóðina að upload möppunni sem á að geyma skrá
			$loader = new Upload($destination);
			// köllum á og notum move() fallið sem færir skrá í upload möppu, þurfum að gera þetta strax.
			$loader->upload();
			// köllum á getMessage til að fá skilaboð (error or not).
			$result = $loader->getMessages();

		} catch (Exception $e) {
			echo $e->getMessage();  # ef við náum ekki að nota Upload class
		}
		unset($_POST);
	}
	
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

	<section id="bgSection" style="height:auto;">
		<section class="submenu" style="height:auto;">
			<ul>
				<li><a style="height:auto;" href="#">Home</a></li>
				<li><a style="height:auto;" href="#">Log In</a></li>
				<li><a style="height:auto;" href="#">Sign Up</a></li>
			</ul>
		</section>
	
		<section class="sectionCard">
			<?php 				
				//Require bókaklasa
				require_once $path . "klasi_bok.php";
				
				//Búum til þrjú instance af bók
				$efnafraedi = new Book("Efnafræði 103", 4800);
				$staerdfraedi = new Book("Stærðfræði 303", 3200);
				$islenska = new Book("Eddukvæði", 2400);
				
				//Echo upplýsingar um bækir
				echo "<p>Titill: " . $efnafraedi->getTitle() . " - Verð: " . $efnafraedi->getPrice() . " </p>";
				echo "<p>Titill: " . $staerdfraedi->getTitle() . " - Verð: " . $staerdfraedi->getPrice() . " </p>";
				echo "<p>Titill: " . $islenska->getTitle() . " - Verð: " . $islenska->getPrice() . " </p>";
				
				//Búum til nýtt instance af klasanum ExtBook sem erfir frá Book
				$erfdafraedi = new ExtBook("efnafræði fyrir vefhönnun", 9990, "php panda");
				
				//Echo út upplýsingar um nýju bókina með publisher
				echo "<p style='padding-bottom:40px;'>Titill: " . $erfdafraedi->getTitle() . " - Verð: " . $erfdafraedi->getPrice() . " - Útgefandi: " . $erfdafraedi->getPublisher() . "</p>";
				
				
				//Hér erum við að nota file upload klasann
				// Keyrir bara ef það er búið að smella á submit 
				if (isset($result)) {
					echo '<ul>';
					//  Birta skilboðin úr messages array (Upload class).
					foreach ($result as $message) {
						echo "<li><p>$message</p></li>";
					}
					echo '</ul>';
				}
			?>
			
			<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
				<p>
					<label for="image">Upload image:</label>
					<input type="file" name="image" id="image">
				</p>
				<p>
					<input type="submit" name="upload" id="upload" value="Upload">
				</p>
			</form>
			
		</section>
		
		<section class="sectionCard" style="height:auto; padding:20px 0px;">
			<?php
				$images = glob("../resources/images/" . "*.*");
				
				foreach ($images as $image)
				{
					echo "<image src='$image' style='max-width:800px; padding: 0px 20px;'/>";
				}
			?>
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