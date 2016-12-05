<?php
/*
Developer: Arnis Zelcs
2016
*/

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
  if (isset($_POST["userID"])) {
    $userID = test_input($_POST["userID"]);
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
  }
}
?>
