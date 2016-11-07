<?php

// Navigation bar
function top( $title ) {
?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<title>

		<?php echo $title; ?>
		
		</title>
		<link rel="stylesheet" href="/assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
		
		<!-- Icons -->
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
		
		<!-- MATERIALIZE -->
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
		
		<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
		
		<!-- MATERIALIZE -->
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
		
		<script src="/assets/js/script.js"></script>
	</head>

	<body>
		<div class="wrapper">
			<div class="navbar-fixed">
				<nav>
					<div class="nav-wrapper deep-purple lighten-1">
					
						<a href="/" class="left brand-logo"><span class="lnr lnr-apartment"></span>Portlethen</a>
						<ul class="right hide-on-med-and-down">
							<li><span class="waves-effect waves-light searchBtn"><span class="lnr lnr-magnifier"></span>SEARCH</span></li>
							<li><a class="waves-effect waves-light" href="/sportlethen"><span class="lnr lnr-users"></span>SPORTLETHEN</a></li>
							<li><a class="waves-effect waves-light" href="/health-wellbeing"><span class="lnr lnr-heart-pulse"></span>HEALTH & WELLBEING</a></li>
							<li><a class="waves-effect waves-light" href="/map"><span class="lnr lnr-map"></span>MAP</a></li>
						</ul>
						
						<ul class="right hide-on-large-only">
							<li><span class="waves-effect waves-light"><span class="lnr lnr-magnifier searchBtn"></span></span></li>
							<li><a class="waves-effect waves-light" href="/sportlethen"><span class="lnr lnr-users"></span></a></li>
							<li><a class="waves-effect waves-light" href="/health-wellbeing"><span class="lnr lnr-heart-pulse"></span></a></li>
							<li><a class="waves-effect waves-light" href="/map"><span class="lnr lnr-map"></span></a></li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="searchInput">
				<form>
					<input type="text" name="search">
				</form>
			</div>
			
		</div>
	
<?php
}

// Footer
function bottom() {
?>
		<footer>
			<address>Portlethen</address>
			&copy; 2016-<?php echo date("Y") ?>
		</footer>


	</body>
	</html>
	
<?php
}
?>
