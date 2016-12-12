<?php
/* 
Registration
*/

include('/db/simpleDB.php');
include('/layouts/HTMLcomponents.php');
//error_reporting(0);
//Ulogin(1);
DidTheUserAdmin(1);


if(isset($_POST["name"]))  
{  
	$name = mysqli_real_escape_string($CONNECT, $_POST["name"]);  
	$message = mysqli_real_escape_string($CONNECT, $_POST["message"]);  

	$sql = "INSERT INTO clubgenre(code, category) VALUES ('".$name."', '".$message."')";  
	if(mysqli_query($CONNECT, $sql))  
	{  
		echo "Message Saved";  
	}  
}  

?>


<?php

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

					<form id="submit_form">  
						<div class="input-field col s6">
							<label>Code for Genre (Required 2 symbols)</label>  
							<input type="text" name="name" id="name" class="form-control" maxlength="2"/>  
						</div> 
						<div class="input-field col s6">
							<label>Name of genre (Max 15 symbols)</label>  
							<input type="text" name="message" id="message" class="form-control" maxlength="15"/>  
						</div> 
						<br />  
						<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
						<span id="error_message" class="text-danger"></span>  
						<span id="success_message" class="text-success"></span>  
					</form>  
				</div>
			</div>
		</div>

	</div>
</div>

<script>  
	$(document).ready(function(){  
		$('#submit').click(function(){  
			var name = $('#name').val();  
			var message = $('#message').val();  
			if(name == '' || message == '')  
			{  
				Materialize.toast('All Fields are required', 4000) ;
			}  
			else  
			{  
				$('#error_message').html('');  
				$.ajax({  
					url:"admingenre",  
					method:"POST",  
					data:{name:name, message:message},  
					success:function(data){  
						$("form").trigger("reset");  
						Materialize.toast('The Genre is added', 4000) ;  
					}  
				});  
			}  
		});  
	});  

	function getState(val) {
		$.ajax({
			type: "POST",
			url: "admingenre",
			data:'country_id='+val,
			success: function(data){
				$("#state-list").html(data);
			}
		});
	}

</script>  