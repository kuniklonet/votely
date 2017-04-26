<?php
/**
 *
 */
class Ballot
{
  private $id;
  private $name;
  private $description;
  private $candidates;
  private $votes; //array of vote objects relating to this ballot.
  function __construct($id, $name, $description)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
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

  public function getName(){
    return $this->name;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getCandidates(){
    return $candidates;
  }

}

 ?>
