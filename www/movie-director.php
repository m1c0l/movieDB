<?php
$TITLE="Add Directors to Movies";
include 'includes/header.php';
?>
<p>Add director to a movie.</p>
<form action="movie-director.php" method="POST" class="form-horizontal">
	<div class="form-group">
		<label for="director" class="col-sm-2">Director </label>
		<div class="col-sm-10">
			<select name="director" id="director">
				<?php
					$directors = $mysqli->query("SELECT * FROM Director");
					while($d = $directors->fetch_assoc()) {
						echo "<option value=\"{$d['id']}\">{$d['first']} {$d['last']} ({$d['dob']})</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="movie" class="col-sm-2">Movie </label>
		<div class="col-sm-10">
			<select name="movie" id="movie">
				<?php
					$movies = $mysqli->query("SELECT * FROM Movie");
					while($m = $movies->fetch_assoc()) {
						echo "<option value=\"{$m['id']}\">{$m['title']} ({$m['year']})</option>";
					}
				?>
			</select>
		</div>
	</div>

	<button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
	if (count($_POST) > 0) {
		$director = $mysqli->real_escape_string($_POST['director']);
		$movie = $mysqli->real_escape_string($_POST['movie']);

		$good_input = true;
		$message = '';

		$mysqli->query("INSERT INTO MovieDirector(mid, did) VALUES($movie, $director)");
		if (!empty($mysqli->error)) {
			$message = $mysqli->error;
			$good_input = false;
		}
		else {
			$d = $mysqli->query("SELECT * FROM Director where id=$director")->fetch_assoc();
			$m = $mysqli->query("SELECT * FROM Movie where id=$movie")->fetch_assoc();
			$message = "Successfully added {$d['first']} {$d['last']} as Director in {$m['title']}!";
		}

		$color = $good_input ? "text-success" : "text-danger";
		$escapedMsg = stripslashes($message);
		echo "<p class=\"$color\">$escapedMsg</p>";
	}
?>

<?php
include 'includes/footer.php';
?>
