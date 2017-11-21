<?php
require_once 'pdo.php';
session_start();

if (! isset($_SESSION['user'])) {
	die('ACCESS DENIED');
}

$query = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
$query->execute(array(':id' => $_GET['autos_id']));
$auto = $query->fetch(PDO::FETCH_ASSOC);

if ($auto === false) {
	$_SESSION['error'] = "Bad value for autos_id";
	header('Location: index.php');
	return;
}

if (isset($_POST['autos_id']) && isset($_POST['delete'])) {
	$query = $pdo->prepare("DELETE FROM autos WHERE autos_id = :autos_id");
	$query->execute(array(':autos_id' => $_POST['autos_id']));
	$_SESSION['success'] = "Record deleted";
	header('Location: index.php');
	return;
}

$id = $auto['autos_id'];
$make = htmlentities($auto['make']);
$model = htmlentities($auto['model']);
$year = htmlentities($auto['year']);
$mileage = htmlentities($auto['mileage']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete an entry</title>
</head>
<body>
<h1>Delete an entry</h1>
<p>Are you sure you want to delete this entry?</p>

<table border="1">
	<thead>
		<tr>
			<th>Make</th>
			<th>Model</th>
			<th>Year</th>
			<th>Mileage</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=$make?></td>
			<td><?=$model?></td>
			<td><?=$year?></td>
			<td><?=$mileage?></td>
		</tr>
	</tbody>
</table>

<form action="delete.php?autos_id=<?=$id?>" method="POST">
	<input type="hidden" name="autos_id" value="<?=$id?>">
	<input type="submit" value="Confirm deletion" name="delete">
	<a href="index.php">Retour</a>
</form>
</body>
</html>