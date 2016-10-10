<?php

if ($_SERVER['REQUEST_URI'] == '/' ) $page = 'home';
else {
   $page = substr($_SERVER['REQUEST_URI'], 1);
    if( !preg_match('/^[A-z0-9]{3,15}$/', $page) ) exit('error url');
}
echo $page;
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