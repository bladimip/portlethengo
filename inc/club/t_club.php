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
include('ImageClass.php');
include('EventClass.php');

// Navbar
top("Club name goes here");

// test variables
$clubAdmin = 1;
$nkpag = 0;
$siteAdmin = 0;

//Other page content
if (isset($_GET["club"])) {
    $clubGET = urldecode($_GET["club"]);

    // Get general club information
    $db = new Connection();
    $db->open();
    $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND name = '". $clubGET ."' LIMIT 1");
    $db->close();

    if (mysqli_num_rows($club) == 1) {
        while ($row = $club->fetch_assoc()) {

          // Create a club object
          $clubObj = new Club($row["club_id"], $row["name"], $row["category"], $row["description"], $row["phone"], $row["email"], $row["address"]);
          // test
          //$clubObj->toString();
        }

          // Get images of a club
          $db = new Connection();
          $db->open();
          $images = $db->runQuery("SELECT * FROM clubs,clubimages WHERE clubs.club_id = clubimages.club_id AND clubs.club_id = ". $clubObj->getId() ."");
          $db->close();

          // Add images to a club object
          while ($row = $images->fetch_assoc()) {
            $clubObj->addImage(new Image($row["image_id"], $row["club_id"], $row["imagePath"], $row["altName"]));
          }
          // test
          //$clubObj->imagesToString();


          // Get events of a club
          $db = new Connection();
          $db->open();
          $events = $db->runQuery("SELECT * FROM clubs,clubevents WHERE clubs.club_id = clubevents.club_id AND clubs.club_id = ". $clubObj->getId() ."");
          $db->close();

          // Add images to a club object
          while ($row = $events->fetch_assoc()) {
            $clubObj->addEvent(new Event($row["event_id"], $row["club_id"], $row["user_id"], $row["approvedBy"], $row["name"], $row["description"], $row["eventDate"], $row["status"]));
          }
          // test
          //$clubObj->eventsToString();


          $clubObj->displayContent();

    } else {
          echo 'Club not found';
    }

} else {
      echo 'Club not found';
}

// Footer
bottom();
?>
