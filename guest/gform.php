<?

if ($_POST['login_f']) {

	captcha_valid();

	message( 'OK' );

}



else if ($_POST['register_f']) {
	email_valid();
	password_valid();
	captcha_valid();



	if ( mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `email` = '$_POST[email]'")) )
		message('@mail is inuse');


	$code = random_str(5);

	$_SESSION['confirm'] = array(
		'type' => 'register',
		'email' => $_POST['email'],
		'password' => $_POST['password'],
		'code' => $code,
	);

	mail($_POST['email'], 'Registration', "Registration code confirm: <b>$code</b>");


	go('confirm');




}










else if ($_POST['recovery_f']) {
	//captcha_valid();
	email_valid();

	if ( !mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `email` = '$_POST[email]'")) )
		message('Cant find the account');

	$code = random_str(5);

	$_SESSION['confirm'] = array(
		'type' => 'recovery',
		'email' => $_POST['email'],
		'code' => $code,
	);

	mail($_POST['email'], 'Password recovery', "Code for password recovery: <b>$code</b>");

	go('confirm');


}












else if ($_POST['confirm_f']) {




	if ( $_SESSION['confirm']['type'] == 'register') {




		if ( $_SESSION['confirm']['code'] != $_POST['code'] )
			message('Code is wrong');


		mysqli_query($CONNECT, 'INSERT INTO `users` VALUES ("", "'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'")');
		unset($_SESSION['confirm']);

		go('login');

	}




	else if ( $_SESSION['confirm']['type'] == 'recovery') {


		$newpass = random_str(10);


		mysqli_query($CONNECT, 'UPDATE `users` SET `password` = "'.md5($newpass).'" WHERE `email` = "'.$_SESSION['confirm']['email'].'"');
		unset($_SESSION['confirm']);

		message("New Password: $newpass");






	}

	else not_found();






}







?>