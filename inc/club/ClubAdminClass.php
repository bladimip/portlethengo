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
                    <img class="materialboxed" src="'. $image->getPath() .'" alt="'. $image->getAltName() .'">
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

    echo '<br><div class="row">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Phone:</span>
            <input type="text" class="editField edit" name="cPhone" value="'. $this->getPhone() .'">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Email:</span>
            <input type="text" class="editField edit" name="cEmail" value="'. $this->getEmail() .'">
            <span class="lnr lnr-pencil"></span><span class="editLabel">Address:</span>
            <input type="text" class="editField edit" name="cAddress" value="'. $this->getAddress() .'">
          </div>';
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
