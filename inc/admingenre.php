<?php
/*
Registration
*/

include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
//error_reporting(0);
//Ulogin(1);
DidTheUserAdmin(1);


if (isset($_POST['enter'])) {

  $_POST['clubgenre'] = FormChars($_POST['clubgenre']);
  $_POST['clubgenrecode'] = FormChars($_POST['clubgenrecode']);

  mysqli_query($CONNECT, "INSERT INTO `clubgenre`  VALUES ('$_POST[clubgenre]', '$_POST[clubgenrecode]')");

}



// Navbar
top("Welcome to Portlethen");

//Other page content

?>


  <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Admin Panel</h4>
                    <p class="center-align light">There you can change come details of users and webpage.</p>
                    <div class="collection">
        <a href="adminpanel" class="collection-item">Show Admin Panel</a>

  <hr>
  <h5>Add ganre</h5>
 <div class="input-field col s6">
          <input type="text" id="clubgenre" name="clubgenre" required class="validate">
          <label for="clubgenre">Club genre</label>
        </div>
        <div class="input-field col s6">
          <input id="clubgenrecode" type="text" name="clubgenrecode" required class="validate">
          <label for="clubgenrecode">Club genre short version</label>
        </div>
                    <input type="submit" name="enter" value="Add Genre" class=" waves-effect waves-green btn-flat">
                    </p>
                    <hr>
                    <h5>Delete ganre</h5>
<?php

function fetchGenres() {
  $db = new Connection();
  $db->open();
  $genres = $db->runQuery("SELECT * FROM clubgenre");
  $db->close();

  $genresArr = array();
  while ($row = $genres->fetch_assoc()) {
    $genresArr[$row["code"]] = $row["category"];
  }
  return $genresArr;
}

function showCategory($genresArr) {
 echo '<div class="row">
           <select class="input-field">';

           foreach ($genresArr as $key => $value) {

               echo '<option value="'. $key .'">'. $value .'</option>';
             }
             // Go to next key
             next($genresArr);
           
 echo '    </select>
       </div>';
}

showCategory(fetchGenres());

/*
$sql = "SELECT * FROM clubs";
$result_select = mysqli_query($sql);
echo "<select name = ''>";
while($object = mysql_fetch_object($result_select)){
echo "<option value = '$object->column_name' > $object->column_name </option>";
}
echo "</select>";
*/
?>

<input type="submit" name="entergenre" value="Delete Genre" class=" waves-effect waves-green btn-flat">
                </div>
            </div>
        </div>

  </div>
                </div>
