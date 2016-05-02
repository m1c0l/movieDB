<?php
$TITLE="Add Movies";
include 'includes/header.php';
$genreSql = "SELECT DISTINCT genre FROM MovieGenre ORDER BY genre";
$genreResult = $mysqli->query($genreSql);
$genreArr = array();
while ($genreRow = $genreResult->fetch_assoc()) {
	$genreArr[] = $genreRow['genre'];
}
?>
<p>Add a movie.</p>
<form action="add-movie.php" method="POST" class="form-horizontal">
	<div class="form-group">
		<label for="title" class="col-sm-2">Title </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="title" id="title" placeholder="Title" maxlength="100" required>
		</div>
	</div>
	<div class="form-group">
		<label for="year" class="col-sm-2">Year </label>
		<div class="col-sm-10">
			<input type="number" class="form-control" name="year" id="year" placeholder="Year" required>
		</div>
	</div>
	<div class="form-group">
		<label for="rating" class="col-sm-2">Rating </label>
		<div class="col-sm-10">
			<select name="rating" id="rating">
				<option value="G">G</option>
				<option value="PG">PG</option>
				<option value="PG-13">PG-13</option>
				<option value="R">R</option>
				<option value="NC-17">NC-17</option>
				<option value="surrendere">Rating Surrendered</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="company" class="col-sm-2">Company </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="company" id="company" placeholder="Company" maxlength="50" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2"><label>Genres</label></div>
		<div class="col-sm-10">
		<?php foreach($genreArr as $g) {?>
		<div class="col-sm-2">
			<input type="checkbox" name="genres[]" id="<?php echo $g;?>" value="<?php echo $g;?>" />
			<label for="<?php echo $g;?>"><?php echo $g;?></label>
		</div>
		<?php } ?>
		</div>
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
	if (count($_POST) > 0) {
		$title = $mysqli->real_escape_string($_POST['title']);
		$year = $mysqli->real_escape_string($_POST['year']);
		$rating = $_POST['rating'];
		$company = $mysqli->real_escape_string($_POST['company']);

		$good_input = true;
		$message = '';

		$id = $mysqli->query("SELECT * FROM MaxMovieID")->fetch_assoc()['id'];
		$mysqli->query("INSERT INTO Movie VALUES($id, '$title', $year, '$rating', '$company')");

		if (!empty($mysqli->error)) {
			$message = $mysqli->error;
			$good_input = false;
		}
		else {
			$mysqli->query("UPDATE MaxMovieID SET id = id + 1");
			$message = "Successfully added \"$title\"!";
			if (isset($_POST['genres'])) {
				$genresSubmitted = $_POST['genres'];
				foreach($genresSubmitted as $g) {
					$sql = "INSERT INTO MovieGenre VALUES($id, '$g')";
					//echo $sql;
					$mysqli->query($sql);
					if ($mysqli->error) {
						$good_input = false;
						//echo $mysqli->error;
					}
				}
			}
		}
		$color = $good_input ? "text-success" : "text-danger";
		$escapedMsg = stripslashes($message);
		echo "<p class=\"$color\">$escapedMsg</p>";
	}
?>

<?php
include 'includes/footer.php';
?>
