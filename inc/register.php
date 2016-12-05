<?php
/* 
Registration
*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
Ulogin(0);
error_reporting(0);

if ($_POST['enter']) {
    $_POST['login'] = FormChars($_POST['login']);
    $_POST['email'] = FormChars($_POST['email']);
    $_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);

    if (!$_POST['login'] or !$_POST['email'] or !$_POST['password']) exit('DATA ENTRED ERROR');
    
    if ($CONNECT){
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'"));
    if ($Row['login']) exit('Login <b>'.$_POST['login'].'</b> allready in use');
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'"));
    if ($Row['email']) exit('Email <b>'.$_POST['email'].'</b> allready in use');
}
    mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '0', '0', '0', '$_POST[login]', '$_POST[email]', '$_POST[password]', '0')");

    header ('Location: login');
    }


// Navbar
top("Registration");
//Other page content
?>
    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Registration</h4>
                    <p class="left-align light"><form method="POST" action="/register">

                    Login:      <input type="text" name="login" required><br>
                    E-mail:     <input type="email" name="email" required><br>
                    Password :  <input type="password" name="password" required><br><br>
                    <input type="submit" name="enter" value="Registration">
                    <input type="reset" value="Clear">


                    </p>
                </div>
            </div>

        </div>
    </div>
<?php

// Footer
bottom();

?>
