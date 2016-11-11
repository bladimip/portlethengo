<?php
/*
Club information template
Id of a club need to be passed to this script, otherwise it won't work and an output will be 404

t_club.php?id=news_id

Script connects to a database and fetches appropriate club
To use ORM:

$db = new Connection();
$db->open();
$result = $db->runQuery("SELECT * FROM clubs WHERE club_id = id");
$db->close();

*/

include('../db/simpleDB.php');
include('../layouts/HTMLcomponents.php');

// Navbar
top("Club name goes here");

//Other page content
if (isset($_GET["club"])) {
    $club = urldecode($_GET["club"]);

    echo '<h4 class="sp-title">'. $club .'</h4>';

    $db = new Connection();
    $db->open();
    $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND name = '". $club ."'");
    $db->close();

    echo '<div class="row">';
    while ($row = $club->fetch_assoc()) {
      echo '
      <div class="col s12 l8 offset-l2 justify">

          space for image(s)

          <h5>Category: '. $row["category"] .'</h5>
          '. $row["description"] .'
          <p><span class="lnr lnr-phone-handset"></span> '. $row["phone"] .'</p>
          <p><span class="lnr lnr-envelope"></span> '. $row["email"] .'</p>
          <p><span class="lnr lnr-location"></span> '. $row["address"] .'</p>
          <br>
          <h5>Event Calendar:</h5>
          <p>Events will go here...</p>
      </div>';
    }
    echo '</div>';

}

// Footer
bottom();
?>
