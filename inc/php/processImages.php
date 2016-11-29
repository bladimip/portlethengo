<?php
include_once('../db/simpleDB.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST["imgId"]) && isset($_POST["command"])) {
    $imgId = $_POST["imgId"];
    $command = $_POST["command"];

    $db = new Connection();
    $db->open();
    $club = $db->runQuery("DELETE FROM clubimages WHERE image_id = ". $imgId);
    $db->close();

    echo "Deleted";
  }
}
?>
