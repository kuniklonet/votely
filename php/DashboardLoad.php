<?php


class DashboardLoad{

  public static function retrieveBallots(){
    // require_once("Login.php");
    include_once("Ballot.php");
    include_once('db.php');
    session_start();
    $ballots = array();
    $alreadyVoted = array();
    $query = "SELECT 'ballot_id' FROM roll_call WHERE user_id = '".$_SESSION['userId']."'";
		$result = $conn->query($query);
		while($row = mysqli_fetch_array($result)){
		  array_push($alreadyVoted, $row['ballot_id']);
		}
    $query = "SELECT * FROM ballots WHERE organisation = '".$_SESSION['organisation']."' AND state = 1";
    $result = $conn->query($query);
    if(mysqli_num_rows($result)<1){
      return 10;
    }else{
      while($row = mysqli_fetch_array($result)){
      	if(!in_array($alreadyVoted, $row['id'])) {
					$ballot = Ballot::makeExistingBallot($row['id']);
					$ballot->setName($row['name']);
					$ballot->setDescription($row['description']);
					$ballot->setOrganisation($row['organisation']);
					$ballot->setState($row['state']);
					array_push($ballots, $ballot);
				}
      }
    }
    return $ballots;
  }

  public static function toDashboardMarkup($ballots){
    include_once("Ballot.php");
    $string = "<ul class='collection'>";

    for ($i = 0; $i < count($ballots); $i++) {
      $string .= $ballots[$i]->toDashboardMarkup();
    }
    $string .= "</ul>";
    return $string;
  }

  public static function toModalMarkup($ballot_id){
    require("Ballot.php");
    $ballot = Ballot::makeExistingBallot($ballot_id);
    $candidates = $ballot->getCandidates();
    $string = "<div class='modal-content'>";
    $string .= "<h3 id='ballot-id' name='".$ballot->getId()."'>".$ballot->getName()."</h3>";
    $string .= "<p>".$ballot->getDescription()."</p>";
    $string .= "<ul class='collection with-header'>";
    $string .= "<li class='collection-header'><h4>Candidates</h4></li>";

    foreach($candidates as $candidate){
      $string .= $candidate->toModalMarkup();
    }

    $string .= "</ul>";
    $string .= "</div>";
    $string .= "<div class='modal-footer'>";
    $string .= "<a id='modal-submit-button' class='waves-effect waves-light btn col s4' onclick='submit()'><i class='material-icons right'>send</i>Cast Vote</a>";
    $string .= "</div>";
    return $string;
  }
}
 ?>
