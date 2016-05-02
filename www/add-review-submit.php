<?php
$TITLE = "Add review submit";
include 'includes/header.php';
if (count($_POST) == 0) {
	echo "<p>No data submitted, please go back and try again.</p>";
}
else {
	$name = $mysqli->real_escape_string($_POST['name']);
	$rating = $mysqli->real_escape_string($_POST['rating']);
	$comment = $mysqli->real_escape_string($_POST['comment']);
	$mid = $mysqli->real_escape_string($_POST['mid']);
	$reviewSql = "INSERT INTO Review(name, mid, rating, comment) VALUES ('$name', $mid, $rating, '$comment')";
	$result = $mysqli->query($reviewSql);
	if (!$result) {
		echo "<p>An error occurred, try again: {$mysqli->error}</p>";
	}
	else {
		echo "<p>Your review was submitted successfully!</p>";
		echo "<a href=\"movie-info.php?mid=$mid\"><button>Go Back</button>";
	}
}
?>
<?php
include 'includes/footer.php';
?>
