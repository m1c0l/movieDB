<?php
$TITLE="Director info";
include 'includes/header.php';
if (empty($_GET['did'])) {
	echo "<p>No director id specified.</p>";
}
else {
	$did = $mysqli->real_escape_string($_GET['did']);
	$query = "SELECT * FROM Director WHERE id=$did";
	$result = $mysqli->query($query);
	if (!$result || $result->num_rows == 0) {
		echo "<p class='text-danger'>Invalid director id $did.</p>";
	}
	else {
		$record = $result->fetch_assoc();
		echo "<h2>{$record['first']} {$record['last']}</h2>";
		echo "Date of birth: {$record['dob']}<br/>";
		$dod = $record['dod'];
		if (!is_null($dod)) {
			echo "Date of death: $dod<br/>";
		}
		echo "</p>";
		$moviesQuery = "SELECT title, M.id FROM Movie AS M, MovieDirector AS MD WHERE MD.did=$did AND M.id=MD.mid";
		$result = $mysqli->query($moviesQuery);
		if ($result->num_rows == 0) {
			echo "<p>This director didn't direct any movies.</p>";
		}
		else {
			?>
			<p>Movies directed</p>
			<ul>
			<?php
			while ($record = $result->fetch_assoc()) {
				$id = stripslashes($record['id']);
				$title = stripslashes($record['title']);
				echo "<li><a href='movie-info.php?mid=$id'>$title</a></li>";
			}
			echo "</ul>";
		}
	}
}
?>

<?php
include 'includes/footer.php';
?>
