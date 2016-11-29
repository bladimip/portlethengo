<?php

include_once('C_clubContributor.php');

class ClubAdmin extends ClubContributor {

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
      echo '<div class="btn lime addImgBtn"><span class="lnr lnr-upload"></span> Upload Image(s)</div>';
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

        // C for club id, E for event id
        if ($event->getStatus() == "1") {
          echo '<a href="/sportlethen/'.url($this->getGenre()).'/'.url($this->getName()).'/event/C'.$this->getId()."E".$event->getId().'" class="collection-item lime"><span>'. date_format(new DateTime($event->getEventDate()), 'd M Y') .'</span> '. $event->getName() .'<span class="badge">approved</span></a>';
        } else {
          echo '<a href="/sportlethen/'.url($this->getGenre()).'/'.url($this->getName()).'/event/C'.$this->getId()."E".$event->getId().'" class="collection-item grey lighten-2"><span>'. date_format(new DateTime($event->getEventDate()), 'd M Y') .'</span> '. $event->getName() .'<span class="badge">not approved</span></a>';
        }

      }
    } else {
      echo '<a href="#!" class="collection-item"><span></span>No events</a>';
    }
    echo '</div>';
  }


  // ADD ADDITIONAL INFORMATION
  public function fetchGenres() {
    $db = new Connection();
    $db->open();
    $genres = $db->runQuery("SELECT * FROM clubgenre");
    $db->close();

    $genresArr = array();
    while ($row = $genres->fetch_assoc()) {
      $genresArr[$row["code"]] = $row["category"];
    }
    $this->addGenres($genresArr);
  }

}
?>
