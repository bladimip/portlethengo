<?php
/* 
Registration
*/

include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
//error_reporting(0);
//Ulogin(1);
DidTheUserAdmin(1);

//Delete user

if (isset($_POST['delete'])) {
    
    $sql = "DELETE FROM webdev5 WHERE user_id = $row[user_id]";

if ($CONNECT->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $CONNECT->error;
}}

// Block User

if (isset($_POST['block'])) {
    
    $sql = "DELETE FROM webdev5 WHERE user_id = $row[user_id]";

if ($CONNECT->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $CONNECT->error;
}

$sql = "UPDATE webdev5 SET blocked='1' WHERE user_id = $row[user_id]";

if ($CONNECT->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $CONNECT->error;
}}



// Navbar
top("Welcome to Portlethen");

//Other page content

?>

  
  <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Admin Panel - Change user rights</h4>
                    <p class="center-align light">There you can give to some user different rights</p>
                    <div class="collection">
    <a href="adminpanel" class="collection-item">Go to admin panel</a>

<?php

if ($CONNECT->connect_error) {
     die("Connection failed: " . $CONNECT->connect_error);
} 

$sql = "SELECT user_id, username, nkpag, clubAdmin, siteAdmin FROM users";
$result = $CONNECT->query($sql);

if ($result->num_rows > 0) {
     echo '<table class="centered highlight">
        <thead>
          <tr>
              <th>User ID</th>
              <th>Username</th>
              <th>Make this user map admin</th>
              <th>Make user Admin</th>
              <th>Make user Club Admin</th>
          </tr>
        </thead>
        ';
      echo '<p class="centre-align light"><form method="POST" action="/adminusersrights">';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tbody>
          <tr>
            <td>".$row["user_id"]."</td><td>".$row["username"]."</td><td> ".(($row["nkpag"] ? '1' : 0) ? 
'<a class="waves-effect waves-light btn">Delete  map Admin rights</a>' : '<a class="waves-effect waves-light btn">Make user map Admin</a>')."</td><td> ".(($row["siteAdmin"] ? '1' : 0) ? 
'<a class="waves-effect waves-light btn">Delete Admin rights</a>' : '<a class="waves-effect waves-light btn">Make user Admin</a>'). "</td><td>".'<ul id="dropdown2" class="dropdown-content">
    <li><a href="#!">one<span class="badge">1</span></a></li>
    <li><a href="#!">two<span class="new badge">1</span></a></li>
    <li><a href="#!">three</a></li>
  </ul>
  <a class="btn dropdown-button" href="#!" data-activates="dropdown2">Dropdown<i class="mdi-navigation-arrow-drop-down right"></i></a>' ."</td></tr></p>";
     }
     echo '</p>';
} else {
     echo "0 results";
}

$CONNECT->close();
?>  
  </div>
                </div>
            </div>

        </div>
    </div>