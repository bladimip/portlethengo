<?php
class Club {

  // Properties
  private $id;
  private $name;
  private $genre;
  private $description;
  private $phone;
  private $email;
  private $address;
  private $images = array(2,2,5);
  private $events = array(2,2,5);

  // Constructor
  public function __construct($id, $name, $genre, $description, $phone, $email, $address) {
    $this->id = $id;
    $this->name = $name;
    $this->genre = $genre;
    $this->description = $description;
    $this->phone = $phone;
    $this->email = $email;
    $this->address = $address;
  }

  // Setters
  public function setName($name) {
    $this->name = $name;
  }

  public function setGenre($genre) {
    $this->genre = $genre;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setPhone($phone) {
    $this->phone = $phone;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setAddress($address) {
    $this->address = $address;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getGenre() {
    return $this->genre;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getAddress() {
    return $this->address;
  }


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
      echo '</div>';
    echo '</div>';
  }

  public function showTitle() {
    echo '<h4 class="sp-title">'. $this->getName() .'</h4>';
  }

  public function showCategory() {
    echo '<h5>Category: '. $this->getGenre() .'</h5>';
  }

  public function showImages() {

    if (count($this->images) == 1) echo '<img src="" alt="">';

    elseif (count($this->images) > 1) {

      echo '<div class="slider">
              <ul class="slides">';
      for ($i=0; $i<count($this->images); $i++) {
        echo '<li>
                <img src="http://lorempixel.com/580/250/nature/'.$i.'"> <!-- random image -->
                <div class="caption center-align">
                  <h3>This is our big Tagline '.$i.'!</h3>
                  <h5 class="light grey-text text-lighten-3">Heres our small slogan '.$i.'.</h5>
                </div>
              </li>';
      }
      echo '</ul>
          </div>';
    }
  }

  public function showDescription() {

    echo '<p>'. $this->getDescription() .'</p>';
  }

  public function showContacts() {

    echo '<p><span class="lnr lnr-phone-handset"></span> '. $this->getPhone() .'</p>
          <p><span class="lnr lnr-envelope"></span> '. $this->getEmail() .'</p>
          <p><span class="lnr lnr-location"></span> '. $this->getAddress() .'</p>';
  }

  public function showCalendar() {

    echo '<h5>Event Calendar:</h5>';
    echo '<div class="collection">';

    for ($i=0; $i<count($this->events); $i++) {
      echo '<a href="#!" class="collection-item"><span>'.($i + 1).'</span> ...</a>';
    }
    echo '</div>';
  }

  public function toString() {
    return "Club information:
            \nID: ". $this->getId() ."
            \nGENRE: ". $this->getGenre() ."
            \nNAME: ". $this->getName() ."
            \nDESCRIPTION: ". $this->getDescription() ."
            \nPHONE: ". $this->getPhone() ."
            \nEMAIL: ". $this->getEmail() ."
            \nADDRESS: ". $this->getAddress();
  }

}
?>
