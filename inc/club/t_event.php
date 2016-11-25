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



// test variables(session vars) - TEST******************************
$userId = 1;
$clubAdmin = 0;
$nkpag = 0;
$siteAdmin = 1;
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
            $eStatus = $row["status"];

            $eventObj = new Event($eId, $eClubId, $eUserId, $eApprovedBy, $eName, $eDescription, $eDate, $eStatus);

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
