<?php
/**
 *
 */
class Candidate
{
	private $id;
	private $name;
	private $ballotId;
	function __construct($id, $name, $ballotId)
	{
		$this->id = $id;
		$this->name = $name;
		$this->ballotId = $ballotId;
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

	public static function makeNewCandidate($name, $ballotId){
		include('db.php');

		$query = "INSERT INTO candidates (name, ballot_id) VALUES ('".$name."', '".$ballotId."')";
		$conn->query($query);

		$lastId = $conn->insert_id;
		return new Candidate($lastId, $name, $ballotId);
	}

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getBallotId(){
		return $this->ballotId;
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
		$array = array('id' => $this->id, 'name' => $this->name, 'ballot_id' => $this->ballotId);

		return json_encode($array);
	}

}
?>
