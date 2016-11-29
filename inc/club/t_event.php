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
include('../php/functions.php');
include('C_eventClubAdmin.php');



// test variables(session vars) - TEST******************************
$userId = 1;
$clubAdmin = 0;
$nkpag = 0;
$siteAdmin = 1;
$blocked = 0;
$loggedIn = true;

if (isset($_GET["id"])) {
    // string containing ids of a club and event
    $strIDs = $_GET["id"];
    // split into two string separating club and event
    $arr = explode("E", $strIDs);

    // cut numbers(ids) from strings
    $clubID = preg_replace("/[^0-9]+/", '', $arr[0]);
    $eventID = preg_replace("/[^0-9]+/", '', $arr[1]);

    //// GET GENERAL INFORMATION OF EVENT
    $db = new Connection();
    $db->open();
    $event = $db->runQuery("SELECT * FROM clubevents WHERE club_id = " . $clubID . " AND event_id = ". $eventID ." LIMIT 1");
    $db->close();

    if (mysqli_num_rows($event) == 1) {
        while ($row = $event->fetch_assoc()) {

            $eId = $row["event_id"];
            $eClubId = $row["club_id"];
            $eUserId = $row["user_id"];
            $eApprovedBy = $row["approvedBy"];
            $eName = $row["name"];
            $eDescription = $row["description"];
            $eDate = $row["eventDate"];
            $eStatus = $row["approved"];


            // if session exists - TEST***************************
            if ($loggedIn) {
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
            }


            // Create a club object depending on the user type
            // Public users - first as most common
            if ($userType == "public" || $userType == "contributor") $eventObj = new Event($eId, $eClubId, $eUserId, $eApprovedBy, $eName, $eDescription, $eDate, $eStatus);
            elseif ($userType == "clubAdmin" || $userType == "siteAdmin") $eventObj = new EventAdmin($eId, $eClubId, $eUserId, $eApprovedBy, $eName, $eDescription, $eDate, $eStatus);
            else echo 'Error: privilage conflict';

        }

    }
}

// Navbar
top($eventObj->getName());

//Other page content
$eventObj->displayContent();

// Footer
bottom();
?>
