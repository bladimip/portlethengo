<?php
/*
Developed by Vlad R
Created on 4 December 2016

Following php file processes search requests through search bar across all sections of website

TODO:
finalize looks
*/

//file contains information and methods for DB
include('/db/simpleDB.php');
//file contains function for trimming white-spaces and special characters when creating links
include('/php/functions.php');

//following function checks selected tables (sections) and outputs results based on search
//also returns boolean value that is used for checking if any results found
//similar function used in profile file
function searchSection ($table, $search) {
	//basic input check - replacing all special characters to white-spaces and leaving only alphanumerical chars
	//used for security reasons
	$search = preg_replace('/[^A-Za-z0-9\-]/', ' ', $search);
		
	$db = new Connection();
	$db->open();

	//running query depending on section, will return FALSE if wrong value given
	switch ($table) {
    case "Users":
		$label = "Users";
		$queryResult = $db->runQuery("SELECT username FROM Users WHERE username LIKE '%". $search . "%'");
        break;
    case "ClubGenre":
		$label = "Club Categories";
		$queryResult = $db->runQuery("SELECT category FROM ClubGenre WHERE category LIKE '%". $search . "%'");		
        break;
    case "Clubs":
		$label = "Clubs";
		$queryResult = $db->runQuery("SELECT club_id, genreCode, name, approved, code, category FROM Clubs, ClubGenre WHERE name LIKE '%" . $search . "%' AND genreCode = code AND approved = 1");
        break;
	case "ClubEvents":
		$label = "Events";
		$queryResult = $db->runQuery("SELECT event_id, ClubEvents.club_id as eid, ClubEvents.name as ename, ClubEvents.approved, Clubs.club_id as cid, genreCode, Clubs.name as cname, code, category FROM ClubEvents, Clubs, ClubGenre WHERE ClubEvents.name LIKE '%". $search . "%' AND ClubEvents.approved = 1 AND Clubs.club_id = ClubEvents.club_id AND code = genreCode");
        break;
    case "HealthNews":
		$label = "Articles";
		$queryResult = $db->runQuery("SELECT title, news_id, approved FROM HealthNews WHERE title LIKE '%". $search . "%' AND approved = 1");
        break;
    case "Locations":
		$label = "Locations";
		$queryResult = $db->runQuery("SELECT name, loc_id, approved FROM Locations WHERE name LIKE '%". $search . "%' AND approved = 1");
        break;
    case "Routes":
		$label = "Routes";
		$queryResult = $db->runQuery("SELECT name, route_id, approved FROM Routes WHERE name LIKE '%". $search . "%' AND approved = 1");
        break;
    default:
        return FALSE;
	}
	$db->close();
	
	//outputting results depending on section and returning boolean value
	//output works only if any rows found
	//output is made as a single row because of ajax script used (found in script.js)
	if ($queryResult->num_rows >= 1) {
		$str = '<h5>' . $label . ':</h5><div class="collection">';
		while ($row = $queryResult->fetch_assoc()) {
			switch ($table) {
			case "Users":
				$str .= '<p><a href="/users/' . url($row["username"]) . '" class="collection-item">' . $row["username"] . '</a></p>';
				break;
			case "ClubGenre":
				$str .= '<p><a href="/sportlethen/' . url($row["category"]) . '" class="collection-item">' . $row["category"] . '</a></p>';
				break;
			case "Clubs":
				$str .= '<p><a href="/sportlethen/' . url($row["category"]) . '/' . url($row["name"]) . '-C' . $row["club_id"] . '" class="collection-item">' . $row["name"] . '</a></p>';
				break;
			case "ClubEvents":
				$str .= '<p><a href="/sportlethen/' . url($row["category"]) . '/' . url($row["cname"]) . '/event/' . 'C' . url($row["cid"]) . 'E' . url($row["event_id"]) . '" class="collection-item">' . $row["ename"] . '</a></p>';
				break;
			case "HealthNews":
				$str .= '<p><a href="/health-wellbeing/' . url($row["title"]) . '-A' . url($row["news_id"]) . '" class="collection-item">' . $row["title"] . '</a></p>';
				break;
			case "Locations":
				$str .= '<p><a href="/map/' . url($row["name"]) . '-L' . url($row["loc_id"]) . '" class="collection-item">' . $row["name"] . '</a></p>';
				break;
			case "Routes":
				$str .= '<p><a href="/map/' . url($row["name"]) . '-R' . url($row["route_id"]) . '" class="collection-item">' . $row["name"] . '</a></p>';
				break;
			default:
				return FALSE;
			}
		}
		$str .= '</div>';
		echo $str;
		return TRUE;
	} else
		return FALSE;
}

//testing
//echo "initial search string: " . $_POST["search"] . "<br>";
$search = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST["search"]);
echo "trimmed search string used in query: " . $search  . "<br>";

//putting all search output into divisions for style formatting
echo '<div class="section" id="searchOutput"><div class="container">';
//searching in each section of website
$users = searchSection("Users", $_POST["search"]);
$categories = searchSection("ClubGenre", $_POST["search"]);
$clubs = searchSection("Clubs", $_POST["search"]);
$events = searchSection("ClubEvents", $_POST["search"]);
$articles = searchSection("HealthNews", $_POST["search"]);
$locations = searchSection("Locations", $_POST["search"]);
$routes = searchSection("Routes", $_POST["search"]);

//outputting message if no results found
if (($users == 0) and ($categories == 0) and ($clubs == 0) and ($events == 0) and ($articles == 0) and ($locations == 0) and ($routes == 0)) {
	echo '<h5 class="messageTitle">No results found =(</h5>';
}
echo '</div></div>';
	
?>