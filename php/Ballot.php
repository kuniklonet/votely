<?php
/**
 *
 */
class Ballot
{
  private $id;
  private $name = "";
  private $description = "";
  private $candidates = array();
  private $votes = array(); //array of vote objects relating to this ballot.
  function __construct($id, $name, $description)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
  }


  public static function makeExistingBallot($id){
    include('db.php');

    $query = "SELECT * FROM ballots WHERE id = '".$id."'";

    $result = $conn->query($query);
    if(mysqli_num_rows($result)>0){
      return 0;
    }else{
      $ballot = new Ballot;
      $ballot->setId($id);
      while($row = mysqli_fetch_array($result)){
        $ballot->setName($row['name']);
        $ballot->setDescription($row['description']);
        $candidates = self::retrieveCandidates;
        foreach ($candidates as $candidate) {
          $ballot.addCandidate($candidate);
        }
      }
      //retrieveDetails();
    }
  }

  /*
  * Returns a new Ballot object that contains its id in the database.
  */
  public static function makeNewBallot(){
    include('db.php');

    $query = "INSERT INTO ballots (description) VALUES ('test')";
    $conn->query($query);

    $lastId = $conn->insert_id;
    $ballot = new Ballot();
    $ballot->setId($lastId);
    return $ballot;
  }

  /**
  * Retrieves the candidates for the current ballot from the database, stores
  * them and returns them as an array of Candidates.
  */
  private static function retrieveCandidates($id){
    //sql get candidates where ballot_id = $id
    //"SELECT * FROM candidates WHERE ballot_id = '".$id."'";

    $placeholder = new Candidate(1,Dave,123);
    $candidates = array($placeholder);
    return $candidates;
  }

  public function commit(){
    include('db.php');
    $query = "UPDATE ballot SET name='".$this->name."', description='".$this->description."' WHERE id = '".$this->id."'";

    $conn->query($query);
  }


  public function toDashboardMarkup($userVotedState){
     $string = "";
     $string .= "<li class='collection-item avatar'>";
    $string .= "<i class='material-icons circle blue'>grade</i>";
    $string .= "<span class='title'>".$this->name."</span>";
    $string .= "<p>".$this->description."</p>";
    $string .= "<a href='#modal1'class='secondary-content btn-floating btn-large red' onclick='loadModal(".$this->id.")'>";
    $string .= "<i class='large material-icons'>subject</i>";
    $string .= "</a>";
    $string .= "</li>";
     return $string;
  }

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getDescription(){
    return $this->description;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function getCandidates(){
    return $candidates;
  }

  public function addCandidate($candidate){
    array_push($this->candidates, $candidate);
  }

  public function getVotes(){
    return $votes;
  }

  public function addVote($vote){
    array_push($this->votes, $vote);
  }

}

 ?>
