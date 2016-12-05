<?php

include_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
error_reporting(0);
//check the connection!!
//if ($CONNECT) echo 'OK';
//else echo 'EROOR';


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

		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="/assets/js/materialize.js"></script>
		<script src="/assets/js/init.js"></script>
		
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
							<li><a class="waves-effect waves-light" href="/login"><span class="lnr lnr-user"></span>Login</a></li>
						</ul>
						
						<ul class="right hide-on-large-only">
							<li><span class="waves-effect waves-light"><span class="lnr lnr-magnifier searchBtn"></span></span></li>
							<li><a class="waves-effect waves-light" href="/sportlethen"><span class="lnr lnr-users"></span></a></li>
							<li><a class="waves-effect waves-light" href="/health-wellbeing"><span class="lnr lnr-heart-pulse"></span></a></li>
							<li><a class="waves-effect waves-light" href="/map"><span class="lnr lnr-map"></span></a></li>
							<li><a class="waves-effect waves-light" href="/login"><span class="lnr lnr-user"></span></a></li>
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

//Validation by Ilja
function FormChars ($p1) {
return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}


// Make password sequire
// Use password and login for sequre
function GenPass ($p1, $p2) {
return md5('MRILJA'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
}

//Check did the user log in or not
//THERE ADD MESSAGE
function ULogin($p1) {
if ($p1 <= 0 and $_SESSION['USER_LOGIN_IN'] != $p1) exit('This page aveilible only for guest');
else if ($_SESSION['USER_LOGIN_IN'] = $p1);
}


// Sending the messages to users
function MessageSend($p1, $p2) {
if ($p1 == 1) $p1 = 'Error';
else if ($p1 == 2) $p1 = 'Help';
else if ($p1 == 3) $p1 = 'Information';
$_SESSION['message'] = '<div class="chip"><b>'.$p1.'</b>: '.$p2.'</div>';
exit(header('Location: '.$_SERVER['HTTP_REFERER']));
}


// Show the messages to users
function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}

function WhoIsUser($p1) {

if ($p1 == 0) return 'No';
else if ($p1 == 1) return 'Admin';
	}

function DidTheUserAdmin($p1) {
if ($p1 <= 0 and $_SESSION['USER_SITEADMIN'] != $p1) exit('You are not the admin');
else if ($_SESSION['USER_LOGIN_IN'] = $p1) exit('Hello admin');
}

// Footer
function bottom() {
?>
		<footer class="page-footer deep-purple lighten-1">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">Portlethen</h5>
						<p class="grey-text text-lighten-4">Cras congue sodales leo in volutpat. Curabitur euismod felis dapibus nisi porta lobortis. In semper, mi vel blandit elementum, justo nisl imperdiet justo, eget tempus ligula turpis non risus. Sed orci felis, tincidunt in turpis a, viverra faucibus arcu. </p>


					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Social networks</h5>
						<ul>
							<li><a class="white-text" href="#!">Faceboook</a></li>
							<li><a class="white-text" href="#!">Twitter</a></li>
							<li><a class="white-text" href="#!">Google+</a></li>
							<li><a class="white-text" href="#!">YouTube</a></li>
						</ul>
					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Friends</h5>
						<ul>
							<li><a class="white-text" href="#!">WebPage1</a></li>
							<li><a class="white-text" href="#!">WebPage2</a></li>
							<li><a class="white-text" href="#!">WebPage3</a></li>
							<li><a class="white-text" href="#!">WebPage4</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					Made by <a class="brown-text text-lighten-3">CA2</a>
				</div>
			</div>
		</footer>


	</body>
	</html>
	
<?php
}
?>
