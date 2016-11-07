<?php
/* 
Map page - Google Map API 

./map.php

To use ORM:
$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM locations);
$db->close();

*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');

// Navbar
top("Locations and Routes");

//Other page content


// Footer
bottom();

?>