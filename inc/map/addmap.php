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

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');

// Navbar
top("Locations and Routes");

//TODO placeholder function to return the user_ID from session, to be rewritten
function getUserID(){
    return ;
}
//Other page content


// Gets data from post parameters
$loadmap = 1;
$user_id = getUserID();
$centre = "{lat: 57.062423, lng: -2.130447}";


function onLoad(){
    global $loadmap, $user_id;
    if (!empty($_POST)){
        //set $loadmap to 0 so it doesn't draw the map
        //$loadmap = 0;
        //take in variables from $_POST method and precess them ready to be added to database
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $co = $_POST['co'];
        $trim = trim($co,"( )");
        $split = explode(',', $trim);
        $lat = substr($split[0],0,9);
        $lng = substr($split[1],0,9);
        $query = "INSERT INTO locations (user_id, name, description, latitude, longitude, address, approved) VALUES ('$user_id', '$name', '$description', '$lat', '$lng', '$address', 0);";
        $db = new Connection();
        $db->open();
        $result = $db->runQuery($query);
        $db->close();
        echo "<p>The location has been added to the database but will not be seen until and administrator has approved it.</p>";
        echo "<br><a href=\"map\">Go Back</a>";
        $loadmap = 0 ;
        }
    else{
        $loadmap=1;
        echo <<<EAT
    <form id= "formid" action="addmap" method="post" >
        <input type="text" placeholder="Locations Name" name="name" required>
        <input type="text" placeholder="Locations Description" name="description" required>
        <input type="text" placeholder="Locations Address" name="address"required>
        <input id= "co" type="text" placeholder="Click the map to set Co-ordinates" name="co" required>
        <input type="submit" class="waves-effect waves-light btn" value="SUBMIT!">
    </form>
EAT;
    }
};

function loadMap(){
    global $centre;
    echo <<<EOT
    <h4>Portlethan, click the map to add your location. </h4>
    <div id="map"></div>
    <script>
    
        var markers = [];
        function initMap() {
            var centre = $centre;
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: centre});
            //click listener to add markers.
            google.maps.event.addListener(map, 'click', function(event) {
                addMarker(event.latLng, map);
            });
        }

        function addMarker(location, map) {
            // Add the marker at the clicked location,
            clearMarkers();
            var marker = new google.maps.Marker({
                //draggable: true,
                position: location,
                map: map
            });
            markers.push(marker);
            document.getElementById('co').setAttribute("value", location);
        }
        
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        }
        
        function clearMarkers() {
            setMapOnAll(null);
        }
        
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs-DyhJC0oWpOtsZve160KuQbGCZfO9ME&callback=initMap">
    </script>
EOT;

};
?>



<?php
onLoad();
if ($loadmap == 1){
    loadMap();
}
// Footer
bottom();
?>