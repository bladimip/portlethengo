<head>
      <title>---</title>
     </head>
 <body>
 </body>
<?php
$start = 20;
$end = 45;
$sum = 0;
for($i = $start; $i <= $end; $i++) {
    if(fmod($i, 5) == 0) {
        $sum += $i;
    }
}
echo $sum;