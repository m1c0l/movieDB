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
		echo "<p class='text-danger'>Invalid movie ID $mid.</p>";
	}
	else {
		$movieRecord = $movieResult->fetch_assoc();
		$directorSql = "SELECT did, first, last FROM MovieDirector as MD, Director as D WHERE MD.mid=$mid AND MD.did=D.id";
		$directorResult = $mysqli->query($directorSql);
		$directorStr = "";
		if (!$directorResult || $directorResult->num_rows == 0) {
			$directorStr = "No director listed";
		}
		else {
			$directorArr = array();
			while ($directorRow = $directorResult->fetch_assoc()) {
				$did = $directorRow['did'];
				$first = $directorRow['first'];
				$last = $directorRow['last'];
				$directorArr[] = "<a href='director-info.php?did=$did'>$first $last</a>";
			}
			$directorStr = stripslashes(implode(", ", $directorArr));
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
			$genreStr = stripslashes(implode(", ", $genreArr));
		}
		//print_r($directorResult);
		$title = stripslashes($movieRecord['title']);
		$year = stripslashes($movieRecord['year']);
		$company = stripslashes($movieRecord['company']);
		$rating = stripslashes($movieRecord['rating']);
		echo "<h2>$title ($year)</h2>";
		echo "<p>";
		echo "Directed by: $directorStr<br/>";
		echo "Produced by: $company<br/>";
		echo "Genre: $genreStr<br/>";
		echo "Rated: $rating<br/>";
		echo "</p>";

		$castSql = "SELECT A.id, first, last, role FROM MovieActor as MA, Actor as A WHERE MA.mid=$mid AND A.id=MA.aid";
		$castResult = $mysqli->query($castSql);
		if (!$castResult || $castResult->num_rows == 0) {
			echo "<p>No cast listed for this movie.</p>";
		}
		else {
			echo "<h3>Cast</h3>";
			echo "<ul>";
			while ($castRow = $castResult->fetch_assoc()) {
				$aid = stripslashes($castRow['id']);
				$first = stripslashes($castRow['first']);
				$last = stripslashes($castRow['last']);
				$role = stripslashes($castRow['role']);
				echo "<li><a href='actor-info.php?aid=$aid'>$first $last</a> as $role</li>";
			}
			echo "</ul>";
		}
		$reviewSql = "SELECT * FROM Review WHERE mid=$mid";
		$reviewResult = $mysqli->query($reviewSql);
		$reviewFirstLine = '';
		$allReviews = array();
		if (!$reviewResult || $reviewResult->num_rows == 0) {
			$reviewFirstLine = "No reviews submitted yet.";
		}
		else {
			$avgRatingSql = "SELECT AVG(rating) FROM Review WHERE mid=$mid GROUP BY mid";
			$avgRatingResult = $mysqli->query($avgRatingSql)->fetch_assoc();
			//print_r($avgRatingResult);
			$avgRatingStr = $avgRatingResult["AVG(rating)"];
			$reviewFirstLine = "Average rating: $avgRatingStr/5 from {$reviewResult->num_rows} reviews.";

			while ($reviewRow = $reviewResult->fetch_assoc()) {
				$reviewStr = "{$reviewRow['name']} rated this {$reviewRow['rating']}/5 at {$reviewRow['time']}<br/>";
				if (!empty($reviewRow['comment'])) {
					$cmt = stripslashes($reviewRow['comment']);
					$reviewStr .= "Comments: <span class='word-wrap'>$cmt</span>";
				}
				$allReviews[] = $reviewStr;
			}
		}
		echo "<h3>Reviews</h3>";
		echo "<p>";
		echo $reviewFirstLine . "<br/>";
		echo "<a href='add-review.php?mid=$mid'>Add your own review!</a>";
		foreach($allReviews as $r) {
			echo "<p>$r</p>";
		}
	}
}
?>
<style>
.word-wrap {
	word-wrap: break-word;
}
</style>
<?php
include 'includes/footer.php';
?>
