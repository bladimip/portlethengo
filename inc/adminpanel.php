<?php
/* 
Main admin panel screen
*/
include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
// Navbar
top("Welcome to Portlethen");
//before displaying admin panel, checking if user is logged in, and then checking if hes admin; redirecting to landing if not;
if (isset($_SESSION['USER_SITEADMIN'])) {
	if (($_SESSION['USER_SITEADMIN']) == 1) {

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
				  <a href="/inc/adminusers.php" class="collection-item">Show all users</a>
				  <a href="/inc/admingenre.php" class="collection-item">Modify Genre</a>
				  <a href="/inc/adminusersrights.php" class="collection-item">Change user rights</a>
				  <a href="/inc/admingroups.php" class="collection-item"><span class="new badge red"><?php echo $notapproved ?></span>Approve the clubs</a>
				</div>
			  </div>
			</div>

		  </div>
		</div>
		<?php
	} else
		exit(header('Location: /inc/landing.php'));
} else 
	exit(header('Location: /inc/landing.php'));
?>
