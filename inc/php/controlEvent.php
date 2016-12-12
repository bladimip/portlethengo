<?php
/*
Developer: Arnis Zelcs
2016
*/

session_start();

$userID = $_SESSION['USER_ID'];
$clubID = $_SESSION["club_id"];
if (isset($_SESSION["eventID"])) $eventID = $_SESSION["eventID"];


include_once('../db/simpleDB.php');
include_once('functions.php');

// To make work htmlspecialchars() function
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  if (isset($_POST["event"])) {
    $event = test_input($_POST["event"]);
  }
  if (isset($_POST["title"])) {
    $title = test_input($_POST["title"]);
  }
  if (isset($_POST["description"])) {
    $description = test_input($_POST["description"]);
  }
  if (isset($_POST["date"])) {
    $date = test_input($_POST["date"]);
  }

  // Approve
  if ($event == "Approve") {
    $db = new Connection();
    $db->open();
    $db->runQuery("UPDATE clubevents SET approvedBy = '". $userID ."', approved='1' WHERE event_id = ". $eventID);
    $db->close();

    $db = new Connection();
    $db->open();
    $user = $db->runQuery("SELECT * FROM users WHERE user_id = ". $userID ." LIMIT 1");
    $db->close();
    /*
    if (mysqli_num_rows($user) == 1) {
        while ($row = $user->fetch_assoc()) {
          echo $row["username"];
        }
     }
     */
     echo 'Approved';

  // Delete
  } elseif ($event == "Delete") {
    $db = new Connection();
    $db->open();
    $db->runQuery("DELETE FROM clubevents WHERE event_id = ". $eventID);
    $db->close();

    echo 'Deleted';

  // Add
  } elseif ($event == "add") {

    $db = new Connection();
    $db->open();

    $admin = 0;
    if ($_SESSION['USER_SITEADMIN']) $admin = 1;
    elseif ($_SESSION['USER_CLUBADMIN']) {
        $db = new Connection();
        $db->open();
        $match = $db->runQuery("SELECT * FROM clubadmins, clubs WHERE clubadmins.user_id = ". $userID ." AND clubs.club_id = clubadmins.club_id AND clubs.club_id = '". $clubID ."' LIMIT 1");
        $db->close();

        // Check if clubAdmin is an admin of selected club
        // If a club admin is not an admin of selected club, that admin is treated as contributer)
        if (mysqli_num_rows($match) == 1) $admin = 1;
    }

    $pTitle = $db->escape($title);
    $pDescription = $db->escape($description);
    $pDate = $db->escape($date);

    if ($admin) $qry = "INSERT INTO clubevents (club_id, user_id, approvedBy, name, description, eventDate, approved) VALUES ('". $clubID ."', '". $userID ."', '". $userID ."', '". $pTitle ."', '". $pDescription ."', '". date_format(new DateTime($pDate), 'Y-m-d') ."', ". 1 .")";
    else $qry = "INSERT INTO clubevents (club_id, user_id, approvedBy, name, description, eventDate, approved) VALUES ('". $clubID ."', '". $userID ."', NULL, '". $pTitle ."', '". $pDescription ."', '". date_format(new DateTime($pDate), 'Y-m-d') ."', ". 0 .")";

    $db->runQuery($qry);
    $db->close();

    echo 'Added';
  }
}
?>
