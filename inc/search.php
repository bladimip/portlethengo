<?php
/*
Developed by Vlad R
Created on 4 December 2016

Following php file is draft for search on website

TODO:
should make it work with GET instead of POST
add radio buttons for categories
make results as links
output message if no results found
check that contributions are approved
*/

//file contains methods for creating top and bottom
include('inc/layouts/HTMLcomponents.php');
//file contains information and methods for DB
include('inc/db/simpleDB.php');
//file contains function for trimming white-spaces and special characters when creating links
include('php/functions.php');

//following function checks selected tables (sections) and outputs results based on search
//similar function used in profile file
function searchSection ($section, $search) {
	$db = new Connection();
	$db->open();
	//checking which section to check, wont work if wrong values given
	if ($section == "Users")
		$column = "username";
	if ($section == "Clubs")
		$column = "name";
	if ($section == "ClubEvents")
		$column = "name";
	if ($section == "HealthNews")
		$column = "title";
	if ($section == "Locations")
		$column = "name";
	if ($section == "Routes")
		$column = "name";
	$queryResult = $db->runQuery("SELECT " . $column . " FROM " . $section . " WHERE " . $column . " LIKE '%". $search . "%'");
	$db->close();
	if ($queryResult->num_rows >= 1) {
		echo "<br>" . $section . ":<br>";
		while ($row = $queryResult->fetch_assoc()) {
			echo $row[$column] . "<br>";
		}
	}
}

// Navbar
top("Search results");

//Other page content
//search form - label, text box and a submit button
echo ('<form action="/search" method="post" name="SearchForm">
Looking for: <input type="text" name="search">
<input type="submit" value="Search">
</form>');

//radio buttons
// <input type="radio" name="section" value="users">Users
// <input type="radio" name="section" value="clubs">Clubs
// <input type="radio" name="section" value="events">Events
// <input type="radio" name="section" value="articles">Articles
// <input type="radio" name="section" value="locations">Locations
// <input type="radio" name="section" value="Routes">Routes

//basic input check - replacing all special characters to white-spaces and leaving only alphanumerical chars
$_POST = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST);

//output based on found results
if (isset($_POST["search"])) {
//if ($_POST != NULL) {
	echo 'Search results for "' . $_POST["search"] . '":<br>';

	//searching for users
	searchSection("Users", $_POST["search"]);
	//searching for clubs
	searchSection("Clubs", $_POST["search"]);
	//searching for events
	searchSection("ClubEvents", $_POST["search"]);
	//searching for articles
	searchSection("HealthNews", $_POST["search"]);
	//searching for locations
	searchSection("Locations", $_POST["search"]);
	//searching for routes
	searchSection("Routes", $_POST["search"]);
}

// Footer
bottom();
?>