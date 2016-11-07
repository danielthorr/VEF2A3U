<?php
/*
PHP Solution 17-2: Authenticating a user’s credentials with a database
This PHP solution shows how to authenticate a user’s stored credentials by querying the database to find the
username’s encrypted password and then passing it as an argument to password_verify() together with the usersubmitted
password. If password_verify() returns true, the user is redirected to a restricted page.
*/

$error = '';
if (isset($_POST['login'])) {
    // use sessionm if the form has been submitted
    session_start();
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);
    // location to redirect on success, stored in a variable
    $redirect = 'http://tsuts.tskoli.is/2t/gus/vef2a3u/v5/authentication/menu_db.php';
    // authentication
    require_once 'authenticate_pdo.php';
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
<?php

if ($error) {
    echo "<p>$error</p>";
} elseif (isset($_GET['expired'])) {
    ?>
    <p>Your session has expired. Please log in again.</p>
<?php } ?>
<form method="post" action="">
    <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd">
    </p>
    <p>
        <input name="login" type="submit" id="login" value="Log in">
    </p>
</form>
</body>
</html>
