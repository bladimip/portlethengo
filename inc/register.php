<?php
/*
Registration
*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
error_reporting(0);

if (isset($_POST['enter'])) {
    $_POST['login'] = FormChars($_POST['login']);
    $_POST['email'] = FormChars($_POST['email']);
    $_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);

    if (!$_POST['login'] or !$_POST['email'] or !$_POST['password']) exit('DATA ENTRED ERROR');

    if ($CONNECT){
    $Roww = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'"));
    if ($Roww['login']) exit('Login <b>'.$_POST['login'].'</b> allready in use');
    $Row2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'"));
    if ($Row2['email']) exit('Email <b>'.$_POST['email'].'</b> allready in use');
}
    //mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '0', '0', '0', '$_POST[login]', '$_POST[email]', '$_POST[password]', '0')");
    $db = new Connection();
    $db->open();
    $db->runQuery("INSERT INTO `users` (clubAdmin, nkpag, siteAdmin, username, email, password, blocked)  VALUES ('0', '0', '0', '$_POST[login]', '$_POST[email]', '$_POST[password]', '0')");
    $db->close();

    if ($CONNECT){
        if($Roww['login'] != mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'")) or ($Row2['email'] != mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'")))){
    exit(header('Location: /'));
}
    }
}


?>
