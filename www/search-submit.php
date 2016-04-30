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
	echo $actorSql;
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
			echo "<li>  {$row['first']} {$row['last']}"; 
		}
		echo "</ul>";
	}
}
?>
<?php
include 'includes/footer.php';
?>
