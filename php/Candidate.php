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

  public function toModalMarkup(){
    $string = "";
    $string .= "<li class='collection-item'>";
    $string .= $this->name;
    $string .= "<div class='input-field inline'>";
    $string .= "<input name='".$this->id."' type='number' class='validate preference' placeholder='Preference'>";
    $string .= "";

    return $string;
  }

}
