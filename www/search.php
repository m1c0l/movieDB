<?php
$TITLE="Actor/Movie Search";
include 'includes/header.php';
?>
<p>Search for movies and actors.</p>
<form action="search-submit.php">
	<input type="text" name="name"/>
	<button type="submit">Search</button>
</form>
<?php
include 'includes/footer.php';
?>
