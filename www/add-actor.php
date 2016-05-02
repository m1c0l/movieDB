<?php
$TITLE="Add Actors";
include 'includes/header.php';
?>
<p>Add an actor.</p>
<form action="add-actor.php" method="POST" class="form-horizontal">
	<div class="form-group">
		<label for="first" class="col-sm-2">First name </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="first" id="first" placeholder="First name" maxlength="20" required>
		</div>
	</div>
	<div class="form-group">
		<label for="last" class="col-sm-2">Last name </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="last" id="last" placeholder="Last name" maxlength="20" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2">Sex</label>
		<div class="radio col-sm-10">
			<label><input type="radio" name="sex" value="Male" required>Male</label>
			<label><input type="radio" name="sex" value="Female" required>Female</label>
		</div>
	</div>
	<div class="form-group">
		<label for="dob" class="col-sm-2">Date of Birth</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="dob" id="dob" placeholder="yyyy-mm-dd" required>
		</div>
	</div>
	<div class="form-group">
		<label for="dod" class="col-sm-2">Date of Death</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="dod" id="dod" placeholder="yyyy-mm-dd (leave blank if still alive)">
		</div>
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
	function invalidDate($str) {
		if (!preg_match("/\d{4}-\d{2}-\d{2}/", $str)) {
			return true;
		}
		$date = date_parse($str);
		if ($date['warning_count'] != 0 || $date['error_count'] != 0) {
			return true;
		}
		return false;
	}

	if (count($_POST) > 0) {
		$first = $mysqli->real_escape_string($_POST['first']);
		$last = $mysqli->real_escape_string($_POST['last']);
		$sex = $mysqli->real_escape_string($_POST['sex']);
		$dob = $mysqli->real_escape_string($_POST['dob']);
		$dod = empty($_POST['dod']) ? NULL : $mysqli->real_escape_string($_POST['dod']);

		$good_input = true;
		$message = '';

		if (invalidDate($dob)) {
			$message = "Invalid date of birth: $dob}</p>";
			$good_input = false;
		}
		else if (!is_null($dod) && invalidDate($dod)) {
			$message = "Invalid date of death: $dod</p>";
			$good_input = false;
		}
		else {
			$id = $mysqli->query("SELECT * FROM MaxPersonID")->fetch_assoc()['id'];
			if (is_null($dod)) {
			$mysqli->query("INSERT INTO Actor(id, last, first, sex, dob, dod) VALUES($id, '$last', '$first', '$sex', '$dob', NULL)");
			}
			else {
			$mysqli->query("INSERT INTO Actor(id, last, first, sex, dob, dod) VALUES($id, '$last', '$first', '$sex', '$dob', '$dod')");
			}
			if (!empty($mysqli->error)) {
				$message = $mysqli->error;
				$good_input = false;
			}
			else {
				$mysqli->query("UPDATE MaxPersonID SET id = id + 1");
				$message = "Successfully added $first $last!";
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
