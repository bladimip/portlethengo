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

//method for fetching queries - returns query result
//used methods described in simpleDB file
function getContributions ($table, $userID) {
	$db = new Connection();
	$db->open();
	$queryResult = $db->runQuery("SELECT * FROM " . $table . " WHERE user_id = ". $userID);
	$db->close();
	return $queryResult;
}

// Navbar
top("vladTest");

//Other page content
//setting testing variable - browsed user's id:
$person = 9;

//running method for getting sql query with user data - used for getting data from one table
$user = getContributions("Users", $person);

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
//outputting all info - for testing purposes
// echo "<h1>" . $userName . "</h1>";
// echo "<h2>" . $userName . "</h2>";
// echo "<h3>" . $userName . "</h3>";
// echo "<h4>" . $userName . "</h4>";
// echo "<h5>" . $userName . "</h5>";

echo "<h2>" . $userName . "</h2>";

if ($blocked == 1) {
	echo "This account is disabled<br>";
}

if ($siteAdmin == 1) {
	echo "Site Administrator<br>";
} else if ($nkpag == 1) {
	echo "Map Admin<br>";
}

echo "User ID: " . $userID . "<br>";
echo "Registered email address: " . $email . "<br>";


if ($clubAdmin == 1) {
	echo ("Admin of following clubs: ");
	//getting administrated clubs
	$clubs = getContributions("ClubAdmins", $person);
	while ($row = $clubs->fetch_assoc()) {
		echo $row["club_id"];
	}
}

//getting added events
$events = getContributions("ClubEvents", $person);
echo "<br>Added events:<br>";
while ($row = $events->fetch_assoc()) {
	echo $row["name"] . "<br>";
}

//getting added articles
$news = getContributions("HealthNews", $person);
echo "<br>Added articles:<br>";
while ($row = $news->fetch_assoc()) {
	echo $row["title"] . "<br>";
}

//getting added locations
$locations = getContributions("Locations", $person);
echo "<br>Added locations:<br>";
while ($row = $locations->fetch_assoc()) {
	echo $row["name"] . "<br>";
}

//getting added routes
$routes = getContributions("Routes", $person);
echo "<br>Added routes:<br>";
while ($row = $routes->fetch_assoc()) {
	echo $row["name"] . "<br>";
}

// if (mysql_num_rows($routes)== 0) {
	// echo "OK";
// }

// Footer
bottom();
?>