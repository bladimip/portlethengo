<?php
include_once('../db/simpleDB.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Delete
  if (isset($_POST["imgId"])) {

    $imgId = $_POST["imgId"];

    // Delete an actual image file
    $db = new Connection();
    $db->open();
    $delFilePath = $db->runQuery("SELECT imagePath FROM clubimages WHERE image_id = ". $imgId);
    $db->close();
    if (mysqli_num_rows($delFilePath) == 1) {
      while ($row = $delFilePath->fetch_assoc()) {
        $path = $row["imagePath"];
        // Delete a file
        unlink($path);
      }
    }

    // Delete a record about an image from a database
    $db = new Connection();
    $db->open();
    $club = $db->runQuery("DELETE FROM clubimages WHERE image_id = ". $imgId);
    $db->close();

    echo "Deleted";

  // Upload
  } else {

    // Get data
    extract($_POST);

    $clubID = $_POST["club_id"];

    // Allowed file extensions
    $extension = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "gif", "GIF");

    $db = new Connection();
    $db->open();

    // Get information about each file
    foreach ($_FILES as $index => $file) {
    	$file_name = $file["name"];
    	$file_tmp = $file["tmp_name"];
    	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
    	$size = $file["size"];

    	if (in_array($ext, $extension)) {

    		// Create image from file
    		switch (strtolower($file['type'])) {
    			case 'image/jpeg':
    				$image = imagecreatefromjpeg($file['tmp_name']);
    				break;
    			case 'image/png':
    				$image = imagecreatefrompng($file['tmp_name']);
    				break;
    			case 'image/gif':
    				$image = imagecreatefromgif($file['tmp_name']);
    				break;
    			default:
    				exit('Unsupported type: '.$file['type']);
    		}

    		// Max sizes for a new photo
    		$max_width = 800;
    		$max_height = 600;
    		$max_file_size = 400000;

    		// Get current dimensions
    		$old_width  = imagesx($image);
    		$old_height = imagesy($image);

    		// Calculate a scaling is needed to fit the image inside a frame
    		$scale = min($max_width/$old_width, $max_height/$old_height);

    		// Get a new dimensions
    		$new_width  = ceil($scale*$old_width);
    		$new_height = ceil($scale*$old_height);

    		// Create a new empty image
    		$new = imagecreatetruecolor($new_width, $new_height);

        $black = imagecolorallocate($new, 0, 0, 0);
    		imagecolortransparent($new, $black);

    		// Resize old image into new
    		imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);


    		// If a file with the same name is not already existing
    		if (!file_exists("../../assets/images/clubs/".$file_name)) {

    				// If file size is smaller than the limit, upload original
    				if ($size < $max_file_size) {
    					move_uploaded_file($file_tmp, "../../assets/images/clubs/".$file_name);

    				} else {
    					// Upload resized
    					imagepng($new, "../../assets/images/clubs/".$file_name);
    				}

    				$filenameNoExt = basename($file_name, ".".$ext);


            // Add to database here
            $clubID_esc = $db->escape($clubID);
            $db->runQuery("INSERT INTO clubimages (club_id, imagePath, altName) VALUES ('". $clubID_esc ."', '../../assets/images/clubs/". $file_name ."', '". $file_name ."')");

    				/* create a new id for the file (id is used in other tables)
    				$db->customQuery("INSERT INTO ai_images (ai_ID) VALUES ('')");

    				//get that id
    				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
    				if ($result->num_rows == 1) {
    					while($row = $result->fetch_assoc()) {
    						//Place all folder names into new array
    						$lastID = $row["ai_ID"];
    					}

    					//Create a database record about this file
    					$userIDDB = $db->escape($userID);
    					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");

    					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../uploaded_photos/$file_name", 'acting', $newAlbum);
    					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);

    				} else {
    					echo "<p>One result is expected</p>";
    				}*/

    			// If a file with the same name is already existing
    			} else {

    				$filename = basename($file_name, $ext);

    				//create a new name for the file (using time function, so it is always unique)
    				$newFileName = $filename.time().".".$ext;

    				//if file size is smaller than the limit, upload original
    				if ($size < $max_file_size) {
    					move_uploaded_file($file_tmp, "../../assets/images/clubs/".$newFileName);

    				} else {
    					//upload resized image
    					imagepng($new, "../../assets/images/clubs/".$newFileName);
    				}

    				//same logic here as in a first block of if statement
    				$filenameNoExt = basename($file_name, ".".$ext);

            /*
    				$db->customQuery("INSERT INTO ai_images () VALUES ()");

    				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
    				if ($result->num_rows == 1) {
    					while($row = $result->fetch_assoc()) {
    						//Place all folder names into new array
    						$lastID = $row["ai_ID"];
    					}

    					$userIDDB = $db->escape($userID);
    					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");

    					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../uploaded_photos/$newFileName", 'acting', $newAlbum);
    					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);

    				} else {
    					echo "<p>One result is expected</p>";
    				}
            */
    			}

    		}
    		//destroy a temporary image
    		imagedestroy($new);
    	}

    	$db->close();

  }
}
?>
