<?php
// Sjá bls. 466,  PHP Solution 17-1: Creating a User Registration Form
if (isset($_POST['register'])) {

    require_once 'connection.php';  // Býr til PDO object, $conn fyrir tengingu við db
    require_once 'Users.php';       // User class með db aðferðum
    require_once 'process.php';     // php validation og db user method köll.

}?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Register user</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<h1>Register user</h1>
<?php
if (isset($success)) {
    echo "<p>$success</p>";
} elseif (isset($errors) && !empty($errors)) {
    echo '<ul>';
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo '</ul>';
?>
<form method="post" action="">
    <p>
        <label for="username">firstname:</label>
        <input type="text" name="firstname" id="firstname" required>
    </p>
      <p>
        <label for="username">lastname:</label>
        <input type="text" name="lastname" id="lastname" required>
    </p>
    <p>
        <label for="username">email:</label>
        <input type="text" name="email" id="email" required>
    </p>
     <p>
        <label for="username">username:</label>
        <input type="text" name="username" id="username" required>
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="password" id="password" required>
    </p>
 
    <p>
        <input name="register" type="submit" id="register" value="Register">
    </p>
</form>
<?php } ?>
</body>
</html>
