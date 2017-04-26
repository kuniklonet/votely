<?php
/**
 *
 */
class Vote
{
  private $id;
  private $ballot_id;
  private $preferences; //array of key value preferences.
  function __construct($id, $ballot_id)
  {
    $this->id = $id;
    $this->ballot_id = $ballot_id;
  }

  public function retrievePreferences(){
    //"SELECT * FROM preference WHERE vote_id = '".$id."'";
    $placeholder = array(1 => 123,2 => 243); //(preferece => candidate_id)
    $preferences = $placeholder;
  }

  public function commit(){
    // First add the user to the roll for this ballot.
    // "INSERT INTO roll_call (user_id, ballot_id) VALUES (".$_SESSION['user'].",".$ballot_id.")";
    //
    // Next create a new vote in the database
    // "INSERT INTO vote (ballot_id) VALUES (".$ballot_id.")";

    //TODO: Find out what id the DBMS gave this vote. Store it in $id.

    // for ($i=0; $i < count($preferences); $i++) {
      //insert each preference
    // }
  }

}

 ?>
