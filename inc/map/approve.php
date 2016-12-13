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
        $loc = $db->runQuery("UPDATE Locations SET approved=1, approvedBy=$userID WHERE loc_id=$loc_id;");
        $db->close();
        echo "Approved the Location";
        echo "<br><a href='map.php'>Go Back</a>";
    }
    if (isset($_GET['route'])){
        //connect to the database
        $db = new Connection();
        $db->open();
        $loc = $db->runQuery("UPDATE Routes SET approved=1, approvedBy=$userID WHERE route_id = $route_id;");
        $db->close();
        echo "Approved the Route";
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


// Footer
bottom();

?>