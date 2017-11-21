<?php
require_once 'pdo.php';
session_start();

if (isset($_SESSION['user'])) {
	$_SESSION['success'] = 'Login success!';
	header('Location: index.php');
	return;
}

if (isset($_POST['user']) && isset($_POST['password'])) {
	// validate
	if (strlen($_POST['user']) < 1) {
		$_SESSION['error'] = 'Your user name must not be blank.';
		header('Location: login.php');
		return;
	}

	if ($_POST['password'] === 'php123') {
		// set session
		$_SESSION['user'] = $_POST['user'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['success'] = 'Login success!';
		header('Location: index.php');
		return;
	} else {
		$_SESSION['error'] = 'Your password is incorrect';
		header('Location: login.php');
		return;
	}
}

if ( isset($_SESSION['error']) ) {
    $message = '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?= $message ?>

	<form action="login.php" method="POST">
		<input type="text" name="user" placeholder="user name" required>
		<input type="password" name="password" placeholder="type your password" required>
		<input type="submit" name="Login">
	</form>
	<div><a href="index.php">Retour</a></div>
</body>
</html>