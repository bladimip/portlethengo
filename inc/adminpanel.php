<?php
/* 
Registration
*/

include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
//error_reporting(0);
//Ulogin(1);
DidTheUserAdmin(1);


$sql = "SELECT approved FROM clubs";
$result = mysqli_query($CONNECT, $sql);
$notapproved = 0;

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    if ($row["approved"] == 0){
      $notapproved = $notapproved + 1;
    }
  }
} else {
  echo "0 results";
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
          <a href="admingroups" class="collection-item"><span class="new badge red"><?php echo $notapproved ?></span>Approve the clubs</a>
        </div>
      </div>
    </div>

  </div>
</div>
