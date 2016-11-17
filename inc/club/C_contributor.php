<?php
include_once('C_club.php');

class ClubContributor extends Club {

  // METHODS
  public function displayContent() {

    echo '<div class="row">';
      echo '<div class="col s12 l8 offset-l2 justify">';
        $this->showTitle();
        $this->showImages();
        $this->showCategory();
        $this->showDescription();
        $this->showContacts();
        $this->addEventOption();
        $this->showCalendar();
      echo '</div>';
    echo '</div>';
  }

  public function addEventOption() {
    echo 'Add event here';
  }

}
?>
