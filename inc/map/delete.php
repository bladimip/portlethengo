<?php

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');

// Navbar
top("Locations and Routes");


$route_id = $_GET['route'];
$loc_id = $_GET['loc'];
$userID = getUserID();

if (getUserType() != 2){
    echo "No admin login, you have no privelage to review locations and routes";
}

if (getUserType()==2){
    if (isset($_GET['loc'])){
        //connect to the database
        $db = new Connection();
        $db->open();
        $loc = $db->runQuery("DELETE FROM Locations WHERE loc_id=$loc_id;");
        $db->close();
        echo "Deleted the Location";
        echo "<br><a href='map.php'>Go Back</a>";
    }
    if (isset($_GET['route'])){
        //connect to the database
        $db = new Connection();
        $db->open();
        $loc = $db->runQuery("DELETE FROM Routes WHERE route_id = $route_id;");
        $db->close();
        echo "Deleted the Route";
        echo "<br><a href='routes.php'>Go Back</a>";
    }
}

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


// Footer
bottom();

?>