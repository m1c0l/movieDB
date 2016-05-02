<?php
$TITLE="Actor/Movie Search";
include 'includes/header.php';
?>
<p>Search for movies and actors.</p>
<form action="search-submit.php">
	<div class="form-group col-sm-12">
		<input class="form-control" type="text" name="name" placeholder="Search..." required />
	</div>
	<button class="btn btn-default" type="submit">Search</button>
</form>
<?php
include 'includes/footer.php';
?>
