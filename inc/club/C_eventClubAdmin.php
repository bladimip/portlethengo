<?php
/*
Developer: Arnis Zelcs
2016
*/

include_once('C_Event.php');

  class EventAdmin extends Event {

    public function displayContent() {
      echo '<div class="row">';
        echo '<div class="col s12 l8 offset-l2 justify">';
          $this->showTitle();
          $this->showDescription();
          $this->showClub();
          $this->showUsers();
          $this->showStatus();
          $this->showControls();
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
            echo '<a id="club_link" href="t_club.php?club=C'.$row["club_id"].'">'. $row["name"] .'</a><br>';
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
            echo '<a id="user_link" href="../profile.php?username='. url($row["username"]) .'">'. url($row["username"]) .'</a>';
          }
       }
    }


    public function showStatus() {
      if ($this->getStatus()) {
        echo '<br><span class="grey-text text-lighten-1">Status: approved</span>';

        $db = new Connection();
        $db->open();
        $user = $db->runQuery("SELECT * FROM users WHERE user_id = ". $this->getApprovedBy() ." LIMIT 1");
        $db->close();

        if (mysqli_num_rows($user) == 1) {
            while ($row = $user->fetch_assoc()) {

              echo '<br><span class="grey-text text-lighten-1">Approved by: </span>';
              echo '<a id="user_link" href="/users/'. url($row["username"]) .'">'. url($row["username"]) .'</a>';
            }
         }

      } else {
        echo '<br><span class="grey-text text-lighten-1">Status: not approved<br>Approved by: <span id="approvedBy"></span></span>';
      }
    }

    public function showControls() {
      echo '<div class="centerPos">';
      if (!$this->getStatus()) {
        echo '<div class="btn grey-text text-darken-3 lime waves-effect waves-light eControlBtn">Approve</div>
              <div class="btn grey-text text-darken-3 red lighten-3 waves-effect waves-light eControlBtn">Delete</div>';
      } else echo '<div class="btn grey-text text-darken-3 red lighten-3 waves-effect waves-light eControlBtn">Delete</div>';
      echo '</div>';
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
