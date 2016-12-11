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
$route_id= 4;
$coordinates;
// declare centre point of the map
$centre = "{lat: 57.062423, lng: -2.130447}";


// function to pull the list of locations from the database to draw them to the page or any other reason
function pullRoute(){
    global $coordinates, $route_id;
    // connect to the database
    $db = new Connection();
    $db->open();
    if(userType()==2){
        $loc = $db->runQuery("SELECT * FROM routes WHERE route_id = $route_id;");
    }
    else{
        $loc = $db->runQuery("SELECT * FROM routes WHERE approved = 1 AND route_id = $route_id;");
    }
    $db->close();

    // loop through all returned results
    while ($row = $loc->fetch_assoc()) {
        $route_id = $row["route_id"];
        $user_id = $row["user_id"];
        $approvedBy = $row["approvedBy"];
        $name = $row["name"];
        $description = $row["description"];
        $coordinates = $row["coordinates"];
        $approved = $row["approved"];
    };
}

//function to draw the markers on the map, draws the first and last marker for a route
function drawMarkers(){
    //take global coordinates from last pulled route
    global $coordinates;
    // split them up
    $co = explode(';', $coordinates);
    // find and print the first one
    $start = explode(',',$co[0]);
    $startlat = $start[0];
    $startlong = $start[1];
    echo "var marker = new google.maps.Marker({position: {lat: ".$startlat.", lng: ".$startlong."}, map: map});";
    // find and print the last one
    $end = explode(',',$co[count($co)-1]);
    $endlat = $end[0];
    $endlong = $end[1];
    echo "var marker = new google.maps.Marker({position: {lat: ".$endlat.", lng: ".$endlong."}, map: map});";
}

function drawRoute(){
    global $long, $lat, $coordinates;
    //take global coordinates from last pulled route
    global $coordinates;
    // split them up
    $i=0;
    $co = explode(';', $coordinates);
    while ($i < count($co)){
        $point = explode(',',$co[$i]);
        $pointlat = $point[0];
        $pointlong = $point[1];
        echo "{lat: ".$pointlat.", lng: ".$pointlong."}, ";
        $i++;
    }
}

//TODO placeholder function to return the usertype, to be rewritten
function userType(){
    // return 0 for normal user
    // return 1 for contributor
    // return 2 for admin
    return 2;
}

//TODO placeholder function to return the user_ID, to be rewritten
function getUserID(){
    return 4;
}


pullRoute();
?>
    <h3>Portlethan Routes</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            // g-maps example of how to pass co-ords to the map:
            //var uluru = {lat: -25.363, lng: 131.044};

            var centre = <?php echo $centre ?>;
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: centre});
            //click listener to add markers.
            //google.maps.event.addListener(map, 'click', function(event) {
            //    addMarker(event.latLng, map);
            //});
            <?php
            drawMarkers();
            ?>

            var route = [<?php drawRoute()
                //g-maps example
                //{lat: 57.061539, lng: -2.128038},
                //{lat: 57.063107, lng: -2.140097},
                //{lat: 57.062370, lng: -2.132270},
                //{lat: 57.060047, lng: -2.129781}?>
            ];
            var flightPath = new google.maps.Polyline({
                path: route,
                geodesic: true,
                strokeColor: '#ff0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            flightPath.setMap(map);
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