<?php


// html components not working
include('layouts/HTMLcomponents.php');

top("");

$news_id = $_POST['news_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$mediaType = $_POST['mediaType'];
$mediaPath = $_POST['mediaPath'];



echo " 
<form name ='form2' action='edit.php' method='post'>
		<input name='news_id' type='hidden' value='{$news_id}'>
		<p>Title
		<input name='title' type='text' value='{$title}' >
		</p>
		<p>Description
			<input name = 'description' type='text' value='{$description}' size='5000'>
		</p>
		<p>Type of Media ('image' or 'video') Leave the next two fields if you don't want to add an image or a video
		<input name='mediaType' type='text' value='{$mediaType}' >
		</p>
		<p> Path to selected media ('www.youtube.com/gfhsdfhsd'). If it is a youtube video make sure that you go to the video click share and then embed and copy the link from there
		<input name='mediaPath' type='text' value='{$mediaPath}' size = '100' >
		</p>
		
		<input type='Submit' name='Submit' value='Submit'>
		
	</form>
";

bottom();

?>