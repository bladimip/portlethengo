<?php
/*
Developed by Vlad R
Created on 28 November 2016

Following php file displays user profile

TODO:
finalize style and layout
adjust queries so that unnecessary info is not passed (password, full club details for exmaple)
add checking for recieved user ID
add viewer's status checking
display page based on viewer's status
recieve information from session
*/

//file contains methods for creating top and bottom
include('inc/layouts/HTMLcomponents.php');
//file contains information and methods for DB
include('inc/db/simpleDB.php');

//method for fetching queries - returns query result - used for getting approved queries by user
//used methods are described in simpleDB file
function getApprovedContributions ($table, $userID) {
	$db = new Connection();
	$db->open();
	$queryResult = $db->runQuery("SELECT * FROM " . $table . " WHERE user_id = ". $userID . " AND approved = 1");
	$db->close();
	return $queryResult;
}

// Navbar
top("vladTest");

//Other page content
//setting testing variable - browsed user's id:
$person = 1;

//running method for getting sql query with user data
$db = new Connection();
$db->open();
$user = $db->runQuery("SELECT * FROM Users WHERE user_id = " . $person);
$db->close();


//writing queried user data into variables
//not all data will be used in final version
while ($row = $user->fetch_assoc()) {
    $userID = $row["user_id"];
	$clubAdmin = $row["clubAdmin"];
	$nkpag = $row["nkpag"];
	$siteAdmin = $row["siteAdmin"];
    $userName = $row["username"];
	$email = $row["email"];
	//$password = $row["password"];
	$blocked = $row["blocked"];
}
//Displaying username
echo "<h2>" . $userName . "</h2>";

//Displaying if user acount is blocked
if ($blocked == 1) {
	echo "This account is disabled<br>";
}

//Displaying if user is one of site admins
if ($siteAdmin == 1) {
	echo "Site Administrator<br>";
} else if ($nkpag == 1) {
	echo "Map Admin<br>";
}

//Following 2 strings will be displayed only for admins
echo "User ID: " . $userID . "<br>";
echo "Registered email address: " . $email . "<br>";

//getting administrated clubs (if any)
if ($clubAdmin == 1) {
	echo ("Admin of following clubs: ");
	$db = new Connection();
	$db->open();
	$clubsAdministered = $db->runQuery("SELECT * FROM ClubAdmins, Clubs WHERE Clubs.club_id = ClubAdmins.club_id AND user_id = ". $person);
	$db->close();
	while ($row = $clubsAdministered->fetch_assoc()) {
		echo $row["name"] . " ";
	}
}

//getting added events that are approved
$events = getApprovedContributions("ClubEvents", $person);
if ($events->num_rows >= 1) {
	echo "<br>Added events:<br>";
	while ($row = $events->fetch_assoc()) {
		echo $row["name"] . "<br>";
	}
}

//getting added articles that are approved
$news = getApprovedContributions("HealthNews", $person);
if ($news->num_rows >= 1) {
	echo "<br>Added articles:<br>";
	while ($row = $news->fetch_assoc()) {
		echo $row["title"] . "<br>";
	}
}

//getting added locations that are approved
$locations = getApprovedContributions("Locations", $person);
if ($locations->num_rows >= 1) {
	echo "<br>Added locations:<br>";
	while ($row = $locations->fetch_assoc()) {
		echo $row["name"] . "<br>";
	}
}

//getting added routes that are approved
$routes = getApprovedContributions("Routes", $person);
if ($routes->num_rows >= 1) {
	echo "<br>Added routes:<br>";
	while ($row = $routes->fetch_assoc()) {
		echo $row["name"] . "<br>";
	}
}

//outputting message if user has no approved contributions
if (($events->num_rows == 0) and ($news->num_rows == 0) and ($locations->num_rows == 0) and ($routes->num_rows == 0)) {
	echo "<br>This user has not made any contibutions yet<br>";
}

// Footer
bottom();
?>