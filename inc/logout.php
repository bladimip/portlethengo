<?php
  session_start();
  session_destroy();
  unset($_SESSION["USER_ID"]);
  unset($_SESSION["USER_CLUBADMIN"]);
  unset($_SESSION["USER_NKPAG"]);
  unset($_SESSION["USER_SITEADMIN"]);
  unset($_SESSION["USER_LOGIN"]);
  unset($_SESSION["USER_LOGIN_IN"]);

  unset($_SESSION["club_id"]);
  unset($_SESSION["eventID"]);

  header("Refresh:0");

  function destroyusersession () {
	session_start();
  session_destroy();
  unset($_SESSION["USER_ID"]);
  unset($_SESSION["USER_CLUBADMIN"]);
  unset($_SESSION["USER_NKPAG"]);
  unset($_SESSION["USER_SITEADMIN"]);
  unset($_SESSION["USER_LOGIN"]);
  unset($_SESSION["USER_LOGIN_IN"]);
}
?>
