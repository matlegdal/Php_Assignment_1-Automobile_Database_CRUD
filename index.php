<?php
require_once 'pdo.php';
session_start();



$autos = $pdo->query("SELECT * FROM autos");

// Flash pattern
if ( isset($_SESSION['error']) ) {
    $message = '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    $message = '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignement - Automobile Database CRUD</title>
</head>
<body>
<h1>Welcome to the automobile database</h1>
<?= $message ?>
<?php
	if (!isset($_SESSION['user'])) {
		echo "<a href='login.php'>Please login first</a>";
	} else {
		require 'table_autos.php';
	}
?>
</body>
</html>