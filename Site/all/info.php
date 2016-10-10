<?php
// connect to csdm- webdev server and sel ect database
$db = new mysqli(
"hostname",
"username",
"password’",
"db_name’"
);
// test if connection was established, and print any errors
if($db->connect_errno){
    die()
}