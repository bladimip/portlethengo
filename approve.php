<?php

include('db/simpleDB.php');

if (isset($_SESSION['USER_LOGIN_IN'])) 
{
  $user_id = $_SESSION['USER_ID'];
  $siteAdmin = $_SESSION['USER_SITEADMIN'];
}
$user_id = 6;
$news_id = $_POST['news_id'];
$approved = $_POST['approved'];
$approvedBy = $_POST['approvedBy'];


$db = new Connection();
$db -> open();
$approvesql = $db ->runQuery("UPDATE HealthNews SET approved = 1, approvedBy = '{$user_id}' WHERE news_id = '{$news_id}'");
$db -> close();









echo "<a href='/health-wellbeing'>back to article</a>";

//header not working
header('location: /health-wellbeing');
?>