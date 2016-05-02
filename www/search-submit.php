<?php
$TITLE="Search submit";
include 'includes/header.php';
$name = $_GET['name'];
if (empty($name)) {
	echo "<p>Please go back and enter a name.</p>";
	echo '<a href="search.php"><button class="btn btn-default">Back</button>';
}
else {
	$escName = $mysqli->real_escape_string($name);
	$nameArr = preg_split("/[\s]+/", $escName); 

	$actorSql = "SELECT * FROM Actor WHERE ";
	$actorSqlArr = array();
	foreach($nameArr as $n) {
		$actorSqlArr[] = "(first LIKE '%$n%' OR last LIKE '%$n%')";
	}
	$actorSql .= implode(" AND ", $actorSqlArr);
	$actorSql .= " ORDER BY first";
	//echo $actorSql;
	$result = $mysqli->query($actorSql);
	if ($result->num_rows == 0) {
		echo "<p>No actors with the name $name</p>";
	}
	else {
		?>
		<p>Actor results</p>
		<ul>
		<?php 
		while ($row = $result->fetch_assoc()) {
			$first = stripslashes($row['first']);
			$last = stripslashes($row['last']);
			echo "<li><a href='actor-info.php?aid={$row['id']}'>$first $last</a></li>"; 
		}
		echo "</ul>";
	}

	$directorSql = "SELECT * FROM Director WHERE ";
	$directorSqlArr = array();
	foreach($nameArr as $n) {
		$directorSqlArr[] = "(first LIKE '%$n%' OR last LIKE '%$n%')";
	}
	$directorSql .= implode(" AND ", $directorSqlArr);
	$directorSql .= " ORDER BY first";
	$result = $mysqli->query($directorSql);
	if ($result->num_rows == 0) {
		echo "<p>No directors with the name $name</p>";
	}
	else {
		?>
		<p>Director results</p>
		<ul>
		<?php 
		while ($row = $result->fetch_assoc()) {
			$first = stripslashes($row['first']);
			$last = stripslashes($row['last']);
			echo "<li><a href='director-info.php?did={$row['id']}'>$first $last</a></li>"; 
		}
		echo "</ul>";
	}

	$movieSql = "SELECT * FROM Movie WHERE ";
	$movieSqlArr = array();
	foreach($nameArr as $n) {
		$movieSqlArr[] = "(title LIKE '%$n%')";
	}
	$movieSql .= implode(" AND ", $movieSqlArr);
	$movieSql .= " ORDER BY title";
	//echo $movieSql;
	$result = $mysqli->query($movieSql);
	if ($result->num_rows == 0) {
		echo "<p>No movies with the name $name</p>";
	}
	else {
		?>
		<p>Movie results</p>
		<ul>
		<?php 
		while ($row = $result->fetch_assoc()) {
			$title = stripslashes($row['title']);
			echo "<li><a href='movie-info.php?mid={$row['id']}'>$title</a></li>"; 
		}
		echo "</ul>";
	}

}
?>
<?php
include 'includes/footer.php';
?>
