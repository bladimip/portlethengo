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
                    <h4>Admin Panel</h4>
                    <p class="center-align light">There you can change come details of users and webpage.</p>
                    <div class="collection">
    <a href="adminpanel" class="collection-item">Go to admin panel</a>

<?php

if ($CONNECT->connect_error) {
     die("Connection failed: " . $CONNECT->connect_error);
} 

$sql = "SELECT user_id, username, blocked FROM users";
$result = $CONNECT->query($sql);

if ($result->num_rows > 0) {
     echo '<table class="centered highlight">
        <thead>
          <tr>
              <th>User ID</th>
              <th>Username</th>
              <th>Did the user block?</th>
              <th>Delite User</th>
          </tr>
        </thead>
        ';
      echo '<p class="centre-align light"><form method="POST" action="/adminuser">';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tbody>
          <tr>
            <td>".$row["user_id"]."</td><td>".$row["username"]."</td><td> ".(($row["blocked"] ? '1' : 0) ? 
'<a class="waves-effect waves-light btn">Unblock User</a>' : '<a class="waves-effect waves-light btn">Block User</a>'). "</td><td>".'<input type="submit" name="delete" value="Delete User" class="waves-effect waves-light btn"></p>' ."</td></tr></p>";
     }
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