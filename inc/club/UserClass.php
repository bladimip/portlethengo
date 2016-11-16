<?php

class User {

  private $id;
  private $username;

  public function __construct($id, $username) {
    $this->id = $id;
    $this->username = $username;
  }

  // METHODS
  public function getId() {
    return $this->id;
  }

  public function getUsername() {
    return $this->username;
  }

  public function toString() {
    echo 'USER ID: '. $this->getId() .
          'USERNAME: '. $this->getUsername();
  }
}

?>
