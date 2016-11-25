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
include('../php/functions.php');
include('C_siteAdmin.php');
include('C_image.php');
include('C_event.php');
include('C_user.php');

// test variables(session vars) - TEST******************************
$userId = 1;
$clubAdmin = 0;
$nkpag = 0;
$siteAdmin = 0;
$loggedIn = true;


// Navbar
// cut the passed code from the title (like C4 etc.)
top(isset($_GET["club"]) ? substr(str_replace("-", " ", $_GET["club"]), 0, strrpos(str_replace("-", " ", $_GET["club"]), "C", -1)) : "unknown");

//substr(str_replace("-", " ", $_GET["club"]), 0, strrpos(str_replace("-", " ", $_GET["club"]), "C", -1))

//Other page content
// Check if a club name is passed to this script
if (isset($_GET["club"])) {
    $clubGET = urldecode($_GET["club"]);
    // Get the id (last character added to the name)
    $clubGET = substr($clubGET, -1);

    $userType = "public";

    //// GET GENERAL INFORMATION OF CLUB
    $db = new Connection();
    $db->open();
    $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND club_id = '". $clubGET ."' LIMIT 1");
    $db->close();


    if (mysqli_num_rows($club) == 1) {
        while ($row = $club->fetch_assoc()) {

          $cId = $row["club_id"];
          $cName = $row["name"];
          $cCategory = $row["category"];
          $cDescription = $row["description"];
          $cPhone = $row["phone"];
          $cEmail = $row["email"];
          $cAddress = $row["address"];

          // if session exists - TEST***************************
          if ($loggedIn) {
            //// DETERMINE A TYPE OF A USER REQUESTING A CLUB PAGE
            if ($siteAdmin) {
              $userType = "siteAdmin";

            } elseif ($clubAdmin) {
                $db = new Connection();
                $db->open();
                $match = $db->runQuery("SELECT * FROM clubadmins, clubs WHERE clubadmins.user_id = ". $userId ." AND clubs.club_id = clubadmins.club_id AND clubs.name = '". $clubGET ."' LIMIT 1");
                $db->close();

                // Check if clubAdmin is an admin of selected club
                if (mysqli_num_rows($match) == 1) {
                  // If a club admin is not an admin of selected club, that admin is treated as contributer)
                  $userType = "clubAdmin";

                } else {
                    $userType = "contributor";
                }

            } else {
              $userType = "contributor";
            }
            ////
          }

          // Create a club object depending on the user type
          if ($userType == "public") {
              // Public users - first as most common
              $clubObj = new Club($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);

          } elseif ($userType == "contributor") {
              $clubObj = new ClubContributor($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);

          } elseif ($userType == "clubAdmin") {
              $clubObj = new ClubAdmin($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);

          } elseif ($userType == "siteAdmin") {
              $clubObj = new ClubSiteAdmin($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);

          } else {
            echo 'Error: privilage conflict';
          }
          // test
          //$clubObj->toString();
        }
        ////

        //// ADD ADDITIONAL COMMON INFORMATION TO A CLUB OBJECT
        // Get images of a club
        $db = new Connection();
        $db->open();
        $images = $db->runQuery("SELECT * FROM clubs,clubimages WHERE clubs.club_id = clubimages.club_id AND clubs.club_id = ". $clubObj->getId() ."");
        $db->close();

        // Add images to a club object
        while ($row = $images->fetch_assoc()) {

          $iId = $row["image_id"];
          $iClubId = $row["club_id"];
          $iImagePath = $row["imagePath"];
          $iAltName = $row["altName"];

          $clubObj->addImage(new Image($iId, $iClubId, $iImagePath, $iAltName));
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

          $eId = $row["event_id"];
          $eClubId = $row["club_id"];
          $eUserId = $row["user_id"];
          $eApprovedBy = $row["approvedBy"];
          $eName = $row["name"];
          $eDescription = $row["description"];
          $eDate = $row["eventDate"];
          $eStatus = $row["status"];

          $clubObj->addEvent(new Event($eId, $eClubId, $eUserId, $eApprovedBy, $eName, $eDescription, $eDate, $eStatus));
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
            $thatClubAdmins = $db->runQuery("SELECT * FROM users, clubadmins WHERE users.user_id = clubadmins.user_id AND clubadmins.club_id = ". $clubObj->getId() ."");
            $db->close();

            $adminsArr = array();
            while ($row = $thatClubAdmins->fetch_assoc()) {

              $uId = $row["user_id"];
              $uUsername = $row["username"];

              $adminsArr[] = new User($uId, $uUsername);
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
