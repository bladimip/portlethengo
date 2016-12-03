<?php
/*
Developer: Arnis Zelcs
2016
*/

include_once('C_clubAdmin.php');

class ClubSiteAdmin extends ClubAdmin {

  private $thatClubAdmins = [];

  // METHODS
  //Overwrite a display function(method)
  public function displayContent() {

    echo '<div class="row">';
      echo '<div class="col s12 l8 offset-l2 justify">';
        $this->showImages();
        $this->showTitle();
        $this->showCategory();
        $this->showDescription();
        $this->showContacts();
        $this->showCalendar();
        $this->addEventOption();
        // Display all admins of that club
        $this->showClubAdmins();
      echo '</div>';
    echo '</div>';
  }

  public function addClubAdmins($arr) {
    $this->thatClubAdmins = $arr;
  }

  // Test function(method)
  public function toStringClubAdmins() {
    foreach ($this->thatClubAdmins as $value) {
      echo $value->getUsername() .'<br>';
    }
  }

  public function fetchAdmins() {
    $db = new Connection();
    $db->open();
    $thatClubAdmins = $db->runQuery("SELECT * FROM users, clubadmins WHERE users.user_id = clubadmins.user_id AND clubadmins.club_id = ". $this->getId() ."");
    $db->close();

    $adminsArr = array();
    while ($row = $thatClubAdmins->fetch_assoc()) {

      $uId = $row["user_id"];
      $uUsername = $row["username"];

      $adminsArr[] = new User($uId, $uUsername);
    }
    $this->addClubAdmins($adminsArr);
  }

  public function showClubAdmins() {
    echo '<span class="editLabel">Club Administrators:</span>';
    foreach ($this->thatClubAdmins as $value) {
      echo '<a>'. $value->getUsername() .'</a>';
    }
  }

}
?>
