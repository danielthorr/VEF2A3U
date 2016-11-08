<?php
	SESSION_START();
	
<<<<<<< HEAD
	$_SESSION['currPage'] = dirname($_SERVER['PHP_SELF']);;
=======
	$_SESSION['currPage'] = "verkefni5_gagnavinnsla/index.php";
>>>>>>> origin/master
	
	//Variables
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
	$resources = $_SERVER['DOCUMENT_ROOT'] . "/2t/0806933629/2016Haust/VEF2A3U/Annarverk/resources/";		
	//Path to our php files
	$path = $resources . "PHP/";
	
	require_once $path . "variables.php";
	
	//MySql connections
	require_once $path . "/connection.php"; 
	require_once $path . "/Users.php";
	require_once $path . "MysqlCommands.php";
	
	//Create a class of MysqlCommands to use
	$sendSql = new MysqlCommands($conn);
	
	//Checking if user is logged in
	require_once $path . "CheckLoggedIn.php";
	
	//Create the current page's title
	$title = "Title not working";
	
<<<<<<< HEAD
	//We check if we're on the root page, which is our home page
=======
>>>>>>> origin/master
	if (strtolower($currentPage) == "root.php")
	{
		$title = "Home";
	}
	//If not we find the name of the folder we're in and take away port of it so end up with only the name of the project
	else
	{
<<<<<<< HEAD
		$titlePath = basename(dirname($_SERVER['PHP_SELF']));
		$titleName = substr($titlePath, (strpos($titlePath, '_') + 1));
		$title = ucfirst($titleName);
=======
		$titlePath = getcwd();
		$titleName = substr($titlePath, strpos($titlePath, '_' + 1));
		echo basename(__DIR__);
		//$title = ucfirst(glob("../"));
>>>>>>> origin/master
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

	<section id="bgSection">
		<section class="submenu">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Log In</a></li>
				<li><a href="#">Sign Up</a></li>
			</ul>
		</section>
	
		<section class="sectionCard">
			
			<?php
			//If the user has tried to log in we continue
				if (isset($_SESSION['success']))
				{
					//If the user succesfully logged in we pass in a message notifying the user
					if ($_SESSION['success'])
					{
						?>
						<p>Notandi fannst og réttar upplýsingar voru gefnar við innskráningu</p>
						<?php
					}
					//If the user has not succesfully logged in we need to make some extra checks
					else
					{
						//If there was a missing field we notify the user and output each missing field
						if (!empty($_SESSION['missing']))
						{
						?>
							<p>Innskráning mistókst, vinsamlegast fylltu inn í eftirfarandi reiti:</p>
							<?php
							foreach ($_SESSION['missing'] as $item)
							{
								echo "<p>" . $item . "</p>";
							}
						}
						//If there was no missing field there must have been incorrect information passed to the server so we notify the user
						else
						{
							?>
							<p>Innskráning mistókst, notendanafn eða lykilorð fannst ekki.</p>
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
			
			<form method="post" action="../resources/PHP/ProcessLogin.php">
				<p>
					<label for="username"></label>
					<!-- In our input fields, when needed, we check if the variable of the same name exists, 
					and fill in the value with previously entered information -->
					<input name="username" id="username" type="text" value="<?php if (isset($username)) {echo $username;}  ?>"  />
				</p>
				<p>
					<label for="password"></label>
					<input name="password" id="password" type="password"  />
				</p>
				<p>
					<input name="rememberme" id="rememberme" type="checkbox" value="Yes" checked />
					<label for="rememberme">Keep me logged in</label>
				</p>
				<input name="submit" type="submit" value="Log In"/>
			
			</form>
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
			
			
			<?php 
				
				$dbUser = new Users($conn);
				
				$users = $dbUser->userList();
				
				foreach ($users as $user)
				{
					print_r($user);
					echo "<br />";
				}
				echo "<br />";
			?>
		</section>
		
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