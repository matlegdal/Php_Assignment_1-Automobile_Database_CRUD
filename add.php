<?php
require_once 'pdo.php';
session_start();

if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
	
	// faire validation ici
	if (! filter_var($_POST['year'], FILTER_VALIDATE_INT) || ! filter_var($_POST['mileage'], FILTER_VALIDATE_INT)) {
		$_SESSION['error'] = 'Year and mileage must be numbers.';
		header("Location: add.php");
        return;
	}

	// insert in db
	$query = $pdo->prepare("INSERT INTO autos (make, model, year, mileage) VALUES (:make, :model, :year, :mileage)");
	$query->execute(array(
		':make' => $_POST['make'],
		':model' => $_POST['model'],
		':year' => $_POST['year'],
		':mileage' => $_POST['mileage']
	));
	$_SESSION['success'] = 'Record added';
	header('Location: index.php');
	return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add new entry</title>
</head>
<body>
	<h1>Ajouter une nouvelle automobile</h1>

<form method="POST" action="add.php">
	<input type="text" name="make" placeholder="Make" required>
	<input type="text" name="model" placeholder="Model" required>
	<input type="text" name="year" placeholder="Year" required>
	<input type="text" name="mileage" placeholder="mileage" required>
	<input type="submit">
</form>

<div><a href="index.php">Retour</a></div>
</body>
</html>