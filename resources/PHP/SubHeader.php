<section class="submenu" style="height:auto;">
	<ul>
	<?php 
		if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']))
		{	?>
			<li><a style="height:auto;" href="#"><?php echo $_SESSION['username']; ?></a></li>
			<li><a style="height:auto;" href="<?php echo $root . "resources/PHP/ProcessLogOut.php"; ?>">Log Out</a></li>
<?php	}
		else
		{	?>
			<li><a style="height:auto;" href="<?php echo $root . "Verkefni5_gagnavinnsla/index.php" ?>">Log In</a></li>
			<li><a style="height:auto;" href="<?php echo $root . "Verkefni3_form/index.php" ?>">Sign Up</a></li>			
<?php	} ?>
	</ul>
</section>