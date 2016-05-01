<?php
$TITLE = "Add review submit";
include 'includes/header.php';
if (count($_POST) == 0) {
	echo "<p>No data submitted, please go back and try again.</p>";
}
else {
	$name = $mysqli->real_escape_string($_POST['name']);
	$rating = $_POST['rating'];
	//$comment = $_POST['comments'];
	$comment = $mysqli->real_escape_string($_POST['comment']);
	$mid = $_POST['mid'];
	$reviewSql = "INSERT INTO Review(name, mid, rating, comment) VALUES ('$name', $mid, $rating, '$comment')";
	echo $reviewSql;
	$result = $mysqli->query($reviewSql);
	if (!$result) {
		echo "<p>An error occurred, try again: {$mysqli->error}</p>";
	}
	else {
		echo "<p>Your review was submitted successfully!</p>";
	}
}
?>
<?php
include 'includes/footer.php';
?>
