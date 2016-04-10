<!DOCTYPE html>
<html>
<head>
	<title>CS143 Project 1A</title>
</head>
<body>
	<?php $query = $_GET['query'] ?>
	<form action="." method="GET">
		<textarea cols="80" rows="10" name="query"><?php echo $query ?></textarea>
		<br>
		<input type="submit" value="Submit">
	</form>

	<?php
	if ($query) {
		echo $query;
		echo "<table></table>";
	}
	?>
</body>
</html>
