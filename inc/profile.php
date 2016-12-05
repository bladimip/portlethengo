<?php
/* 
Registration
*/

include('db/simpleDB.php');
include('layouts/HTMLcomponents.php');
error_reporting(0);
Ulogin(1);
// Navbar
top("Welcome to Portlethen");

//Other page content
?>
    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Profile</h4>
                    <?php 
                    // i use rhe ternary operator
                    echo
                    'ID:'.$_SESSION['USER_ID'].
                    '<br>Hello: '.$_SESSION['USER_LOGIN'].
                    //"<br>You are ".($_SESSION['USER_CLUBADMIN'] == 1 ? " ClubAdmin" : "").($_SESSION['USER_NKPAG'] == 1 ? " MapAdmin" : "").($_SESSION['USER_SITEADMIN'] == 1 ? "Admin" : "").($_SESSION['USER_SITEADMIN'] == 0 or $_SESSION['USER_NKPAG'] == 0 or $_SESSION['USER_CLUBADMIN'] == 0? "Not admin" : "")."!";
                    //echo 
                    '<br>Clubadmin - '.WhoIsUser($_SESSION['USER_CLUBADMIN']).
                    '<br>MapAdmin - '.WhoIsUser($_SESSION['USER_NKPAG']).
                    '<br>SiteAdmin - '.WhoIsUser($_SESSION['USER_SITEADMIN']).'';

                    ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
<?php

// Footer
bottom();

?>