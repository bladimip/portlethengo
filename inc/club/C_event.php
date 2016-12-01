<?php
/*
Developer: Arnis Zelcs
2016
*/

  class Event {
    private $id;
    private $clubId;
    private $userId;
    private $approvedBy;
    private $name;
    private $description;
    private $eventDate;
    private $status;

    public function __construct($id, $clubId, $userId, $approvedBy, $name, $description, $eventDate, $status) {
      $this->id = $id;
      $this->clubId = $clubId;
      $this->userId = $userId;
      $this->approvedBy = $approvedBy;
      $this->name = $name;
      $this->description = $description;
      $this->eventDate = $eventDate;
      $this->status = $status;
    }

    // Setters
    public function setId($id) {
      $this->id = $id;
    }

    public function setClubId($id) {
      $this->clubId = $id;
    }

    public function setUserId($id) {
      $this->userId = $id;
    }

    public function setApprovedBy($id) {
      $this->approvedBy = $id;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function setEventDate($date) {
      $this->eventDate = $date;
    }

    public function setStatus($status) {
      $this->status = $status;
    }

    // Getters
    public function getId() {
      return $this->id;
    }

    public function getClubId() {
      return $this->clubId;
    }

    public function getUserId() {
      return $this->userId;
    }

    public function getApprovedBy() {
      return $this->approvedBy;
    }

    public function getName() {
      return $this->name;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getEventDate() {
      return $this->eventDate;
    }

    public function getStatus() {
      return $this->status;
    }


    public function displayContent() {
      echo '<div class="row">';
        echo '<div class="col s12 l8 offset-l2 justify">';
          $this->showTitle();
          $this->showDescription();
          $this->showClub();
          $this->showUsers();
        echo '</div>';
      echo '</div>';
    }

    public function showTitle() {
      echo '<h4 class="sp-title">'. $this->getName() .'</h4>';
    }

    public function showDescription() {

      echo '<p>'. $this->getDescription() .'</p>';
      echo '<p>Date: '. date_format(new DateTime($this->getEventDate()), 'd M Y') .'</p>';
    }

    public function showClub() {
      $db = new Connection();
      $db->open();
      $club = $db->runQuery("SELECT * FROM clubs,clubgenre WHERE genreCode = code AND club_id = '". $this->getClubId() ."' LIMIT 1");
      $db->close();

      if (mysqli_num_rows($club) == 1) {
          while ($row = $club->fetch_assoc()) {

            echo '<span class="grey-text text-lighten-1">Club: </span>';
            echo '<a href="/sportlethen/'. url($row["category"]) .'/'. url($row["name"]) .'-C'.$row["club_id"].'">'. $row["name"] .'</a><br>';
          }
       }
    }

    public function showUsers() {
      $db = new Connection();
      $db->open();
      $user = $db->runQuery("SELECT * FROM users WHERE user_id = ". $this->getUserId() ." LIMIT 1");
      $db->close();

      if (mysqli_num_rows($user) == 1) {
          while ($row = $user->fetch_assoc()) {

            echo '<span class="grey-text text-lighten-1">Event was added by: </span>';
            echo '<a>'. $row["username"] .'</a>';
          }
       }
    }

    // teat method
    public function toString() {
      echo "Event information:
              <br>ID: ". $this->getId() ."
              <br>CLUB ID: ". $this->getClubId() ."
              <br>USER ID: ". $this->getUserId() ."
              <br>APPROVED BY: ". $this->getApprovedBy() ."
              <br>NAME: ". $this->getName() ."
              <br>DESCRIPTION: ". $this->getDescription() ."
              <br>DATE: ". $this->getEventDate() ."
              <br>STATUS: ". $this->getStatus();
    }

  }
?>
