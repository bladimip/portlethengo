<?php
/*
Developer: Arnis Zelcs
2016
*/

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
include('C_clubSiteAdmin.php');
include('C_image.php');
include('C_event.php');
include('C_user.php');


if (isset($_SESSION['USER_LOGIN_IN'])) {
  $userId = $_SESSION['USER_ID'];
  $clubAdmin = $_SESSION['USER_CLUBADMIN'];
  $nkpag = $_SESSION['USER_NKPAG'];
  $siteAdmin = $_SESSION['USER_SITEADMIN'];
  //$_SESSION['USER_LOGIN'] = $Row['username'];
  $isBlocked = $_SESSION["BLOCK"];
}
$loggedIn = isset($_SESSION['USER_LOGIN_IN']);


// Navbar
// cut the passed code from the title (like C4 etc.)
top(isset($_GET["club"]) ? substr(str_replace("-", " ", $_GET["club"]), 0, strrpos(str_replace("-", " ", $_GET["club"]), "C", -1)) : "unknown");

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

          if ($loggedIn) {

            $_SESSION["club_id"] = $cId;

            if (!$isBlocked) {
              //// DETERMINE A TYPE OF A USER REQUESTING A CLUB PAGE
              if ($siteAdmin) $userType = "siteAdmin";
              elseif ($clubAdmin) {
                  $db = new Connection();
                  $db->open();
                  $match = $db->runQuery("SELECT * FROM clubadmins, clubs WHERE clubadmins.user_id = ". $userId ." AND clubs.club_id = clubadmins.club_id AND clubs.club_id = '". $clubGET ."' LIMIT 1");
                  $db->close();

                  // Check if clubAdmin is an admin of selected club
                  // If a club admin is not an admin of selected club, that admin is treated as contributer)
                  if (mysqli_num_rows($match) == 1) $userType = "clubAdmin";
                  else $userType = "contributor";

              } else $userType = "contributor";
            } else {
              $userType = "public";
            }
          }

          // Create a club object depending on the user type
          // Public users - first as most common
          if ($userType == "public") $clubObj = new Club($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);
          elseif ($userType == "contributor") $clubObj = new ClubContributor($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);
          elseif ($userType == "clubAdmin") $clubObj = new ClubAdmin($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);
          elseif ($userType == "siteAdmin") $clubObj = new ClubSiteAdmin($cId, $cName, $cCategory, $cDescription, $cPhone, $cEmail, $cAddress);
          else echo 'Error: privilage conflict';

        }
        ////

        //Load information about club images to a club object, parameter is a an id of user currently on the page (logged in)
        $clubObj->fetchImages();
        //Load information about club events to a club object
        $clubObj->fetchEvents();


        // Add more information (for ClubAdmin and SiteAdmin only)

        //Load information about available club genres to a club object
        if ($clubObj instanceof ClubAdmin || $clubObj instanceof ClubSiteAdmin) $clubObj->fetchGenres();
        //Load information about club admins to a club object
        if ($clubObj instanceof ClubSiteAdmin) $clubObj->fetchAdmins();


        //// GENERATE AND DISPLAY PAGE
        $clubObj->displayContent();
        ////

        // Add additional javascript for admin mode only for admins (security issue)
        if ($userType == "clubAdmin" || $userType == "siteAdmin") {
          echo '<script src="/assets/js/scriptAuth.js"></script>';
        }

    } else echo 'Club not found';
} else echo 'Club not found';

// Footer
bottom();
?>
