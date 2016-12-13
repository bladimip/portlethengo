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

function getUserID(){
    //needs to check for logged in user and return user_id, return 0 for no active login
    if (isset($_SESSION['USER_LOGIN_IN'])) {
        $user_id = $_SESSION['USER_ID'];
        return $user_id;
    }
    else{
        return 0;
    }
};
$user_id = getUserID();
//Other page content


// Gets data from post parameters
$loadmap = 0;

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
        $co = str_replace(";", "a", $co);
        $co = str_replace(",","b", $co);
        $co = str_replace("a",",", $co);
        $co = str_replace("b",";", $co);
        $query = "INSERT INTO routes (user_id, name, description, coordinates, approved) VALUES ('$user_id', '$name', '$description', '$co', 0);";
        $db = new Connection();
        $db->open();
        $result = $db->runQuery($query);
        $db->close();
        echo "<p>The route has been added to the database but will not be seen until an administrator has approved it.</p>";
        echo "<br><a href=\"routes.php\">Go Back</a>";
        $loadmap = 0 ;
    }
    else{
        $loadmap=1;
        echo <<<EAT
    <form id= "formid" action="addroute.php" method="post" >
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
    <h4>Portlethan, click the map to add your route points. </h4>
    <div id="map"></div>
    <script>
        var poly;
        var map;
        var coordArray = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: $centre
            });

            poly = new google.maps.Polyline({
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: 3
            });
            poly.setMap(map);

            // Add a listener for the click event
            map.addListener('click', addLatLng);
        }

        // Handles click events on a map, and adds a new point to the Polyline.
        function addLatLng(event) {
            var path = poly.getPath();

            // Because path is an MVCArray, we can simply append a new coordinate
            // and it will automatically appear.
            path.push(event.latLng);

            // Add a new marker at the new plotted point on the polyline.
            var marker = new google.maps.Marker({
                position: event.latLng,
                //title: '#' + path.getLength(),
                map: map
            });
            //Formatting the coordinates to fit the database design
            var coords = event.latLng.toString();
            var lat = coords.slice(1,10);
            var lng = coords.split(',')[1].slice(1,10);
            //var lng = slng.concat(slng,"; ");
            var str = lat.concat("; ", lng, " ") 
            coordArray.push(str);
            document.getElementById('co').setAttribute("value", coordArray.toString());
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