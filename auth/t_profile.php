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


// Navbar
top("vladTest");

//Other page content
//setting testing variable - browsed user's id:
$person = 5;

//running methods for running sql query and getting user data
//methods described in simpleDB file
$db = new Connection();
$db->open();
$user = $db->runQuery("SELECT * FROM Users WHERE user_id = '". $person ."' LIMIT 1");
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
	$password = $row["password"];
	$blocked = $row["blocked"];
}
//outputting all info - for testing purposes
echo $userID;
echo $clubAdmin;
echo $nkpag;
echo $siteAdmin;
echo $userName;
echo $email;
echo $password;
echo $blocked;

//getting administrated clubs
$db = new Connection();
$db->open();
$clubs = $db->runQuery("SELECT * FROM ClubAdmins WHERE user_id = ". $person);
$db->close();

// while ($row = $clubs->fetch_assoc()) {
	// echo = $row["club_id"];
// }

//getting added events
$db = new Connection();
$db->open();
$events = $db->runQuery("SELECT * FROM ClubEvents WHERE user_id = ". $person);
$db->close();

// while ($row = $events->fetch_assoc()) {
	// echo = $row["event_id"];
// }

//getting added articles
$db = new Connection();
$db->open();
$news = $db->runQuery("SELECT * FROM HealthNews WHERE user_id = ". $person);
$db->close();

// while ($row = $news->fetch_assoc()) {
	// echo = $row["news_id"];
// }

//getting added locations
$db = new Connection();
$db->open();
$locations = $db->runQuery("SELECT * FROM Locations WHERE user_id = ". $person);
$db->close();

// while ($row = $locations->fetch_assoc()) {
	// echo = $row["loc_id"];
// }

//getting added routes
$db = new Connection();
$db->open();
$routes = $db->runQuery("SELECT * FROM Routes WHERE user_id = ". $person);
$db->close();

// while ($row = $routes->fetch_assoc()) {
	// echo = $row["route_id"];
// }

// Footer
bottom();
?>