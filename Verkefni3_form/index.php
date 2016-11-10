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
	
		<section class="sectionCard">
			<?php 				
			//If the user has tried to log in we continue
				if (isset($_SESSION['success']))
				{
					//If the user succesfully logged in we pass in a message notifying the user
					if ($_SESSION['success'])
					{
						?>
						<p>Notandi hefur verið skráður.</p>
						<?php
					}
					//If the user has not succesfully logged in we need to make some extra checks
					else
					{
						//If there was a missing field we notify the user and output each missing field
						if (!empty($_SESSION['missing']))
						{
						?>
							<p>Skráning mistókst, vinsamlegast fylltu inn í eftirfarandi reiti:</p>
							<?php
							foreach ($_SESSION['missing'] as $item)
							{
								echo "<p>" . ucfirst($item) . "</p>";
							}
						}
						//If there was no missing field there must have been incorrect information passed to the server so we notify the user
						else
						{
							?>
							<p>Skráning mistókst, einhverjir reitir eru ófullnægjandi.</p>
							<?php
						}
				
						//We make one additional check to see if any field have been fully or partially completed
						//Then we create a variable with the name of the field which we can compare against later down in the code
						if (isset($_SESSION['autocomplete']) && !empty(['autocomplete']))
						{
							//We create an array to unset later on and push our values in there
							$unsetVars = array();
							foreach ($_SESSION['autocomplete'] as $key => $value)
							{
								foreach($value as $field => $text)
								{
									${$field} = $text;
									array_push($unsetVars, ${$field});
								}
							}
						}
					}
				}
			?>
			
			<form style="padding:20px;" method="post" action="../resources/PHP/ProcessSignUp.php">
				<p>
					<label for="firstName">First Name:</label>
					<input name="firstName" id="firstName" type="text" value="<?php if (isset($firstName)) {echo $firstName;}  ?>" />
				</p>
				<p>
					<label for="lastName">Last Name:</label>
					<input name="lastName" id="lastName" type="text" value="<?php if (isset($lastName)) {echo $lastName;}  ?>" />
				</p>
				<p>
					<label for="userName">Username:</label>
					<input name="username" id="userName" type="text" value="<?php if (isset($username)) {echo $username;}  ?>" />
				</p>
				<p>
					<label for="email">Email:</label>
					<input name="email" id="email" type="email" value="<?php if (isset($email)) {echo $email;}  ?>" />
				</p>
				<p>
					<label for="password">Password:</label>
					<input name="password" id="password" type="password" />
				</p>
				<p>
					<input name="submit" type="submit" value="Sign Up" />
				</p>
			</form>
		</section>
		
		<?php
			//We then destroy all our variables to make sure there won't be any issues
			unset($_SESSION['autocomplete']);
			unset($_SESSION['missing']);
			//We loop through our dynamically created variables and unset them
			if (isset($unsetVars))
			{
				foreach ($unsetVars as $field => $value)
				{
					unset($field);
				}
			}
			//Then we unset the array holding the variables to be unset
			unset($unsetVars);
			
			//Then we unset our success variable
			if (isset($_SESSION['success']))
			{
				unset($_SESSION['success']);
			}
		?>
			
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