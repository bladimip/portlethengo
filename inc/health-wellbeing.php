<?php
/*
Health and Wellbeing page

./health.php
page display all headings and possibly some info about each article (not all information) and other content of the page according to the design specification

./health.php
Routing example: ./health-wellbeing

Each article heading should have a link to a full information of the article (t_news.php template we are using to display an article page). news_id need to be passed as well, otherwise it won't work and output will be 404.

<a href="news/t_news.php?news_id=id">Heading of an article</a>

To use ORM:
$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM health);
$db->close();

*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');

// Navbar
top("Health and Wellbeing");

//Other page content


// Footer
bottom();

?>
