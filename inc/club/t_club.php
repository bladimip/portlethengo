<?php
/*
Club information template
Id of a club need to be passed to this script, otherwise it won't work and an output will be 404

t_club.php?id=news_id

Script connects to a database and fetches appropriate club
To use ORM:

$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM clubs WHERE club_id = id");
$db->close();

*/

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');
include('ClubClass.php');

// Navbar
top("Club name goes here");

// test variables
$clubAdmin = 1;
$nkpag = 0;
$siteAdmin = 0;

//Other page content
if (isset($_GET["club"])) {
    $clubGET = urldecode($_GET["club"]);

    $db = new Connection();
    $db->open();
    $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND name = '". $clubGET ."' LIMIT 1");
    $db->close();

    if (mysqli_num_rows($club) == 1) {
        while ($row = $club->fetch_assoc()) {

          $clubObj = new Club($row["club_id"], $row["name"], $row["category"], $row["description"], $row["phone"], $row["email"], $row["address"]);
          $clubObj->displayContent();
        }

    } else {
          echo 'Club not found';
    }

} else {
      echo 'Club not found';
}

// Footer
bottom();
?>
