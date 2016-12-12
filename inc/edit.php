<?php


include('db/simpleDB.php');

$news_id = $_POST['news_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$mediaType = $_POST['mediaType'];
$mediaPath = $_POST['mediaPath'];

$db = new Connection();
$db -> open();
$edit = $db ->runQuery("UPDATE HealthNews SET title = '$title', description = '$description' WHERE news_id = '$news_id'");
$editMedia = $db ->runQuery("UPDATE HealthMedia SET mediaType = '$mediaType', mediaPath = '$mediaPath' WHERE news_id = '$news_id'");
$db -> close();

//echo "<a href='/health-wellbeing'>back to article</a>";
// header doesn't work
header('location: /health-wellbeing');

?>