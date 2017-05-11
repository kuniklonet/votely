<?php


class DashboardLoad{

  public static function retrieveBallots(){

    include_once("Login.php");
    include_once("Ballot.php");
    include_once('db.php');
    $Login->start_session();
    $ballots = array();
    // // $query = "SELECT * FROM ballots WHERE organisation = '".$_SESSION['organisation']."' AND state = 1";
    $query = "SELECT * FROM ballots";
    $result = $conn->query($query);
    if(mysqli_num_rows($result)<1){
      return 10;
    }else{
      while($row = mysqli_fetch_array($result)){
        $ballot = Ballot::makeExistingBallot($row['id']);
        $ballot->setName("testname");
        $ballot->setName($row['name']);
        $ballot->setDescription($row['description']);
        $ballot->setOrganisation($row['organisation']);
        $ballot->setState($row['state']);
        array_push($ballots, $ballot);
      }
    }
    return $ballots;
  }

  public static function toMarkup($ballots){
    include_once("Ballot.php");
    $string = "<ul class='collection'>";

    for ($i = 0; $i < count($ballots); $i++) {
      $string .= $ballots[$i]->toDashboardMarkup();
    }
    $string .= "</ul>";
    return $string;
  }

  public static function toJSON(){

  }
}
 ?>
