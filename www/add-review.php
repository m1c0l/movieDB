<?php
$TITLE = "Add review";
include 'includes/header.php';
if (empty($_GET['mid'])) {
	echo "<p>No movie ID specified!</p>";
}
else {
	$mid = $_GET['mid'];
	$movieSql = "SELECT * FROM Movie WHERE id=$mid";
	$movieResult = $mysqli->query($movieSql);
	if (!$movieResult || $movieResult->num_rows == 0) {
		echo "<p>Invalid movie ID</p>";
	}
	else {
		$movieRecord = $movieResult->fetch_assoc();
		echo "<h2>Add new review for ${movieRecord['title']} (${movieRecord['year']})</h2>";
		?>
		<form method="POST" action="add-review-submit.php" class="form-horizontal">
			<input type="hidden" name="mid" value="<?php echo $mid?>"/>
			<div class="form-group">
				<label for="name" class="col-sm-2">Your name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="Your name" maxlength="20" required/>
				</div>
			</div>
			<div class="form-group">
				<label for="rating" class="col-sm-2">Rating out of 5</label>
				<div class="col-sm-10">
					<select name="rating" id="rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="comment" class="col-sm-2">Comments (optional)</label>
				<div class="col-sm-10">
					<textarea id="comment" name="comment" maxlength="500" cols="50" rows="10"></textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-default">Submit rating</button>
		</form>
		<?php
	}
}
include 'includes/footer.php';
?>
