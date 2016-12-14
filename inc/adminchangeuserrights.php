<?php
/* 
Admin panel for managing user rights
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
							<form id="submit_form">  
								<div>
			  <input type="checkbox" name="colorCheckbox" value="red" id="indeterminate-checkbox" />
			  <label for="indeterminate-checkbox">Make the user admin</label>
									<label><input type="checkbox" name="colorCheckbox" value="green"> green</label>
									<label><input type="checkbox" name="colorCheckbox" value="blue"> blue</label>
								</div>
								<div class="red box">You have selected <strong>red checkbox</strong> so i am here</div>
								<div class="green box">You have selected <strong>green checkbox</strong> so i am here</div>
								<div class="blue box">You have selected <strong>blue checkbox</strong> so i am here</div>
								<br />  
								<input type="button" name="submit" id="submit" class="btn btn-info" value="Save" />  
								<span id="error_message" class="text-danger"></span>  
								<span id="success_message" class="text-success"></span>  
							</form>  

							
						</div>
					</div>
				</div>

			</div>
		</div> 

		<script type="text/javascript">
			$(document).ready(function(){
				$('input[type="checkbox"]').click(function(){
					if($(this).attr("value")=="red"){
						$(".red").toggle();
						$(".green").toggle();
						$(".blue").toggle();
					}
					if($(this).attr("value")=="green"){
						$(".green").toggle();
					}
					if($(this).attr("value")=="blue"){
						$(".blue").toggle();
					}
				});
			});
		</script>
		<?php
	} else
		exit(header('Location: /inc/landing.php'));
} else 
	exit(header('Location: /inc/landing.php'));
?>