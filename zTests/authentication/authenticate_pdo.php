<?php
// PHP Solution 17-2: Authenticating a user’s credentials with a database

// tening við database með DatabaseManager class
// require_once 'class.datamanager.php'
// $db_man = new DatabaseManager('82.148.66.15','kennitala_picturebase','kennitala','lykilorð');


// tenging skv. bók
require_once 'connection.php';

// get the username's password from the database, ? er numbered placeholder
$sql = 'SELECT userPassword FROM users WHERE userName = ?';

// prepare statement
$stmt = $conn->prepare($sql);

// pass the input parameter as a single-element array
$stmt->execute([$username]);
$storedPwd = $stmt->fetchColumn(); // sækjum dálkinn með password

// check the submitted password against the stored version, matches a hash
// password_verify virkar ekki á tsuts.tskoli.is (eldri útgáfa af php á miðlaranum)
// if (password_verify($password, $storedPwd)) {

  if ($password === $storedPwd){
    $_SESSION['authenticated'] = 'Jethro Tull';
    // get the time the session started
    $_SESSION['start'] = time();
    session_regenerate_id();
    header("Location: $redirect"); exit;
} else {
    // if not verified, prepare error message
    $error = 'Invalid username or password';
}
