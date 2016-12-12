<?php
/*
Developer: Arnis Zelcs
2016
*/

include_once('C_club.php');

class ClubContributor extends Club {

  protected $currentUserID = "";

  // METHODS
  public function setCurUserID($id) {
    $this->currentUserID = $id;
  }

  public function getCurUserID() {
    return $this->currentUserID;
  }

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
            <a id="addNewEventBtn" href="#addEventModal" class="btn purple accent-1">Add event</a>
          </div>

          <!-- Modal Structure -->
          <div id="addEventModal" class="modal">
            <div class="modal-content">
              <h5>New event for "'. $this->getName() .'" club</h5>
              <p>Please complete all fields below.</p>

              <form id="addNewEventForm">
                <!-- current user id, club id save to session -->
                <input type="text" name="title" placeholder="Title"/>
                <textarea id="textarea1" class="materialize-textarea" name="description" placeholder="Description"></textarea>
                <input type="date" name="date" class="datepicker" placeholder="Date">
              </form>

            </div>
            <div class="modal-footer">
              <a href="#!" id="saveNewEventBtn" class=" modal-action modal-close waves-effect waves-green btn-flat">SAVE</a>
            </div>
          </div>';
  }

}
?>
