<?php

if ($_SERVER['REQUEST_URI'] == '/site' ) $page = 'home';
else {
   $page = substr($_SERVER['REQUEST_URI'], 1);
    if( !preg_match('/^[A-z0-9]{3,150}$/', $page) ) exit('error url');
}

session_start();

if( file_exists('site/all/'.$page.'.php')) include 'site/all/'.$page.'.php';
else if( $_SESSION['uLogin'] != 1 and file_exists('site/auth/'.$page.'.php')) include 'site/auth/'.$page.'.php';
else if( $_SESSION['uLogin'] == 1 and file_exists('site/guest/'.$page.'.php')) include 'site/guest/'.$page.'.php';
else exit('Page404')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$start = 20;
$end = 90;
$sum = 0;
for($i = $start; $i <= $end; $i++) {
    if(fmod($i, 5) == 0) {
        $sum += $i;
    }
}
echo $sum;
?>
</body>
</html>