/**
* Created by PhpStorm.
* User: scott
* Date: 06/12/2016
* Time: 16:01
*/

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

$long;
$lat;
$centre = "{lat: 57.062423, lng: -2.130447}";