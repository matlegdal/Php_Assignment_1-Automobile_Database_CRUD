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
				echo "<td><a href='edit.php?autos_id=".$row['autos_id']."'>Edit</a> / <a href='/'>Delete</a></td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<div><a href="add.php">Add a new entry</a></div>
<div><a href="logout.php">Logout</a></div>
