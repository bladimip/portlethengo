<?php
  session_start();
  session_destroy();
  unset($_SESSION["USER_ID"]);
  unset($_SESSION["USER_CLUBADMIN"]);
  unset($_SESSION["USER_NKPAG"]);
  unset($_SESSION["USER_SITEADMIN"]);
  unset($_SESSION["USER_LOGIN"]);
  unset($_SESSION["USER_LOGIN_IN"]);

  echo 'success';
?>
