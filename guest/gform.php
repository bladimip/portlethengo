<?

if ($_POST['login_f']) {

	captcha_valid();

message( 'OK' );

}



else if ($_POST['register_f']) {

go('Login');

}




else if ($_POST['recovery_f']) {

message('Password Recovery');

}





else if ($_POST['confirm_f']) {

message('Confirmation');

}


?>