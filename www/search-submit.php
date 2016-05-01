<?php
$TITLE="Search submit";
include 'includes/header.php';
$name = $_GET['name'];
if (empty($name)) {
	echo "<p>Please go back and enter a name.</p>";
}
else {
	$nameArr = preg_split("/[\s]+/", $name); 
	$actorSql = "SELECT * FROM Actor WHERE ";
	$actorSqlArr = array();
	foreach($nameArr as $n) {
		$actorSqlArr[] = "(first LIKE '%$n%' OR last LIKE '%$n%')";
	}
	$actorSql .= implode(" AND ", $actorSqlArr);
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
			echo "<li><a href='actor-info.php?aid={$row['id']}'>{$row['first']} {$row['last']}</a></li>"; 
		}
		echo "</ul>";
	}
	$movieSql = "SELECT * FROM Movie WHERE ";
	$movieSqlArr = array();
	foreach($nameArr as $n) {
		$movieSqlArr[] = "(title LIKE '%$n%')";
	}
	$movieSql .= implode(" AND ", $movieSqlArr);
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
			echo "<li><a href='movie-info.php?mid={$row['id']}'>{$row['title']}</a></li>"; 
		}
		echo "</ul>";
	}

}
?>
<?php
include 'includes/footer.php';
?>
