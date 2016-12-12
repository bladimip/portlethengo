<?php

include('db/simpleDB.php');
$news_id = $_POST['news_id'];

$db = new Connection();
$db -> open();
$delete = $db ->runQuery("DELETE FROM HealthNews WHERE news_id = '$news_id'");
$deleteMedia = $db ->runQuery("DELETE FROM HealthMedia WHERE news_id = '$news_id'");
$db -> close();



echo "<a href='/health-wellbeing'>back to article</a>";


// header doesn't work
header('location: /health-wellbeing');
?>