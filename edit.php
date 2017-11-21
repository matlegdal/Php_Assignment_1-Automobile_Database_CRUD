<?php
require_once 'pdo.php';
session_start();

if (! isset($_SESSION['user'])) {
	die('ACCESS DENIED');
}

if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['autos_id'])) {
	
	// faire validation ici
	if (! filter_var($_POST['year'], FILTER_VALIDATE_INT) || ! filter_var($_POST['mileage'], FILTER_VALIDATE_INT)) {
		$_SESSION['error'] = 'Year and mileage must be numbers.';
		header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
	}

	// update in db
	$query = $pdo->prepare("UPDATE autos SET make = :make, model = :model, year = :year, mileage = :mileage WHERE autos_id = :autos_id");
	$query->execute(array(
		':make' => $_POST['make'],
		':model' => $_POST['model'],
		':year' => $_POST['year'],
		':mileage' => $_POST['mileage'],
		':autos_id' => $_POST['autos_id']
	));
	$_SESSION['success'] = 'Record edited';
	header('Location: index.php');
	return;
}

$query = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
$query->execute(array(':id' => $_GET['autos_id']));
$auto = $query->fetch(PDO::FETCH_ASSOC);

if ($auto === false) {
	$_SESSION['error'] = "Bad value for autos_id";
	header('Location: index.php');
	return;
}

$id = $auto['autos_id'];
$make = htmlentities($auto['make']);
$model = htmlentities($auto['model']);
$year = htmlentities($auto['year']);
$mileage = htmlentities($auto['mileage']);

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit an entry</title>
</head>
<body>
	<h1>Edit an entry</h1>

<form method="POST" action="edit.php">
	<input type="text" name="make" value="<?=$make?>" required>
	<input type="text" name="model" value="<?=$model?>" required>
	<input type="text" name="year" value="<?=$year?>" required>
	<input type="text" name="mileage" value="<?=$mileage?>" required>
	<input type="hidden" name="autos_id" value="<?=$id?>">
	<input type="submit">
</form>

<div><a href="index.php">Retour</a></div>
</body>
</html>