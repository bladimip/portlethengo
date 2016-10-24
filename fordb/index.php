



<?
if ( $_SERVER['REQUEST_URI'] == '/' ) $page = 'login';
else {
	$page = substr($_SERVER['REQUEST_URI'], 1);
	if ( !preg_match('/^[A-z0-9]{3,15}$/', $page) ) exit('error url');
}


$CONNECT = mysqli_connect('eu-cdbr-azure-west-a.cloudapp.net', 'b5724637a2f2fd', "f5aeeeb3", "the_first_db", "3306");
if ( !$CONNECT ) exit('MySQL error');

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

function random_str ( $num = 30 ) {
    return substr(str_shuffle('0123456789'), 0, $num);
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

function email_valid(){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        message('wrong email');
}

function password_valid(){
    if ( !preg_match('/^[A-z0-9]{10,30}$/', $_POST['password']) )
        message('Pssword 10-30 symbols');
    $_POST['password']= md5($_POST['password']);
}


function top( $title ) {
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>'.$title. '</title>
<link  rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script src="/fordb/script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=r6H8oL-lra0lgTmkg6d7pR5Assg=&callback=initMap" async defer></script>
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