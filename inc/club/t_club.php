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
include('ClubSiteAdminClass.php');
include('ImageClass.php');
include('EventClass.php');
include('UserClass.php');

// Navbar
top("Club name goes here");

// test variables
$userId = 2;
$clubAdmin = 0;
$nkpag = 0;
$siteAdmin = 1;

// User type variable (contributer -default, ClubAdmin of selected club or siteAdmin)
$userType = "contributor";

$thatClubId;

//Other page content
// Check if a club name is passed to this script
if (isset($_GET["club"])) {
    $clubGET = urldecode($_GET["club"]);

    //// DETERMINE A TYPE OF A USER REQUESTING A CLUB PAGE
    // Check if user is a siteAdmin
    if ($siteAdmin) {
      $userType = "siteAdmin";

    } else {
      // Check if user has a clubAdmin privilage
      if ($clubAdmin) {
        $db = new Connection();
        $db->open();
        $match = $db->runQuery("SELECT * FROM clubadmins, clubs WHERE clubadmins.user_id = ". $userId ." AND clubs.club_id = clubadmins.club_id AND clubs.name = '". $clubGET ."' LIMIT 1");
        $db->close();
        // Check if clubAdmin is an admin of selected club
        if (mysqli_num_rows($match) == 1) {
          // Change type (if this club admin is not an admin of selected club, that admin is treated as contributer)
          $userType = "clubAdmin";
        }
      }
    }
    ////

    //// GET GENERAL INFORMATION OF A CLUB
    $db = new Connection();
    $db->open();
    $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND name = '". $clubGET ."' LIMIT 1");
    $db->close();

    if (mysqli_num_rows($club) == 1) {
        while ($row = $club->fetch_assoc()) {

          $thatClubId = $row["club_id"];

          // Create a club object depending on the user type
          if ($userType == "contributor") {
              $clubObj = new Club($row["club_id"], $row["name"], $row["category"], $row["description"], $row["phone"], $row["email"], $row["address"]);

          } elseif ($userType == "clubAdmin") {
              $clubObj = new ClubAdmin($row["club_id"], $row["name"], $row["category"], $row["description"], $row["phone"], $row["email"], $row["address"]);

          } elseif ($userType == "siteAdmin") {
              $clubObj = new ClubSiteAdmin($row["club_id"], $row["name"], $row["category"], $row["description"], $row["phone"], $row["email"], $row["address"]);
          }
          // test
          //$clubObj->toString();
        }
        ////

        //// ADD ADDITIONAL INFORMATION TO A CLUB OBJECT
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

        // Add events to a club object
        while ($row = $events->fetch_assoc()) {
          $clubObj->addEvent(new Event($row["event_id"], $row["club_id"], $row["user_id"], $row["approvedBy"], $row["name"], $row["description"], $row["eventDate"], $row["status"]));
        }

        // Add available club genres (for ClubAdmin and SiteAdmin only)
        if ($clubObj instanceof ClubAdmin || $clubObj instanceof ClubSiteAdmin) {
            $db = new Connection();
            $db->open();
            $genres = $db->runQuery("SELECT * FROM clubgenre");
            $db->close();

            $genresArr = array();
            while ($row = $genres->fetch_assoc()) {
              $genresArr[$row["code"]] = $row["category"];
            }
            $clubObj->addGenres($genresArr);
        }

        if ($clubObj instanceof ClubSiteAdmin) {
            $db = new Connection();
            $db->open();
            $thatClubAdmins = $db->runQuery("SELECT * FROM users, clubadmins WHERE users.user_id = clubadmins.user_id AND clubadmins.club_id = ". $thatClubId ."");
            $db->close();

            $adminsArr = array();
            while ($row = $thatClubAdmins->fetch_assoc()) {
              $adminsArr[] = new User($row["user_id"], $row["username"]);
            }
            $clubObj->addClubAdmins($adminsArr);
            // test
            //$clubObj->toStringClubAdmins();
        }
        // test
        //$clubObj->eventsToString();
        ////

        //// GENERATE AND DISPLAY PAGE
        $clubObj->displayContent();
        ////

    } else {
          echo 'Club not found';
    }

} else {
      echo 'Club not found';
}

// Footer
bottom();
?>
