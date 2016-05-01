<?php
$TITLE="Add Directors";
include 'includes/header.php';
?>
<p>Add a director.</p>
<form action="add-director.php" method="GET" class="form-horizontal">
	<div class="form-group">
		<label for="first" class="col-sm-2">First name </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="first" placeholder="First name" required>
		</div>
	</div>
	<div class="form-group">
		<label for="last" class="col-sm-2">Last name </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="last" placeholder="Last name" required>
		</div>
	</div>
	<div class="form-group">
		<label for="dob" class="col-sm-2">Date of Birth</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="dob" placeholder="yyyy-mm-dd" required>
		</div>
	</div>
	<div class="form-group">
		<label for="dod" class="col-sm-2">Date of Death</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="dod" placeholder="yyyy-mm-dd (leave blank if still alive)">
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

	if (count($_GET) > 0) {
		$first = $_GET['first'];
		$last = $_GET['last'];
		$dob = $_GET['dob'];
		$dod = empty($_GET['dod']) ? NULL : $_GET['dod'];

		$good_input = true;
		$message = '';

		if (invalidDate($dob)) {
			$message = "Invalid date of birth: $dob</p>";
			$good_input = false;
		}
		else if (!is_null($dod) && invalidDate($dod)) {
			$message = "Invalid date of death: $dod</p>";
			$good_input = false;
		}
		else {
			$id = $mysqli->query("SELECT * FROM MaxPersonID")->fetch_assoc()['id'];
			if (is_null($dod)) {
			$mysqli->query("INSERT INTO Director VALUES($id, '$first', '$last', '$dob', NULL)");
			}
			else {
			$mysqli->query("INSERT INTO Actor VALUES($id, '$first', '$last', '$dob', '$dod')");
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
		echo "<p class=\"$color\">$message</p>";
	}
?>

<?php
include 'includes/footer.php';
?>
