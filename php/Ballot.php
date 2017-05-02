<?php
/**
 *
 */
class Ballot
{
  private $id;
  private $name;
  private $description;
  private $candidates = array();
  private $votes = array(); //array of vote objects relating to this ballot.
  function __construct()
  {

  }

  public static function makeBallot(){
    include('db.php');
    // //using database
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
  public function retrieveCandidates(){
    //sql get candidates where ballot_id = $ballot_id
    //"SELECT * FROM candidates WHERE ballot_id = '".$id."'";

    $placeholder = new Candidate(1,Dave,123);
    $candidates = array($placeholder);
    return $candidates;
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
