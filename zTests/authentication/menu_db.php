<?php
require_once 'session_timeout_db.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Secret menu</title>
</head>

<body>
<h1>Restricted area</h1>
<p><a href="secretpage_db.php">Another secret page</a> </p>
<?php include 'logout_db.php'; ?>
</body>
</html>
