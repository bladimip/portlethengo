<?php
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
