<?php

include('db/simpleDB.php');

$news_id = $_POST['news_id'];

$db = new Connection();
$db -> open();
$delete = $db ->runQuery("DELETE FROM HealthNews WHERE news_id = '$news_id'");
$deleteMedia = $db ->runQuery("DELETE FROM HealthMedia WHERE news_id = '$news_id'");
$db -> close();

header('location: /health-wellbeing');
?>