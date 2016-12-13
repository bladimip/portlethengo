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
	$sql = "UPDATE users SET siteAdmin='1' WHERE user_id = '".$name."'";

	if(mysqli_query($CONNECT, $sql))
	{
		echo "Message Saved";
	}
}

if(isset($_POST["iddddd"]))
{
	$cname = $row["user_id"];
	$name = mysqli_real_escape_string($CONNECT, $_POST["iddddd"]);
	$sql = "INSERT INTO clubadmins(user_id, club_id) VALUES ('".$name."', '".$cname."')";
	if(mysqli_query($CONNECT, $sql))
	{
		echo "Message Saved";
	}
}

if(isset($_POST["idd"]))
{
	$name = mysqli_real_escape_string($CONNECT, $_POST["idd"]);
	$sql = "UPDATE users SET siteAdmin='0' WHERE user_id = '".$name."'";
	if(mysqli_query($CONNECT, $sql))
	{
		echo "Message Saved";
	}
}


if(isset($_POST["iddd"]))
{
	$name = mysqli_real_escape_string($CONNECT, $_POST["iddd"]);
	$sql = "UPDATE users SET nkpag='0' WHERE user_id = '".$name."'";
	if(mysqli_query($CONNECT, $sql))
	{
		echo "Message Saved";
	}
}

if(isset($_POST["idddd"]))
{
	$name = mysqli_real_escape_string($CONNECT, $_POST["idddd"]);
	$sql = "UPDATE users SET nkpag='1' WHERE user_id = '".$name."'";
	if(mysqli_query($CONNECT, $sql))
	{
		echo "Message Saved";
	}
}

$userid = mysqli_real_escape_string($CONNECT, $_SESSION['user_crID']);
$sql = "SELECT user_id, username, nkpag, clubAdmin, siteAdmin FROM users WHERE user_id = '".$userid."'";
$result = $CONNECT->query($sql);
$row = $result->fetch_assoc();
mysqli_query($CONNECT, $sql);

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
					<a href="adminusersrights" class="collection-item">Go back</a>
					<h5>Now you changing the user "<?php echo $row["username"] ?>" rights</h5>
					<hr>
					<div  class="container">
						<p>
							<input type="checkbox" name="colorCheckbox" value="gadmin" id="indeterminate-checkbox" />
							<label for="indeterminate-checkbox">Make this user - General Admin of website</label>
						</p>


						<p>
							<input type="checkbox" name="colorCheckbox" value="cadmin" id="test7" />
							<label for="test7">Make this user - club or admin Admin</label>
						</p>
					</div>
					<div class="gadmin box">
						<?php
						echo (($row["siteAdmin"] ? '1' : 0) ?
							'<input type="button" id="button_id" value="Delete user rights" onClick="deleterightadmin(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>' : '<input type="button" id="button_id" value="Make user Admin" onClick="makeuseradmin(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>'). "</td>";

							?>
						</div>


						<div class="cadmin box">
							<?php

							if ($CONNECT->connect_error) {
								die("Connection failed: " . $CONNECT->connect_error);
							}

							$sqlclub = "SELECT club_id, name FROM clubs";
							$resultclubs = $CONNECT->query($sqlclub);
							if ($resultclubs->num_rows > 0) {
								echo '<table class="centered highlight">
								<thead>
									<tr>
										<th>Club ID</th>
										<th>Club Name</th>
										<th>Make user club admin</th>
									</tr>
								</thead>
								';
								echo '<p class="centre-align light"><form method="POST" action="/adminusersrights">';
    // output data of each row
								while($rowclub = $resultclubs->fetch_assoc()) {

									$admin = "";
									$db = new Connection();
									$db->open();
									$adminCheck = $db->runQuery("SELECT * FROM ClubAdmins WHERE user_id = ". $row["user_id"] ." AND club_id = ". $rowclub["club_id"]);
									$db->close();
									if ($adminCheck->num_rows >= 1) {
										$admin = "admin";
									} else {
										$admin = "notadmin";
									}

									echo "<tbody>
									<tr>
										<td>".$rowclub["club_id"]."</td><td>".$rowclub["name"]."</td><td>".($admin == "admin" ? '<input type="button" id="button_id" value="Delete user club admin rights" onClick="unmakeuserclubadmin(' . $row["user_id"] .', ' . $rowclub["club_id"] .');" class="waves-effect waves-light btn" ></a>' : '<input type="button" id="button_id" value="Make User this club admin" onClick="makeuserclubadmin(' . $rowclub["club_id"] .');" class="waves-effect waves-light btn" ></a>')."</td></tr></p>";
									};
								} else {
									echo "0 results";
								}

								$CONNECT->close();
								?>


								<?php
								echo (($row["nkpag"] ? '1' : 0) ?
									'<input type="button" id="button_id" value="Delete user map Admin rights" onClick="deleterightmap(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>' : '<input type="button" id="button_id" value="Make user map Admin" onClick="addrightmap(' . $row["user_id"] .');" class="waves-effect waves-light btn" ></a>'). "</td>";

									?>

								</div>
								<br />
							</div>
						</div>
					</div>

				</div>
			</div>

			<script>

				var chk1 = $("input[type='checkbox'][value='gadmin']");
				var chk2 = $("input[type='checkbox'][value='cadmin']");

				$(document).ready(function(){
					$(".cadmin").hide();
					$(".madmin").hide();
					$(".gadmin").hide();
					$('input[type="checkbox"]').click(function(){
						if($(this).attr("value")=="gadmin"){
						//	chk2.prop('checked', false);
						//	chk3.prop('checked', false);
						$(".gadmin").toggle();
					}
					else if($(this).attr("value")=="cadmin"){
						chk1.prop('checked', false);
						//	chk2.prop('checked', false);
						$(".cadmin").toggle();

					}

				});
				});


				function makeuserclubadmin(iddddd)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data: 'iddddd='+iddddd,
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("User with id:" + iddddd + " is now Admin of club", 3000, 'rounded')
						}
					});
				}

				function unmakeuserclubadmin(uid, cid)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data : { uid : 'uid', cid : 'cid' },
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("User with id:" + uid + " is now NOT Admin of club with id" + cid, 3000, 'rounded')
						}
					});
				}

				function makeuseradmin(id)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data: 'id='+id,
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("User with id:" + id + " is now Admin", 3000, 'rounded')
						}
					});
				}

				function deleterightadmin(idd)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data: 'idd='+idd,
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("Admin rights for id:" + idd + " is successfully deleted", 3000, 'rounded')
						}
					});
				}

				function deleterightmap(iddd)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data: 'iddd='+iddd,
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("Map Admin rights for id:" + iddd + " is successfully deleted", 3000, 'rounded')
						}
					});
				}

				function addrightmap(idddd)
				{
					jQuery.ajax({
						type: "POST",
						url: "/inc/adminchange.php",
						data: 'idddd='+idddd,
						cache: false,
						success: function(data, response)
						{
							Materialize.toast("Map Admin rights for id:" + idddd + " is added", 3000, 'rounded')
						}
					});
				}
			</script>
