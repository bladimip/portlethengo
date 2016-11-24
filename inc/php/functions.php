<?php
// Additional functions
function url($url) {
   $url = preg_replace('~[^\\pL0-9_]+~u', '+', $url);
   $url = trim($url, "-");
   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
   $url = preg_replace('~[^-a-z-A-Z0-9_]+~', '+', $url);
   return $url;
}
?>
