<?php
$TITLE="Add Actors";
include 'includes/header.php';
?>
<p>Add an actor.</p>
<form action="add-submit.php" method="POST" class="form-horizontal">
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
		<label class="col-sm-2">Sex</label>
		<div class="radio col-sm-10">
			<label><input type="radio" name="sex" value="Male" required>Male</label>
			<label><input type="radio" name="sex" value="Female" required>Female</label>
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
include 'includes/footer.php';
?>
