<?php
include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
//need to work out how to add the date and the userid and the news id to the form
top("Create an Article");

echo " 
<form name ='form1' action='articleCreation.php' method='post'>
		<p><b>Title
		<input name='title' type='text' size='50'>
		</b></p>
		<p><b>Description
			<textarea name='description' type='text' size='5000'>
		</textarea></b></p>
		<p><b>Type of Media ('image' or 'video') Leave the next two fields empty if you don't want to add an image or a video
		<input name='mediaType' type='text' size='100'>
		</b></p>
		<p><b> Path to selected media ('www.youtube.com/gfhsdfhsd'). If it is a youtube video make sure that you go to the video click share and then embed and copy the link from there
		<input name ='mediaPath' type = 'text' size='100'>
		</b></p>
		
		<input type='Submit' name='Submit' value='Submit'>
		 </p>
	</form>
";
?>