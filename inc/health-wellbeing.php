<?php
/*
Health and Wellbeing page

./health.php
page display all headings and possibly some info about each article (not all information) and other content of the page according to the design specification

./health.php
Routing example: ./health-wellbeing

Each article heading should have a link to a full information of the article (t_news.php template we are using to display an article page). news_id need to be passed as well, otherwise it won't work and output will be 404.

<a href="news/t_news.php?news_id=id">Heading of an article</a>

To use ORM:
$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM health);
$db->close();

*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
//include('php/functions.php');

// Navbar
top("Health and Wellbeing");

//Other page content

if (isset($_SESSION['USER_LOGIN_IN'])) 
{
  $user_id = $_SESSION['USER_ID'];
  $siteAdmin = $_SESSION['USER_SITEADMIN'];
} else {
	$siteAdmin = 0;
}


//$siteAdmin = 1;
$db = new Connection();
$db -> open();
$result = $db ->runQuery("SELECT news_id,title,siteAdmin,Users.user_id,username,approved FROM HealthNews,Users WHERE HealthNews.user_id = Users.user_id ORDER BY approved DESC, title ASC");
$db -> close();


		echo '<h4 class="hw-title">Health and Wellbeing Articles</h4>';
		echo '<div class ="hw-content">';

		while($row = $result->fetch_array())
		{
			$news_id = $row['news_id'];
			$title = $row['title'];
			//$user_id = $row['user_id'];
			//$description = $row['description'];
			$approved = $row['approved'];
			$username = $row['username'];
			//if($siteAdmin ==1)
			if($siteAdmin == 1)
			{
				if($approved == 1)
				{
					echo "<li><a href='/health-wellbeing/news/{$news_id} '>{$title}</a> written by {$username} APPROVED</li>";
					
				}
				else
				{
					echo "<li><a href='/health-wellbeing/news/{$news_id} '>{$title}</a> written by {$username} UNAPPROVED 
					</li>";
					//$db new Connection();
					//$db -> open();
					//$approvesql = $db ->runQuery("UPDATE HealthNews SET approved = 1, approvedBy = '".$user_id".' WHERE news_id = '".$news_id."'");
					//echo "<div class='btn newsApBtn'>Approve</div>";
					//$db -> close();
					// add a button to update the status to approved
					
				}
			}
			elseif($siteAdmin == 0 && $approved ==1)
			{
				echo "<li><a href='/health-wellbeing/news/{$news_id} '>{$title}</a> written by {$username}</li>";
				
				
			}
			else
			{

			}


		echo ' </div>';
		}
		echo "<p><center><FORM METHOD='LINK' ACTION='inc/createArticle.php'><INPUT TYPE='submit' VALUE='Create an Article'></FORM></p>";












// Footer
bottom();

?>
