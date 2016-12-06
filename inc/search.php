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
//include('inc/layouts/HTMLcomponents.php');
//file contains information and methods for DB
include('../inc/db/simpleDB.php');


// if (isset($_POST["search"])) {
	// echo $_POST["search"];
	
	
// }


//file contains function for trimming white-spaces and special characters when creating links
//include('php/functions.php');


//following function checks selected tables (sections) and outputs results based on search
//similar function used in profile file
function searchSection ($section, $search) {
	$db = new Connection();
	$db->open();
	// checking which section to check, wont work if wrong values given
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
		$str = "";
		$str .= "<p>" . $section . ":</p>";
		while ($row = $queryResult->fetch_assoc()) {
			$str .= "<p><a href=''>" . $row[$column] . "</a></p>";
		}
		echo $str;
	}
}
/*
// Navbar
top("Search results");

//Other page content
//search form - label, text box and a submit button
echo ('<form action="/search" method="post" name="SearchForm">

Looking for: <input type="text" name="search">
<p><input type="radio" name="section" id="1" value="users"><label for="1">Users</label></p>
<p><input type="radio" name="section" id="2" value="clubs"><label for="2">Clubs</label></p>
<p><input type="radio" name="section" id="3" value="events"><label for="3">Events</label></p>
<p><input type="radio" name="section" id="4" value="articles"><label for="4">Articles</label></p>
<p><input type="radio" name="section" id="5" value="locations"><label for="5">Locations</label></p>
<p><input type="radio" name="section" id="6" value="Routes"><label for="6">Routes</label></p>
<input type="submit" value="Search">
</form>');

//basic input check - replacing all special characters to white-spaces and leaving only alphanumerical chars
$_POST = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST);

//output based on found results
if (isset($_POST["search"])) {
//if ($_POST != NULL) {
	echo 'Search results for "' . $_POST["search"] . '":<br>';
*/
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

/*
// Footer
bottom();
*/


?>