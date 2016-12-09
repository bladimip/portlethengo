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
    <a href="adminusers" class="collection-item">Show all users</a>
    <a href="admingenre" class="collection-item">Modify Genre</a>
    <a href="adminusersrights" class="collection-item">Change user rights</a>
                </div>
            </div>
        </div>

  </div>
                </div>
