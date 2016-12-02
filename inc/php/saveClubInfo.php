<?php
/*
Developer: Arnis Zelcs
2016
*/

include_once('../db/simpleDB.php');

  // To make work htmlspecialchars() function
	header('Content-Type: text/plain');

  // Sanitise data
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

  $title = $genre = $description = $phone = $email = $address = "not set";
  $error = "";

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["clubID"])) {
      $clubID = filter_var(test_input($_POST["clubID"]), FILTER_SANITIZE_NUMBER_INT);
    } else {
      $error .= "#club is not identified";
    }

    if (isset($_POST["title"]) && $_POST["title"] != "") {
      $title = test_input($_POST["title"]);
    } else {
      $error .= "#title is not set";
    }

    // Length of code is set to 2
    if (isset($_POST["genre"]) && strlen($_POST["genre"]) == 2) {
      $genre = test_input($_POST["genre"]);
    } else {
      $error .= "#genre is not set";
    }

    if (isset($_POST["description"])  && $_POST["description"] != "") {
      $description = test_input($_POST["description"]);
    } else {
      $error .= "#description is not set";
    }

    if (isset($_POST["phone"])) {
      $phone  = filter_var(test_input($_POST["phone"]), FILTER_SANITIZE_NUMBER_INT);
    } else {
      $error .= "#phone is not set";
    }

    if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && $_POST["email"] != "") {
      $email = test_input($_POST["email"]);
    } else {
      $error .= "#email is not set or not valid";
    }

    if (isset($_POST["address"])) {
      $address = test_input($_POST["address"]);
    } else {
      $error .= "#address is not set";
    }

    if ($error != "") echo $error;
    else {
      $db = new Connection();
      $db->open();
      $club = $db->runQuery("UPDATE clubs SET name='".$title."', genreCode='".$genre."', description='".$description."', phone='".$phone."', email='".$email."', address='".$address."' WHERE club_id=".$clubID);
      $db->close();
      
      echo "Saved";
    }

  }
?>
