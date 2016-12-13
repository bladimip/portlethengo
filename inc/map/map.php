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
echo "test";
/*
//Other page content
//use $_GET to load individual locations
//eg. map.php?loc=2
//use map.php to load all locations, loading of location depending on user ID automatic.


$long;
$lat;
$centre = "{lat: 57.062423, lng: -2.130447}";
$onLoadLoc = 0;

//function to define whether page loads all locations or one specific location
function getLocation(){
    global $onLoadLoc;
    if (!empty($_GET)){
        $onLoadLoc = $_GET['loc'];
    }
    else{
        $onLoadLoc = 0;
    }
};

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
    if (getUserType()!=0){
        echo '<div class="row">';
        echo '<div class="col s12 m10 l8 offset-m1 offset-l2">';
        echo '<a class="waves-effect waves-light btn" href="addmap">Add Location</a></div></div>';
    }
    //HTML before running loop
    echo <<<EEE
    
    <div class="row">
    <div class="col s12 m10 l8 offset-m1 offset-l2">
    
    <div id="loclist">
    <h3>Portlethen Places</h2> <a href="routes">Click here to see routes.</a>
       <ul style="list-style-type:none">
EEE;
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
        if ($approved == 0) {
            echo <<<EEE
            <li>
                <ul> 
                    <li><font size="4"><a href="/map/location/$loc_id">$name</a></font></li>
                    <li>$description</li>
                    <li>$address</li>
                    <li><font size="2"><a href="approve/location/$loc_id" id="greentext">Not approved, click here to approve, </a>
                    <a href="delete/location/$loc_id" id="redtext">click here to remove.</a></font></li>
                </ul>
            </li>
EEE;
        }
    }
    mysqli_data_seek($loc,0);
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
        if ($approved==1) {
            echo <<<EEE
            <li>
                <ul> 
                    <li><font size="4"><a href="map.php?loc=$loc_id">$name</a></font></li>
                    <li>$description</li>
                    <li>$address</li>
                </ul>
            </li>
EEE;
        }
    }
    //HTML after running loop
    echo <<<EEE
        </ul>
    </div>
    </div>
    </div>
EEE;
};

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
            //$i;
            $lat = $row["latitude"];
            $long = $row["longitude"];
            $description = $row["description"];
            $name = $row["name"];
            echo "var marker = new google.maps.Marker({position: {lat: " . $lat . ", lng: " . $long . "}, map: map, animation: google.maps.Animation.DROP});";
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
            echo <<<EAT
            var contentString = '<div id="content"><h5 id="infoHeading" class="firstHeading">$name</h1><div id="bodyContent"><p>$description</p></div></div>';
            var infowindow = new google.maps.InfoWindow({content: contentString});
            marker.addListener('click', function() {infowindow.open(map, marker);});
EAT;
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
};

//TODO placeholder function to return the user_ID from session, to be rewritten
function getUserID(){
    return 1;
};




?>
    <div id="map"></div>
    <script>
        function initMap() {
            // g-maps example of how to pass co-ords to the map:
            //var uluru = {lat: -25.363, lng: 131.044};

            var centre = <?php echo $centre; ?>;
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: centre});
            //click listener to add markers. uncomment if you want to add markers by clicking
            //google.maps.event.addListener(map, 'click', function(event) {
            //    addMarker(event.latLng, map);
            //});
            <?php
            drawMarkers($onLoadLoc);
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

getLocation();
if ($onLoadLoc == 0) {
    drawList();
}
*/
// Footer
bottom();

?>