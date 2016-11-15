<?php

include('ClubClass.php');

class ClubAdmin extends Club {

  // METHODS

  public function addGenres($arr) {
    $this->genresAvailable = $arr;
  }

  public function getGenresAvailable() {
    return $this->genresAvailable;
  }

  public function showTitle() {
    echo '<br><div class="row">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Title:</span>
            <input type="text" class="sp-title edit" name="cTitle" value="'. $this->getName() .'">
          </div>';
  }

  public function showCategory() {
    echo '<div class="row">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Genre:</span>
              <select class="input-field">';

              foreach ($this->genresAvailable as $key => $value) {

                if ($value != $this->getGenre()) {
                  echo '<option value="'. key($this->genresAvailable) .'">'. $value .'</option>';
                } else {

                  echo '<option value="'. key($this->genresAvailable) .'" selected>'. $value .'</option>';
                }
                // Go to next key
                next($this->genresAvailable);
              }
    echo '    </select>
          </div>';
  }

  public function showImages() {

    if (count($this->images) > 0) {

      echo '<span class="lnr lnr-pencil"></span><span class="editLabel">Images:</span>
          <div class="row">';
      for ($i=0; $i<count($this->images); $i++) {
        $image = $this->images[$i];
        echo '<div class="imgLayout">
                  <div class="editImage">
                    <img class="materialboxed" src="http://lorempixel.com/580/250/nature/'.$i.'" alt="'. $image->getAltName() .'">
                  </div>
                  <div class="ImgDeleteBtn"><span class="lnr lnr-trash"></span>delete</div>
              </div>';
      }
      echo '</div>';
    }
  }

  public function showDescription() {

    echo '<div class="row">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Description:</span>
            <div class="input-field col s12">
              <textarea id="textarea1" class="materialize-textarea edit">'. $this->getDescription() .'</textarea>
            </div>
          </div>';
  }

  public function showContacts() {

    echo '<p><span class="lnr lnr-phone-handset"></span> '. $this->getPhone() .'</p>
          <p><span class="lnr lnr-envelope"></span> '. $this->getEmail() .'</p>
          <p><span class="lnr lnr-location"></span> '. $this->getAddress() .'</p>';
  }

  public function showCalendar() {

    echo '<h5>Event Calendar:</h5>';
    echo '<div class="collection">';

    if (count($this->events) > 0) {
      for ($i=0; $i<count($this->events); $i++) {
        $event = $this->events[$i];
        echo '<a href="#!" class="collection-item"><span>'.($i + 1).'</span> '. $event->getName() .'</a>';
      }
    } else {
      echo '<a href="#!" class="collection-item"><span></span>No events</a>';
    }
    echo '</div>';
  }

}
?>
