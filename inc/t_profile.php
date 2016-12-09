<?php
/*
Developed by Vlad R
Created on 28 November 2016

Following php file displays user profile

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
		$queryResult = $db->runQuery("SELECT *, Clubs.name as clubname FROM ClubGenre, Clubs, ClubEvents WHERE user_id = ". $userID . " AND code = genreCode AND Clubs.club_id = ClubEvents.club_id  AND ClubEvents.approved = 1");
	} else if ($title == "articles") {
		$queryResult = $db->runQuery("SELECT * FROM HealthNews WHERE user_id = ". $userID . " AND approved = 1");
	} else if ($title == "locations") {
		$queryResult = $db->runQuery("SELECT * FROM Locations WHERE user_id = ". $userID . " AND approved = 1");
	} else if ($title == "routes") {
		$queryResult = $db->runQuery("SELECT * FROM Routes WHERE user_id = ". $userID . " AND approved = 1");
	} else {
		return FALSE;
	}
	
	$db->close();

	//outputting contributions and returning boolean value
	//output works only if any rows found
	if ($queryResult->num_rows >= 1) {
		echo "<br><h5>Added " . $title . ":</h5>";
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
	//making main divisions
	echo '<div class="container"><div class="section">';
	//based on user type, selected user icon is shown
	if ($siteAdmin == 1)
		$imgParam = '../assets/images/siteadmin.png';
	else if ($nkpag == 1)
		$imgParam = '../assets/images/mapadmin.png';
	else if ($clubAdmin == 1)
		$imgParam = '../assets/images/clubadmin.png';
	else
		$imgParam = '../assets/images/contributor.png';
	echo '<div class="row"><div class="col s4"><img src="' . $imgParam . '" alt="User Icon" height="200" width="200"></div>';
	//Displaying username
	echo '<div class="col s8"><h3>' . $userName . '</h3></div></div>';

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

	//following 2 strings will be displayed only for logged in account owner and site admins 
	//checking viewer info from current session
	if (isset($_SESSION['USER_LOGIN_IN'])) {//TRUE) {
		$viewerUserId = $_SESSION['USER_ID'];
		$viewerSiteAdmin = $_SESSION['USER_SITEADMIN'];
		//for testing
		// $viewerUserId = 3;
		// $viewerSiteAdmin = 1;
		if (($viewerUserId == $userID) || ($viewerSiteAdmin == TRUE)) {
			echo "User ID: " . $userID . "<br>";
			echo "Registered email address: " . $email . "<br>";
		}
	}

	//getting administrated clubs (if any)
	if ($clubAdmin == 1) {
		$db = new Connection();
		$db->open();
		$clubsAdministered = $db->runQuery("SELECT * FROM ClubAdmins, Clubs, ClubGenre WHERE Clubs.club_id = ClubAdmins.club_id AND user_id = ". $userID . " AND Clubs.genreCode = ClubGenre.code AND approved = 1");
		$db->close();
		if ($clubsAdministered->num_rows >= 1) {
			echo '<h5>Admin of following clubs:</h5><div class="row">';
			while ($row = $clubsAdministered->fetch_assoc()) {
				echo ('<a class="clubTitle" href="/sportlethen/' . url($row["category"]) . '/' . url($row["name"]) . '-C' . $row["club_id"] . '"><div class="col s6 m4 l3"><p class="sp-genre z-depth-2">' . $row["name"] . '</p></div></a>') . ' ';
			}
			echo '</div>';
		}
	}

	//getting added contributions that are approved
	$events = getApprovedContributions("events", $userID);
	$news = getApprovedContributions("articles", $userID);
	$locations = getApprovedContributions("locations", $userID);
	$routes = getApprovedContributions("routes", $userID);

	//outputting message if user has no approved contributions
	if (($events == 0) and ($news == 0) and ($locations == 0) and ($routes == 0)) {
		echo '<br><h5 class="messageTitle">This user has not made any contibutions yet</h5><br>';
	}
	echo '</div></div>';

} else {
	//following page is displayed when user is not found
	// Navbar
	top("Ooops!");

	//Other page content
	echo '<div class="container"><div class="section"><h5 class="messageTitle">There is no user named "' . $person . '".</h5></div></div>';
}

// Footer
bottom();
?>