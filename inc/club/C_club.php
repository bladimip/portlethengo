<?php

class Club {

  // Properties
  protected $id;
  protected $name;
  protected $genre;
  protected $description;
  protected $phone;
  protected $email;
  protected $address;
  protected $images = [];
  protected $events = [];

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
    echo '<h5>Genre: '. $this->getGenre() .'</h5>';
  }

  public function showImages() {

    if (count($this->images) == 1) echo '<img src="" alt="">';

    elseif (count($this->images) > 1) {

      echo '<div class="slider">
              <ul class="slides">';
      for ($i=0; $i<count($this->images); $i++) {
        $image = $this->images[$i];
        echo '<li>
                <img src="'. $image->getPath() .'" alt="'. $image->getAltName() .'"> <!-- random image -->
                <div class="caption center-align">
                  <h3>Title - '. $image->getAltName() .'!</h3>
                  <h5 class="light grey-text text-lighten-3">Path '. $image->getPath() .'.</h5>
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

    if (count($this->events) > 0) {
      for ($i=0; $i<count($this->events); $i++) {
        $event = $this->events[$i];

        if ($event->getStatus() == "approved") {
          // C for club id, E for event id
          echo '<a href="/sportlethen/'.url($this->getGenre()).'/'.url($this->getName()).'/event/C'.$this->getId()."E".$event->getId().'" class="collection-item"><span>'. date_format(new DateTime($event->getEventDate()), 'd M Y') .'</span> '. $event->getName() .'</a>';
        }
      }
    } else {
      echo '<a href="#!" class="collection-item"><span></span>No events</a>';
    }
    echo '</div>';
  }

  public function addImage(Image $image) {
    $this->images[] = $image;
  }

  public function addEvent(Event $event) {
    $this->events[] = $event;
  }

  public function imagesToString() {
    for ($i=0; $i<count($this->images); $i++) {
      echo $this->images[$i]->toString();
    }
  }

  public function eventsToString() {
    for ($i=0; $i<count($this->events); $i++) {
      echo $this->events[$i]->toString();
    }
  }

  public function toString() {
    echo "Club information:
            ID: ". $this->getId() ."
            <br>GENRE: ". $this->getGenre() ."
            <br>NAME: ". $this->getName() ."
            <br>DESCRIPTION: ". $this->getDescription() ."
            <br>PHONE: ". $this->getPhone() ."
            <br>EMAIL: ". $this->getEmail() ."
            <br>ADDRESS: ". $this->getAddress();
  }

}
?>
