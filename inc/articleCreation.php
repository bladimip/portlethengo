<?php
include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
//
//use session 'USER_ID'
if (isset($_SESSION['USER_LOGIN_IN'])) 
{
  $user_id = $_SESSION['USER_ID'];
  $siteAdmin = $_SESSION['USER_SITEADMIN'];
} else {
	$siteAdmin = 0;
}

			//$user_id = 1;
            //$siteAdmin = 1;
			$title = $_POST['title'];
			$description = $_POST['description'];

			$mediaType = $_POST['mediaType'];
			$mediaPath = $_POST['mediaPath'];
			if($siteAdmin == 1)
			{
				$approvedBy = $user_id;
				$approved = 1;
				$db = new Connection();
				$db -> open();
				$create = $db ->runQuery("INSERT INTO HealthNews(news_id,user_id,approvedBy, title, description, newsDate,approved) values ('NULL',(SELECT user_id from Users WHERE user_id = '$user_id'),'$approvedBy', '$title', '$description', CURRENT_TIMESTAMP, '$approved')");
				$addMedia = $db ->runQuery("INSERT INTO HealthMedia(media_id, news_id, mediaType, altName, mediaPath) VALUES (LAST_INSERT_ID(),LAST_INSERT_ID(),'$mediaType', 'NULL', '$mediaPath')");
				$db -> close();
				
				
			}
			else
		    {
				
				$approved = 0;
				$db = new Connection();
				$db -> open();
				$create = $db ->runQuery("INSERT INTO HealthNews(user_id, title, description, newsDate,approved) values ((SELECT user_id from Users WHERE user_id = '$user_id'), '$title', '$description', CURRENT_TIMESTAMP, '$approved')");
				$addMedia = $db ->runQuery("INSERT INTO HealthMedia(media_id, news_id, mediaType, altName, mediaPath) VALUES (LAST_INSERT_ID(),LAST_INSERT_ID(),'$mediaType', 'NULL', '$mediaPath')");
				$db -> close();
			}

header('location: /health-wellbeing');
?>