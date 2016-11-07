<?php
/* 
News article HTML template
Id of an article need to be passed to this script, otherwise it won't work and an output will be 404

./inc/news/t_news.php?id=4
Routing example: ./health-wellbeing/news/4

Script connects to a database and fetches appropriate article
To use ORM:

$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM healthnews WHERE news_id = id");
$db->close();

*/

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');

// Navbar
top("Title of article goes here");

//Other page content


// Footer
bottom();
?>

