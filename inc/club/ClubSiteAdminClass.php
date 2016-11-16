<?php

include('ClubAdminClass.php');

class ClubSiteAdmin extends ClubAdmin {

  private $thatClubAdmins = [];

  // METHODS
  //Overwrite a display function(method)
  public function displayContent() {

    echo '<div class="row">';
      echo '<div class="col s12 l8 offset-l2 justify">';
        $this->showTitle();
        $this->showImages();
        $this->showCategory();
        $this->showDescription();
        $this->showContacts();
        $this->showCalendar();
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

  public function showClubAdmins() {
    echo '<span class="editLabel">Club Administrators:</span>';
    foreach ($this->thatClubAdmins as $value) {
      echo '<a>'. $value->getUsername() .'</a>';
    }
  }

}
?>
