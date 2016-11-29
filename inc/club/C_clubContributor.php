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
        $this->showCalendar();
        $this->addEventOption();
      echo '</div>';
    echo '</div>';
  }

  public function addEventOption() {
    echo '<div class="centerPos">
            <div class="btn purple accent-1 waves-effect waves-light">Add event</div>
          </div>';
  }

}
?>
