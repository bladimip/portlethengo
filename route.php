<?php

$found = true;

if ( $_SERVER['REQUEST_URI'] == '/' ) $page = 'landing';
else {
	$page = substr($_SERVER['REQUEST_URI'], 1);
	$vardu = $page;
	if ( !preg_match('/^[A-z0-9\/-]{3,16}$/', $page) ) $found = false;
}

if ($found) {
	if ( file_exists('auth/'.$page.'.php') ) include 'auth/'.$page.'.php';
	else if ( file_exists('inc/'.$page.'.php') ) include 'inc/'.$page.'.php';
	else if ( file_exists('inc/adminpanel/'.$page.'.php') ) include 'inc/adminpanel/'.$page.'.php';
	else $found = false;
}

if (!$found) {
	echo '404';
}

?>