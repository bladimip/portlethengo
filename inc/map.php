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
//use $_GET to load individual locations
//eg. map.php?loc=2
//use map.php to load all locations, loading of location depending on user ID automatic.


$long;
$lat;
$centre = "{lat: 57.062423, lng: -2.130447}";
$onLoadLoc = 0;

function getLocation(){
    global $onLoadLoc;
    if (!empty($_GET)){
        $onLoadLoc = $_GET['loc'];
    }
    else{
        $onLoadLoc = 0;
    }
}


// function to pull the list of locations from the database to draw them to the page or any other reason
function drawList(){
    global $long, $lat;
    // connect to the database
    $db = new Connection();
    $db->open();
    if(getUserType()==2){
        $loc = $db->runQuery("SELECT * FROM Locations;");
    }
    else{
        $loc = $db->runQuery("SELECT * FROM Locations WHERE approved = 1;");
    }
    $db->close();

    // loop through all returned results
    while ($row = $loc->fetch_assoc()) {
        $loc_id = $row["loc_id"];
        $user_id = $row["user_id"];
        $approvedBy = $row["approvedBy"];
        $name = $row["name"];
        $description = $row["description"];
        $lat = $row["latitude"];
        $long = $row["longitude"];
        $address = $row["address"];
        $approved = $row["approved"];
        echo $name. " ";
        echo  $lat. " ";
        echo $long. "<br>";
    };
}

//function to draw the markers on the map
function drawMarkers($location){
    global $long, $lat;
    if ($location == 0) {
        //connect to the database
        $db = new Connection();
        $db->open();
        if (getUserType() == 2) {
            $loc = $db->runQuery("SELECT * FROM Locations;");
        } else {
            $loc = $db->runQuery("SELECT * FROM Locations WHERE approved = 1;");
        }
        $db->close();
        // loop through all returned results
        while ($row = $loc->fetch_assoc()) {
            $lat = $row["latitude"];
            $long = $row["longitude"];
            $description = $row["description"];
            $name = $row["name"];
            echo "var marker = new google.maps.Marker({position: {lat: " . $lat . ", lng: " . $long . "}, map: map, animation: google.maps.Animation.DROP});";
            //echo "var contentString = '<div class=\"marker-info-win\"><div class=\"marker-inner-win\"><span class=\"info-content\"><h1 class=\"marker-heading\">New Marker</h1>'This is a new marker infoWindow'</span></div></div>;";
            //var contentString = '<div class="marker-info-win"><div class="marker-inner-win"><span class="info-content"><h1 class="marker-heading">New Marker</h1>'This is a new marker infoWindow'</span></div></div>
            //echo "var infowindow = new google.maps.InfoWindow({content: contentString});";
            //echo "var infowindow = new google.maps.InfoWindow();";
            //echo "infowindow.setContent(contentString);";
            //echo "google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});";
            //echo  "marker.addListener('click', function() {infowindow.open(map, marker);});";
            //var infowindow = new google.maps.InfoWindow({content: contentString});
        };
    } else {
        //connect to the database
        $db = new Connection();
        $db->open();
        if (getUserType() == 2) {
            $loc = $db->runQuery("SELECT * FROM Locations WHERE loc_id = $location;");
        } else {
            $loc = $db->runQuery("SELECT * FROM Locations WHERE approved = 1 AND loc_id = $location;");
        }
        $db->close();
        // loop through all returned results
        while ($row = $loc->fetch_assoc()) {
            $lat = $row["latitude"];
            $long = $row["longitude"];
            $description = $row["description"];
            $name = $row["name"];
            echo "var marker = new google.maps.Marker({position: {lat: " . $lat . ", lng: " . $long . "}, map: map, animation: google.maps.Animation.DROP});";
        }
    }
};

function getUserType(){
    $userID = getUserID();
    if ($userID != 0) {
        $query = "SELECT nkpag, siteAdmin FROM Users WHERE user_id = $userID;";
        $db = new Connection();
        $db->open();
        $result = $db->runQuery($query);
        $db->close();
        $nkpag = 0;
        $siteAdmin = 0;
        while ($row = $result->fetch_assoc()) {
            $nkpag = $row["nkpag"];
            $siteAdmin = $row["siteAdmin"];
        }
    }
    if ($userID==0){
        // return 0 for normal user
        return 0;
    }
    elseif ($nkpag==1 || $siteAdmin==1){
        // return 2 for admin
        return 2;
    }
    else{
        // return 1 for contributor
        return 1;
    }
}

//TODO placeholder function to return the user_ID, to be rewritten
function getUserID(){
    return 1;
}

getLocation();
if ($onLoadLoc == 0) {
    drawList();
}


?>
    <h3>Portlethan Places</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            // g-maps example of how to pass co-ords to the map:
            //var uluru = {lat: -25.363, lng: 131.044};

            var centre = <?php echo $centre ?>;
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: centre});
            //click listener to add markers. uncomment if you want to add markers by clicking
            //google.maps.event.addListener(map, 'click', function(event) {
            //    addMarker(event.latLng, map);
            //});
            <?php
            if ($onLoadLoc == 0){
                drawMarkers($onLoadLoc);
            }
            else{
                drawMarkers($onLoadLoc);
            }
            ?>
            // g-maps example of how to place markers (use drawMarkers() function instead ) :
            //var marker = new google.maps.Marker({position: {lat: -25.363, lng: 131.044}, map: map});
            //var marker = new google.maps.Marker({position: uluru, map: map});
        }

        function addMarker(location, map) {
            // Add the marker at the clicked location,
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs-DyhJC0oWpOtsZve160KuQbGCZfO9ME&callback=initMap">
    </script>

<?php
// Footer
bottom();
?>