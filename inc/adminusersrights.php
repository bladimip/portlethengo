<?php
/* 
Registration
*/
include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
//error_reporting(0);
//Ulogin(1);
DidTheUserAdmin(1);


if(isset($_POST["id"]))  
{  
  $_SESSION['user_crID'] = $_POST["id"];
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
                    <h4>Admin Panel - Change user rights</h4>
                    <p class="center-align light">There you can give to some user different rights</p>
                    <div class="collection">
    <a href="/inc/adminpanel.php" class="collection-item">Go to admin panel</a>

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
              <th>Change user rights</th>
          </tr>
        </thead>
        ';
      echo '<p class="centre-align light"><form method="POST" action="/inc/adminusersrights.php">';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tbody>
          <tr>
            <td>".$row["user_id"]."</td><td>".$row["username"]."</td><td>".'<input type="button" name="submit" id="submit" class="btn btn-info" value="Change" onClick="ChangeUserRughts(' . $row["user_id"] .');" />  ' ."</td></tr></p>";
     };
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

<script>

function ChangeUserRughts(id)
  {
      jQuery.ajax({
       type: "POST",
       url: "/inc/adminusersrights.php",
       data: 'id='+id,
       cache: false,
       success: function(data, response)
       {
        window.location.href = "/inc/adminchange.php";
       }
     });
 }

</script>