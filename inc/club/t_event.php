<?php
/*
Event information template
Id of an event and id of a club need to be passed to this script, otherwise it won't work and an output will be 404

NOTE: club_id need to be passed as a first variable and event_id as a second variable in url. Just to make sure routing will be displayed in correct way

./inc/club/t_event.php?club=club_id?news=news_id
will look
./clubs/club/club_id/event/event_id

Script connects to a database and fetches appropriate event using a club_id and event_id
To use ORM:

$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM clubs, clubevents WHERE club_id = club_id AND event_id = event_id");
$db->close();

*/

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');
include('C_event.php');

// Navbar
top("Event title goes here");

//Other page content


// Footer
bottom();
?>
