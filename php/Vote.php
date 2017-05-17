<?php
/**
 *
 */
class Vote
{
  private $id;
  private $ballot_id;
  private $preferences = array(); //array of key value preferences.
  function __construct($id, $ballot_id)
  {
    $this->id = $id;
    $this->ballot_id = $ballot_id;
  }

  public static function makeNewVote($preferences, $ballot, $userDetails){
    include('db.php');
    $ballotId = $ballot->getId();
    $query = "INSERT INTO vote (ballot_id) VALUES ('".$ballotId."')";
    $conn->query($query);

    $lastId = $conn->insert_id;
    $vote = new Vote($lastId, $ballotId);
    $vote->setPreferences($preferences);
    $vote->commitPreferences();
    $vote->commitRollcall($userDetails['userId']);

    return $vote;
  }

  private function commitPreferences(){
    include('db.php');
    foreach($this->preferences as $preference){
      $query = "INSERT INTO preference (vote_id, candidate_id, preference) VALUES ('".$this->id."','".$preference['candidate']."', '".$preference['preference']."')";
      var_dump($query);
      $conn->query($query);
    }
  }

  private function commitRollcall($userId){
    include('db.php');
    $query = "INSERT INTO roll_call (user_id, ballot_id) VALUES ('".$userId."', '".$ballotId."')";
    $conn->query($query);
  }

  public static function validateVote($vote, $ballot, $userDetails){
    //check preferences are well formed
    if(!self::checkPreferences($vote)){
      // echo "1";
      return 0;
    }
    //check user is a member of the same organisation as the ballot.
    if ($userDetails["organisation"] != $ballot->getOrganisation()){
      return 0;
    }
    //check user hasn't already voted
    if(self::checkUserVoted($ballot, $userDetails)){
      return 0;
    }
    // //vote is valid
    return 1;
  }

  private static function checkPreferences($vote){
    $checkingArray = array();
    $size = sizeof($vote);
    foreach($vote as $element){
      $checkingArray["p".$element['preference']] = $element['candidate'];
    }
    for($i=1; $i<=$size; $i++){
      if(!array_key_exists("p".$i,$checkingArray)){
        return 0;
      }
    }
    return 1;
  }

  private static function checkUserVoted($ballot, $userDetails){
    include('db.php');
    $query = "SELECT * FROM roll_call WHERE user_id = '".$userDetails["userId"]."' AND ballot_id = '".$ballot->getId()."'";
    $result = $conn->query($query);
    if(mysqli_num_rows($result)<1){
      return 0;
    }else{
      return 1;
    }
  }

  private function setPreferences($preferences){
    $this->preferences = $preferences;
  }

}

 ?>
