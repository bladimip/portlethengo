


<?php
/*
News article HTML template
Id of an article need to be passed to this script, otherwise it won't work and an output will be 404

./inc/news/t_news.php?id=4
Routing example: ./health-wellbeing/news/4

Script connects to a database and fetches appropriate article
To use ORM:

$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM healthnews WHERE news_id = id");
$db->close();
*/


include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');


// Navbar
top("Articles");

//Other page content
if (isset($_SESSION['USER_LOGIN_IN']))
{
	$user_id = $_SESSION['USER_ID'];
	$siteAdmin = $_SESSION['USER_SITEADMIN'];
}
else
{
	$siteAdmin = 0;
}
if (isset($_GET["news_id"])) 
{
    
	$db = new Connection();
	$db -> open();
	$result = $db ->runQuery("SELECT * FROM HealthNews, HealthMedia, Users WHERE HealthNews.news_id = HealthMedia.news_id AND HealthNews.user_id = Users.user_id AND HealthNews.news_id = '".$_GET['news_id']."' ");
	$db -> close();
	echo '<div class = "hw-news-content"';
	while($row = $result->fetch_array())
	{
		$news_id = $row['news_id'];
		$title = $row['title'];
		$username = $row['username'];
		$description = $row['description'];
		$newsDate = $row['newsDate'];
		$approvedBy = $row['approvedBy'];
		$mediaType = $row['mediaType'];
		$altName = $row['altName'];
		$mediaPath = $row['mediaPath'];
		$approved = $row['approved'];
		$siteAdmin = 1;

		if($siteAdmin)
		{
			echo "<div class='hw_title'><h4>{$title}</h4></div>";
			echo "<h5>Written by {$username} on {$newsDate}</h5>";
		    echo "<p>{$description}</p>";
		    
		    if($mediaType == "image")
		    {
		    	echo "<div class='image-container'>
		    	<img src='{$mediaPath}' alt='{$altName}'></div>";
		    }
		    elseif($mediaType == "video")
		    {
		    	echo "<div class='video-container'>
		    	<iframe width='420' height='350' src='{$mediaPath}' frameborder='0' allowfullscreen></iframe>
		    	</div>";
		    	

		    	
		    }
		    
		    else
		    {
		    	echo "<p>Invalid Media</p>";
		    }
		    //these two forms work indvidually but if they are both there they both redirect to /inc/approve.php?
		    echo "<center><form name ='approveFrom' action='/inc/approve.php' method='post'>
					<input name='news_id' type='hidden' value='{$news_id}'>
					<input name='approved' type='hidden' value='{$approved}'>
					<input name='approvedBy' type='hidden' value='{$approvedBy}'>
					<input type='Submit' name='Submit' value='Approve'>
					</center></form>
				";
				
				echo"<center><form name='editForm' action='/inc/editArticle.php' method='post'>
					<input name='news_id' type='hidden' value='{$news_id}'>
					<input name ='title' type='hidden' value='{$title}'>
					<input name ='description' type='hidden' value='{$description}'>
					<input name = 'mediaType' type='hidden' value='{$mediaType}'>
					<input name = 'mediaPath' type='hidden' value='{$mediaPath}'>
					<input type='Submit' name='Submit' value='Edit'>
					</center></form>
			    ";
			    
			    echo"<center><form name='deleteForm' action='/inc/deleteArticle.php' method='post'>
			    <input name='news_id' type='hidden' value='{$news_id}'>
			    <input type='Submit' name='Submit' value='Delete'>
			    </center></form>
			    ";
	    }
	    else
	    {
	    	echo "<div class='hw_title'><h4>{$title}</h4></div>";
			echo "<h5>Written by {$username} on {$newsDate}</h5>";
		    echo "<div class='des'>{$description}</div>";
		    
		    if($mediaType == "image")
		    {
		    	echo "<img src='{$mediaPath}' alt='{$altName}'>";
		    }
		    elseif($mediaType == "video")
		    {
		    	echo "<div class='video-container'>
		    	<iframe width='420' height='350' src='{$mediaPath}' frameborder='0' allowfullscreen></iframe>
		    	</div>";
		    	

		    	
		    }
		    
		    else
		    {
		    	echo "<p>Invalid Media</p>";
		    }
	    }
	}
	echo '</div>';

}


// Footer
bottom();
?>

