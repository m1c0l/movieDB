<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$mysqli = new mysqli('localhost', 'cs143', '', 'CS143');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

		<link href="assets/theme.css" rel="stylesheet">

		<title><?php echo $TITLE . " | MovieDB";?></title>
	</head>
	<body role="document">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">MovieDB</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
              						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add new content<span class="caret"></span></a>
              						<ul class="dropdown-menu">
					        		<li><a href="add-actor.php">Add new actor</a></li>
					        		<li><a href="add-director.php">Add new director</a></li>
                						<li><a href="#">Something else here</a></li>
                			        	</ul>
            					</li>

						<li><a href="#about">About</a></li>
						<li><a href="search.php">Actors/Movies search</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<div class="container theme-showcase">
			<div class="jumbotron">

