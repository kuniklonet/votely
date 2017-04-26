<?php
/**
 *
 */
class Candidate
{
  private $id;
  private $name;
  private $ballot_id;
  function __construct($id, $name, $ballot_id)
  {
    $this->id = $id;
    $this->name = $name;
    $this->ballot_id = $ballot_id;
  }

  public function getId(){
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }
  public function getBallotId(){
    return $this->ballot_id;
  }

}

?>
