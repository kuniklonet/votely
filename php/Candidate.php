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

  public static function makeExistingCandidate($id){
    include('db.php');

    $query = "SELECT * FROM candidates WHERE id = '".$id."'";

    $result = $conn->query($query);
    if(mysqli_num_rows($result)<1){
      return 0;
    }else{
      $row = mysqli_fetch_assoc($result);
      $candidate = new Candidate($id, $row['name'], $row['ballot_id']);
      return $candidate;
    }
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

  public function toJSON(){
    $array = array('id' => $this->id, 'name' => $this->name, 'ballot_id' => $this->ballot_id);

    return json_encode($array);
  }

}
?>
