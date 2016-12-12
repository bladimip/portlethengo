<?php

session_start();
$userID = $_SESSION['USER_ID'];

include('../db/simpleDB.php');
include('functions.php');

// Get existing genres
$db = new Connection();
$db->open();
$genres = $db->runQuery("SELECT * FROM clubgenre");
$db->close();

$genresArr = array();
while ($row = $genres->fetch_assoc()) {
  $genresArr[] = $row["code"];
}

// Check and define variables
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $title = isset($_POST["ncTitle"]) ? test_input($_POST["ncTitle"]) : "";
  $genre = isset($_POST["ncGenre"]) ? test_input($_POST["ncGenre"]) : "";
  $description = isset($_POST["ncDescription"]) ? test_input($_POST["ncDescription"]) : "";
  $phone = isset($_POST["ncPhone"]) ? test_input($_POST["ncPhone"]) : "";
  $email = isset($_POST["ncEmail"]) ? test_input($_POST["ncEmail"]) : "";
  $address = isset($_POST["ncAddress"]) ? test_input($_POST["ncAddress"]) : "";
}

// Check values that cannot be NULL
$error = "Error(s):<br>";
if ($title == "") $error .= "Title is not provided!<br>";
if ($genre == "" || !in_array($genre, $genresArr)) $error .= "Genre is not selected or identified!<br>";
if ($address == "") $error .= "Address is not provided!<br>";

if ($error != "Error(s):<br>") echo $error;
else {

  // Insert a new club genre
  $db = new Connection();
  $db->open();
  $genres = $db->runQuery("INSERT INTO clubs (name, genreCode, description, phone, email, address, approved) VALUES ('".$title."', '".$genre."', '".$description."', '".$phone."', '".$email."', '".$address."', 0)");
  $lastID = $db->getLastID();
  $db->close();

  // Link a user with a club
  $db = new Connection();
  $db->open();
  $genres = $db->runQuery("INSERT INTO clubadmins (user_id, club_id) VALUES (".$userID.", ".$lastID.")");
  $db->close();


  //echo $title.'<br>'.$genre.'<br>'.$description.'<br>'.$phone.'<br>'.$email.'<br>'.$address;
  header('Location: /sportlethen');
}

?>
