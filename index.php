<?php
require_once 'pdo.php';
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
	return;
}

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
<table border="1">
	<thead>
		<tr>
			<th>Make</th>
			<th>Model</th>
			<th>Year</th>
			<th>Mileage</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while ($row = $autos->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>" . htmlentities($row['make']) . "</td>";
				echo "<td>" . htmlentities($row['model']) . "</td>";
				echo "<td>" . htmlentities($row['year']) . "</td>";
				echo "<td>" . htmlentities($row['mileage']) . "</td>";
				echo "<td><a href='/'>Edit</a> / <a href='/'>Delete</a></td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<div><a href="add.php">Add a new entry</a></div>
<div><a href="logout.php">Logout</a></div>

</body>
</html>