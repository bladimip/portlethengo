<?php

if ($_SERVER['REQUEST_URI'] == '/' ) $page = 'home';

var_dump( substr($_SERVER['REQUEST_URI'], ) );

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