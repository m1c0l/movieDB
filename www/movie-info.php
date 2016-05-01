<?php
$TITLE="Movie info";
include 'includes/header.php';
if (empty($_GET['mid'])) {
	echo "<p>No movie ID specified!</p>";
}
else {
	$mid = $_GET['mid'];
	$movieSql = "SELECT * FROM Movie WHERE id=$mid";
	$movieResult = $mysqli->query($movieSql);
	if (!$movieResult || $movieResult->num_rows == 0) {
		echo "<p>Invalid movie ID</p>";
	}
	else {
		$movieRecord = $movieResult->fetch_assoc();
		$directorSql = "SELECT first, last FROM MovieDirector as MD, Director as D WHERE MD.mid=$mid AND MD.did=D.id";
		$directorResult = $mysqli->query($directorSql);
		$directorStr = "";
		if (!$directorResult || $directorResult->num_rows == 0) {
			$directorStr = "No director listed";
		}
		else {
			$directorArr = array();
			while ($directorRow = $directorResult->fetch_assoc()) {
				$directorArr[] = $directorRow['first'] . " " . $directorRow['last'];
			}
			$directorStr = implode(", ", $directorArr);
		}
		$genreSql = "SELECT genre FROM MovieGenre WHERE mid=$mid";
		$genreResult = $mysqli->query($genreSql);
		$genreStr = "";
		if (!$genreResult || $genreResult->num_rows == 0) {
			$genreStr = "No genres listed";
		}
		else {
			$genreArr = array();
			while ($genreRows = $genreResult->fetch_assoc()) {
				$genreArr[] = $genreRows['genre'];
			}
			$genreStr = implode(", ", $genreArr);
		}
		//print_r($directorResult);
		echo "<h3>${movieRecord['title']} (${movieRecord['year']}) information</h3>";
		echo "<p>";
		echo "Directed by: $directorStr<br/>";
		echo "Produced by: ${movieRecord['company']} <br/>";
		echo "Genre: $genreStr<br/>";
		echo "Rated: ${movieRecord['rating']}<br/>";
		echo "</p>";
	}
}
?>
<?php
include 'includes/footer.php';
?>
