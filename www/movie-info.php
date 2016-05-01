<?php
$TITLE="Movie info";
include 'includes/header.php';
if (empty($_GET['mid'])) {
	echo "<p>No movie ID specified!</p>";
}
else {
	$mid = $_GET['mid'];
	$sql = "SELECT * FROM Movie WHERE id=$mid";
	$result = $mysqli->query($sql);
	if (!$result || $result->num_rows == 0) {
		echo "<p>Invalid movie ID</p>";
	}
	else {
		$record = $result->fetch_assoc();
		echo "<h3>${record['title']} (${record['year']}) information</h3>";
		echo "<p>Directed by: <br/>";
		echo "Produced by: ${record['company']} <br/>";
		echo "Genre: <br/>";
	}
}
?>
<?php
include 'includes/footer.php';
?>
