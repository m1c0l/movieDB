<?php
$TITLE="Add Movies";
include 'includes/header.php';
?>
<p>Add a movie.</p>
<form action="add-movie.php" method="GET" class="form-horizontal">
	<div class="form-group">
		<label for="title" class="col-sm-2">Title </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="title" placeholder="Title" maxlength="100" required>
		</div>
	</div>
	<div class="form-group">
		<label for="year" class="col-sm-2">Year </label>
		<div class="col-sm-10">
			<input type="number" class="form-control" name="year" placeholder="Year" required>
		</div>
	</div>
	<div class="form-group">
		<label for="rating" class="col-sm-2">Rating </label>
		<div class="col-sm-10">
			<select name="rating">
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
			<input type="text" class="form-control" name="company" placeholder="Company" maxlength="50" required>
		</div>
	</div>

	<button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
	if (count($_GET) > 0) {
		$title = $_GET['title'];
		$year = $_GET['year'];
		$rating = $_GET['rating'];
		$company = $_GET['company'];

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
		}
		$color = $good_input ? "text-success" : "text-danger";
		echo "<p class=\"$color\">$message</p>";
	}
?>

<?php
include 'includes/footer.php';
?>
