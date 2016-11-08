<?php
/*
Clubs page

Default: ./clubs.php (no varaible passed in url)
page display all existing clubs sorted by genre

Genre selected by user: ./clubs.php?clubs_genre=genre(varaible passed in url)
user redirected to the same script with a clubs_genre variable passed in url
page display clubs of the specific genre

Example:

if (isset($_GET['clubs_genre'])) {
	$genre = $_GET['clubs_genre'];
}

$db = new Connection();
$db->open();

if (isset($genre)) {
	$result = $db->runQuery("SELECT * FROM clubs WHERE genre = ".$genre);
} else {
	$result = $db->runQuery("SELECT * FROM clubs);
}

$db->close();

*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');

// Navbar
top("Clubs and Societies");

//Other page content
$db = new Connection();
$db->open();
$clubs = $db->runQuery("SELECT * FROM clubs");
$db->close();

while ($row = $clubs->fetch_assoc()) {

}

// Footer
bottom();

?>
