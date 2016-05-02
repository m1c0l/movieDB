<?php
$TITLE="Add Actors to Movies";
include 'includes/header.php';
?>
<p>Add an actor to a movie.</p>
<form action="movie-actor.php" method="POST" class="form-horizontal">
	<div class="form-group">
		<label for="actor" class="col-sm-2">Actor </label>
		<div class="col-sm-10">
			<select name="actor" id="actor">
				<?php
					$actors = $mysqli->query("SELECT * FROM Actor");
					while($a = $actors->fetch_assoc()) {
						echo "<option value=\"{$a['id']}\">{$a['first']} {$a['last']} ({$a['dob']})</option>";
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

	<div class="form-group">
		<label for="role" class="col-sm-2">Role </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="role" id="role" placeholder="Role" maxlength="50" required>
		</div>
	</div>

	<button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
	if (count($_POST) > 0) {
		$actor = $mysqli->real_escape_string($_POST['actor']);
		$movie = $mysqli->real_escape_string($_POST['movie']);
		$role = $mysqli->real_escape_string($_POST['role']);

		$good_input = true;
		$message = '';

		$mysqli->query("INSERT INTO MovieActor(mid, aid, role) VALUES($movie, $actor, '$role')");
		if (!empty($mysqli->error)) {
			$message = $mysqli->error;
			$good_input = false;
		}
		else {
			$a = $mysqli->query("SELECT * FROM Actor where id=$actor")->fetch_assoc();
			$m = $mysqli->query("SELECT * FROM Movie where id=$movie")->fetch_assoc();
			$message = "Successfully added {$a['first']} {$a['last']} as \"$role\" in \"{$m['title']}\"!";
		}

		$color = $good_input ? "text-success" : "text-danger";
		$escapedMsg = stripslashes($message);
		echo "<p class=\"$color\">$escapedMsg</p>";
	}
?>

<?php
include 'includes/footer.php';
?>
