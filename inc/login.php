<?php
/*
Registration
*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
error_reporting(0);
Ulogin(0);


if ($_POST['enter'] ) {
    $_POST['login'] = FormChars($_POST['login']);
    $_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);

    if (!$_POST['login'] or !$_POST['password']) exit('DATA ENTRED ERROR');
    if ($CONNECT){
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `users` WHERE `username` = '$_POST[login]'"));
    if ($Row['password'] != $_POST['password']) exit('wrong login or password');
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `user_id`, `clubAdmin`,`nkpag`,`siteAdmin`,`username`  FROM `users` WHERE `username` = '$_POST[login]'"));
    $_SESSION['USER_ID'] = $Row['user_id'];
    $_SESSION['USER_CLUBADMIN'] = $Row['clubAdmin'];
    $_SESSION['USER_NKPAG'] = $Row['nkpag'];
    $_SESSION['USER_SITEADMIN'] = $Row['siteAdmin'];
    $_SESSION['USER_LOGIN'] = $Row['username'];
    $_SESSION['USER_LOGIN_IN'] = 1;
    exit(header('Location: /profile'));
}

    header ('Location: register');
    }

// Navbar
top("Welcome to Portlethen");

//Other page content
?><!--
    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Login</h4>
                    <p class="left-align light"><form method="POST" action="/login">

                    Login:      <input type="text" name="login" required><br>
                    Password :  <input type="password" name="password" required><br><br>
                    <input type="submit" name="enter" value="Login">
                    <input type="reset" value="Clear">


                    </p>
                </div>
            </div>

        </div>
    </div> -->
<?php

// Footer
bottom();

?>
