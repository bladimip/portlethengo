



<?
if ( $_SERVER['REQUEST_URI'] == '/' ) $page = 'home';
else {
	$page = substr($_SERVER['REQUEST_URI'], 1);
	if ( !preg_match('/^[A-z0-9]{3,15}$/', $page) ) exit('error url');
}
session_start();

if ( file_exists('all/'.$page.'.php') ) include 'all/'.$page.'.php';
else if ( $_SESSON['ulogin'] == 1 and file_exists('auth/'.$page.'.php') ) include 'auth/'.$page.'.php';
else if ( $_SESSON['ulogin'] != 1 and file_exists('guest/'.$page.'.php') ) include 'guest/'.$page.'.php';
else exit('Error 404');

function message( $text ) {
	exit('{ "message" : "'.$text.'"}');
}

function go( $url ) {
	exit('{ "go" : "'.$url.'"}');
}

function captcha_show() {
	$questions = array(
		1 => 'The capital sity of Russia?',
		2 => 'The capital sity of Ukraine?',
		3 => 'The capital sity of USA ?',
		4 => 'Name of music king ?',
		5 => 'company who make GTA 5 ?',
		);
	$num = mt_rand(1, count($questions) );
	$_SESSION['captcha'] = $num;
	echo $questions[$num];
}


function captcha_valid() {
	$answers = array(
		1 => 'Moscow',
		2 => 'Kiev',
		3 => 'Washington',
		4 => 'Michael',
		5 => 'RockStarGames',
		);


if ( $_SESSION['captcha'] != array_search( strtolower($_POST['captcha']), $answers) )
	message('Wrong answer');
 
}



function top( $title ) {
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>'.$title.'</title>
<link  rel="stylesheet" href="http://myfirstuniappmc.azurewebsites.net/style.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script src="/script.js"></script>
</head>

<body>


<div class="wrapper">

<div class="menu">
<a href="/">Home</a>
<a href="/login">Login in</a>
<a href="/register">Registration</a>
</div>


<div class="content">
<div class="block">





';
}



function bottom() {
echo '
</div>
</div>
</div>
</body>
</html>';
}






?>