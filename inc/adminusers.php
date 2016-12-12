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
  $name = mysqli_real_escape_string($CONNECT, $_POST["id"]);
  $sql = "UPDATE users SET blocked='0' WHERE user_id = '".$name."'";  
  if(mysqli_query($CONNECT, $sql))  
  {  
    echo "Message Saved";  
  }  
}

if(isset($_POST["idd"]))  
{  
  $name = mysqli_real_escape_string($CONNECT, $_POST["idd"]);
  $sql = "UPDATE users SET blocked='1' WHERE user_id = '".$name."'";  
  if(mysqli_query($CONNECT, $sql))  
  {  
    echo "Message Saved";  
  }  
}

if(isset($_POST["iddd"]))  
{  
  $name = mysqli_real_escape_string($CONNECT, $_POST["iddd"]);
  $sql = "DELETE FROM users WHERE user_id = '".$name."'";  
  if(mysqli_query($CONNECT, $sql))  
  {  
    echo "Message Saved";  
  }  
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
                    <h4>Admin Panel - Manipulate with users</h4>
                    <p class="center-align light">There you can change come details of users.</p>
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
'<input type="button" id="button_id" value="Unblock user" onClick="UpdateRecordunblock(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>' : '<input type="button" id="button_id" value="Block user" onClick="UpdateRecordblock(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>'). "</td><td>".'<input type="button" id="button_id" value="Delete User" onClick="DeleteRecord(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>' ."</td></tr></p>";
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


    <script>
  function UpdateRecordunblock(id)
  {
      jQuery.ajax({
       type: "POST",
       url: "adminusers",
       data: 'id='+id,
       cache: false,
       success: function(data, response)
       {
         Materialize.toast("User with id:" + id + " is successfully unblocked", 3000, 'rounded')
       }
     });
 }

 function UpdateRecordblock(idd)
  {
      jQuery.ajax({
       type: "POST",
       url: "adminusers",
       data: 'idd='+idd,
       cache: false,
       success: function(data, response)
       {
         Materialize.toast("User with id:" + idd + " is successfully blocked", 3000, 'rounded')
       }
     });
 }

 function DeleteRecord(iddd)
  {
      jQuery.ajax({
       type: "POST",
       url: "adminusers",
       data: 'iddd='+iddd,
       cache: false,
       success: function(data, response)
       {
         Materialize.toast("User with id:" + iddd + " is successfully deleted", 3000, 'rounded')
       }
     });
 }
</script>