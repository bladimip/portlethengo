<?php
/*
Developer: Arnis Zelcs
2016
*/

session_start();

$userID = $_SESSION['USER_ID'];
$clubID = $_SESSION["club_id"];

include_once('../db/simpleDB.php');
include_once('functions.php');

// To make work htmlspecialchars() function
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  if (isset($_POST["eventID"])) {
    $eventID = test_input($_POST["eventID"]);
  }
  if (isset($_POST["event"])) {
    $event = test_input($_POST["event"]);
  }
  /*
  if (isset($_POST["userID"])) {
    $userID = test_input($_POST["userID"]);
  }
  */
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
    $delFilePath = $db->runQuery("UPDATE clubevents SET approvedBy = '". $userID ."', approved='1' WHERE event_id = ". $eventID);
    $db->close();

    $db = new Connection();
    $db->open();
    $user = $db->runQuery("SELECT * FROM users WHERE user_id = ". $userID ." LIMIT 1");
    $db->close();

    if (mysqli_num_rows($user) == 1) {
        while ($row = $user->fetch_assoc()) {
          echo $row["username"];
        }
     }

  // Delete
  } elseif ($event == "Delete") {
    $db = new Connection();
    $db->open();
    $delFilePath = $db->runQuery("DELETE FROM clubevents WHERE event_id = ". $eventID);
    $db->close();

    echo 'Deleted';

  // Add
  } elseif ($event == "add") {

    $db = new Connection();
    $db->open();

    $pTitle = $db->escape($title);
    $pDescription = $db->escape($description);
    $pDate = $db->escape($date);
/* ################################# convert to proper date format ######################################*/
    $delFilePath = $db->runQuery("INSERT INTO clubevents (club_id, user_id, approvedBy, name, description, eventDate, approved) VALUES ('". $clubID ."', '". $userID ."', '". $userID ."', '". $pTitle ."', '". $pDescription ."', '". date_format(new DateTime($pDate), 'Y-m-d') ."', ". 1 .")");
    $db->close();

    echo 'Added';
  }
}
?>
