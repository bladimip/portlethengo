<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>name of the page</title>
</head>
<body>
<?php
$start = 20;
$end = 46;
$sum = 0;

for($i = $start; $i <= $end; $i++) {

    if(fmod($i, 5) == 0) {

        $sum += $i;
    }
echo $sum;
}
</body>