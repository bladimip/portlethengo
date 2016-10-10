<?php
$db = new mysqli(
    "eu-cdbr-azure-west-a.cloudapp.net",
    "b5724637a2f2fd",
    "f5aeeeb3",
    "the_first_db"
);
if($db->connect_errno){
    die('Connectfailed['.$db->connect_error.']');
}