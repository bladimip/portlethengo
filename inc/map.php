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


// function to pull the list of locations from the database to draw them to the page or any other reason
function drawList(){
    global $long, $lat;
    // connect to the database
    $db = new Connection();
    $db->open();
    if(userType()==2){
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
function drawMarkers(){
    global $long, $lat;
    //connect to the database
    $db = new Connection();
    $db->open();
    if(userType()==2){
        $loc = $db->runQuery("SELECT * FROM Locations;");
    }
    else{
        $loc = $db->runQuery("SELECT * FROM Locations WHERE approved = 1;");
    }
    $db->close();

    // loop through all returned results
    while ($row = $loc->fetch_assoc()) {
        $lat = $row["latitude"];
        $long = $row["longitude"];
        $description = $row["description"];
        $name = $row["name"];
        echo "var marker = new google.maps.Marker({position: {lat: ".$lat.", lng: ".$long."}, map: map, animation: google.maps.Animation.DROP});";
        //echo "var contentString = '<div class=\"marker-info-win\"><div class=\"marker-inner-win\"><span class=\"info-content\"><h1 class=\"marker-heading\">New Marker</h1>'This is a new marker infoWindow'</span></div></div>;";
        //var contentString = '<div class="marker-info-win"><div class="marker-inner-win"><span class="info-content"><h1 class="marker-heading">New Marker</h1>'This is a new marker infoWindow'</span></div></div>
        //echo "var infowindow = new google.maps.InfoWindow({content: contentString});";
        //echo "var infowindow = new google.maps.InfoWindow();";
        //echo "infowindow.setContent(contentString);";
        //echo "google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});";
        //echo  "marker.addListener('click', function() {infowindow.open(map, marker);});";
        //var infowindow = new google.maps.InfoWindow({content: contentString});

    };
}

//TODO placeholder function to return the usertype, to be rewritten
function userType(){
    // return 0 for normal user
    // return 1 for contributor
    // return 2 for admin
    return 1;
}

//TODO placeholder function to return the user_ID, to be rewritten
function getUserID(){
    return 4;
}


drawList();
?>
    <h3>Portlethan Places</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            // g-maps example of how to pass co-ords to the map:
            //var uluru = {lat: -25.363, lng: 131.044};

            var centre = <?php echo $centre ?>;
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: centre});
            //click listener to add markers.
            google.maps.event.addListener(map, 'click', function(event) {
                addMarker(event.latLng, map);
            });
            <?php
            //
            drawMarkers();
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