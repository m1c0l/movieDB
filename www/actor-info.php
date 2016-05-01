<?php
$TITLE="Actor info";
include 'includes/header.php';
if (empty($_GET['aid'])) {
	echo "<p>No actor id specified.</p>";
}
else {
	$aid = $_GET['aid'];
	$query = "SELECT * FROM Actor WHERE id=$aid";
	$result = $mysqli->query($query);
	if (!$result || $result->num_rows == 0) {
		echo "<p>Invalid actor id.</p>";
	}
	else {
		$record = $result->fetch_assoc();
		echo "<h3>{$record['first']} {$record['last']} information</h3>";
		echo "<p>Sex: {$record['sex']}<br/>";
		echo "Date of birth: {$record['dob']}<br/>";
		$dod = $record['dod'];
		if (!is_null($dod)) {
			echo "Date of death: $dod<br/>";
		}
		echo "</p>";
		$moviesQuery = "SELECT role, title, M.id FROM Movie as M, MovieActor as MA WHERE MA.aid=$aid AND M.id=MA.mid";
		$result = $mysqli->query($moviesQuery);
		if ($result->num_rows == 0) {
			echo "<p>This actor didn't act in any movies.</p>";
		}
		else {
			?>
			<p>Roles in movies</p>
			<ul>
			<?php
			while ($record = $result->fetch_assoc()) {
				echo "<li>Played {$record['role']} in <a href='movie-info.php?mid={$record['id']}'>{$record['title']}</a></li>";
			}
			echo "</ul>";
		}
	}
}
?>

<?php
include 'includes/footer.php';
?>
