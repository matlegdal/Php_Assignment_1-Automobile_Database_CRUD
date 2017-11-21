<?php
require_once 'pdo.php';
session_start();
$autos = $pdo->query("SELECT * FROM autos");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignement - Automobile Database CRUD</title>
</head>
<body>
<h1>Welcome to the automobile database</h1>
<table>
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
</body>
</html>