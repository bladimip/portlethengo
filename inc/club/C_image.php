<?php
  class Image {
    private $id;
    private $clubId;
    private $path;
    private $altName;

    public function __construct($id, $clubId, $path, $altName) {
      $this->id = $id;
      $this->clubId = $clubId;
      $this->path = $path;
      $this->altName = $altName;
    }

    // Setters
    public function setId($id) {
      $this->id = $id;
    }

    public function setClubId($clubId) {
      $this->clubId = $clubId;
    }

    public function setPath($path) {
      $this->path = $path;
    }

    public function setAltName($altName) {
      $this->altName = $altName;
    }

    // Getters
    public function getId() {
      return $this->id;
    }

    public function getClubId() {
      return $this->clubId;
    }

    public function getPath() {
      return $this->path;
    }

    public function getAltName() {
      return $this->altName;
    }

    public function toString() {
      echo "Image information:
              <br>ID: ". $this->getId() ."
              <br>CLUB ID: ". $this->getClubId() ."
              <br>PATH: ". $this->getPath() ."
              <br>NAME: ". $this->getAltName();
    }

  }
?>
