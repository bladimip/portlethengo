* {margin: 0; padding: 0}


a {text-decoration: none}



p {
margin: 15px 0;
}

body, button, input[type=text], input[type=password], h1 {
font-family: 'Open Sans', sans-serif;
font-size: 16px;
}

h1 {
color:#576369;
font-size: 20px;

}

button {
background: #34C0E2;
color: #fff;
border: 1px solid #34C0E2;
padding: 8px;
border-radius: 8px;
}

button:hover {
cursor:pointer;
opacity: 0.8;
}

input[type=text], input[type=password] {
padding: 8px;
border: 1px solid #EEEFF2;
border-radius: 8px;
color: #ADB6BA;
width: 300px;
outline: none;


}

.wrapper, .content, .menu, body, html {
height: 100%;
}


.wrapper {
display: flex;
}


.content {
flex: 1;
background: #FCFCFD;
}

.block {
margin: 40px;
padding: 20px;
background: #fff;
border: 1px solid #EEEFF2;


}

.menu {
width: 200px;
background: #464E78;
}


.menu a {
display:
block; color: #fff;
padding: 10px 25px;
text-transform: uppercase;

}




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
<link type="css/text" rel="stylesheet" href="/style.css">
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