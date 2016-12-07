<?php
/*
Developed by Vlad R
Created on 28 November 2016

Following php file displays user profile

TODO:
finalize style and layout
*/

//file contains methods for creating top and bottom
include('../inc/layouts/HTMLcomponents.php');
//file contains information and methods for DB
include('../inc/db/simpleDB.php');
//file contains function for trimming white-spaces and special characters when creating links
include('../php/functions.php');

//method for outputting approved contibutions - returns boolean which is used for message in case if no contributins made
//used methods are described in simpleDB and functions files
function getApprovedContributions ($title, $userID) {
	$db = new Connection();
	$db->open();
	
	//checking which table is needed and making according query, will return FALSE if wrong table given
	if ($title == "events") {
		$queryResult = $db->runQuery("SELECT *, Clubs.name as clubname FROM ClubGenre, Clubs, ClubEvents WHERE user_id = ". $userID . " AND approved = 1 AND code = genreCode AND Clubs.club_id = ClubEvents.club_id");
	} else if ($title == "articles") {
		$queryResult = $db->runQuery("SELECT * FROM HealthNews WHERE user_id = ". $userID . " AND approved = 1");
	} else if ($title == "locations") {
		$queryResult = $db->runQuery("SELECT * FROM Locations WHERE user_id = ". $userID . " AND approved = 1");
	} else if ($title == "routes") {
		$queryResult = $db->runQuery("SELECT * FROM Routes WHERE user_id = ". $userID . " AND approved = 1");
	} else {
		return FALSE;
	}
	
	//alternative to IF statement chain
	// switch ($title) {
    // case "events":
        // $queryResult = $db->runQuery("SELECT *, Clubs.name as clubname FROM ClubGenre, Clubs, ClubEvents WHERE user_id = ". $userID . " AND approved = 1 AND code = genreCode AND Clubs.club_id = ClubEvents.club_id");
        // break;
	// case "articles":
        // $queryResult = $db->runQuery("SELECT * FROM HealthNews WHERE user_id = ". $userID . " AND approved = 1");
        // break;
	// case "locations":
        // $queryResult = $db->runQuery("SELECT * FROM Locations WHERE user_id = ". $userID . " AND approved = 1");
        // break;
	// case "routes":
        // $queryResult = $db->runQuery("SELECT * FROM Routes WHERE user_id = ". $userID . " AND approved = 1");
        // break;
	// default:
        // return FALSE;
	// }
	
	$db->close();

	//outputting contributions and returning boolean value
	//output works only if any rows found
	if ($queryResult->num_rows >= 1) {
		echo "<br>Added " . $title . ":<br>";
		echo '<div class="collection">';
		while ($row = $queryResult->fetch_assoc()) {
			if ($title == "events") {
				echo ('<a href="/sportlethen/' . url($row["category"]) . '/' . url($row["clubname"]) . '/event/' . 'C' . url($row["club_id"]) . 'E' . url($row["event_id"]) . '" class="collection-item">' . $row["name"] . '</a>');
			}
			if ($title == "articles") {
				echo ('<a href="/health-wellbeing/' . url($row["title"]) . '-A' . url($row["news_id"]) . '" class="collection-item">' . $row["title"] . '</a>');
			}
			if ($title == "locations") {
				echo ('<a href="/map/' . url($row["name"]) . '-L' . url($row["loc_id"]) . '" class="collection-item">' . $row["name"] . '</a>');
			}
			if ($title == "routes") {
				echo ('<a href="/map/' . url($row["name"]) . '-R' . url($row["route_id"]) . '" class="collection-item">' . $row["name"] . '</a>');
			}
		}
		echo '</div>';
		return TRUE;
	} else 
		return FALSE;
}

//to identify users usernames are used as they are unique
//getting username from link:
$person = $_GET["username"];
//trimming special characters and whitespaces
//used for security reasons as well as creating valid link for users with whitespaces
$person = url($person);
//some issues with removing ampersand ("&"), after ampersand rest text dissapears (where?)
//following lines were used while trying to fix this
//$person = preg_replace('/[^A-Za-z0-9\-]/', '-', $person);
//$person = htmlspecialchars_decode($person);
//$person = str_replace("&amp","",$person);

//getting sql query with user data using his/her username
$db = new Connection();
$db->open();
$user = $db->runQuery("SELECT * FROM Users WHERE username LIKE '" . $person . "'");
$db->close();

//displaying profile page only if such user exists
if ($user->num_rows >= 1) {
	//writing queried user data into variables
	//if multiple users found (should not be possible in normal conditions), only last one in array will be shown
	while ($row = $user->fetch_assoc()) {
		$userID = $row["user_id"];
		$clubAdmin = $row["clubAdmin"];
		$nkpag = $row["nkpag"];
		$siteAdmin = $row["siteAdmin"];
		$userName = $row["username"];
		$email = $row["email"];
		$blocked = $row["blocked"];
	}

	// Navbar
	top($userName . "'s profile");

	//Other page content
	echo '<div class="container">';
    echo '<div class="section">';
    echo '<div class="row">';
	//Displaying username
	echo '<h3 class="profileTitle">' . $userName . '</h3>';

	//Displaying if user acount is blocked
	if ($blocked == 1) {
		echo '<p class="disabledTitle">This account is disabled</p><br>';
	}

	//Displaying if user is one of site admins
	if ($siteAdmin == 1) {
		echo '<p class="adminTitle">Site Administrator</p><br>';
	} else if ($nkpag == 1) {
		echo '<p class="adminTitle">Map Admin</p><br>';
	}

	//Following 2 strings will be displayed only for site admins and account owner
	if (TRUE) {//isset($_SESSION['USER_LOGIN_IN'])) {
		//$viewerUserId = $_SESSION['USER_ID'];
		//$viewerSiteAdmin = $_SESSION['USER_SITEADMIN'];
		$viewerUserId = 3;
		$viewerSiteAdmin = 0;
		if (($viewerUserId == $userID) || ($viewerSiteAdmin == TRUE)) {
			echo "User ID: " . $userID . "<br>";
			echo "Registered email address: " . $email . "<br>";
		}
	}

	//getting administrated clubs (if any)
	if ($clubAdmin == 1) {
		echo '<bold>Admin of following clubs: ';
		$db = new Connection();
		$db->open();
		$clubsAdministered = $db->runQuery("SELECT * FROM ClubAdmins, Clubs, ClubGenre WHERE Clubs.club_id = ClubAdmins.club_id AND user_id = ". $userID . " AND Clubs.genreCode = ClubGenre.code");
		$db->close();
		while ($row = $clubsAdministered->fetch_assoc()) {
			echo ('<a class="clubTitle" href="/sportlethen/' . url($row["category"]) . '/' . url($row["name"]) . '-C' . $row["club_id"] . '">' . $row["name"] . '</a>') . ' ';
		}
		echo '</bold>';
	}

	//getting added contributions that are approved
	$events = getApprovedContributions("events", $userID);
	$news = getApprovedContributions("articles", $userID);
	$locations = getApprovedContributions("locations", $userID);
	$routes = getApprovedContributions("routes", $userID);

	//outputting message if user has no approved contributions
	if (($events == 0) and ($news == 0) and ($locations == 0) and ($routes == 0)) {
		echo "<br>This user has not made any contibutions yet<br>";
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';

} else {
	//following page is displayed when user is not found
	// Navbar
	top("Ooops!");

	//Other page content
	echo "There is no user named '" . $person . "'.";
}

// Footer
bottom();
	
?>