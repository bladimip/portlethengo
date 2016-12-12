<?php


$route_id = $_GET['route'];
$loc_id = $_GET['loc'];

if (getUserType() = !)


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

//TODO placeholder function to return the user_ID, to be rewritten
function getUserID(){
    return 1;
};