<?php
/**
 *
 */
class Ballot
{
	private $id;
	private $name = "";
	private $description = "";
	private $organisation = "";
	private $state = "";
	private $candidates = array();
	// private $votes = array(); //array of vote objects relating to this ballot.

	function __construct($id, $name, $description)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
	}

	public static function makeExistingBallot($id){
		require('db.php');

		$query = "SELECT * FROM ballots WHERE id = '".$id."'";
		$result = $conn->query($query);
		if(mysqli_num_rows($result)<1){
			return 0;
		}else{
			$ballot = new Ballot;
			$ballot->setId($id);
			$ballot->refreshDetails();
			return $ballot;
		}
	}

	public function refreshDetails(){
		include('db.php');
		$query = "SELECT * FROM ballots WHERE id = '".$this->id."'";
		$result = $conn->query($query);
		while($row = mysqli_fetch_array($result)){
			$this->setName($row['name']);
			$this->setDescription($row['description']);
			$this->setOrganisation($row['organisation']);
			$this->setState($row['state']);

			$candidates = $this->retrieveCandidates();
			foreach ($candidates as $candidate) {
			$this->addCandidate($candidate);
			}
		}
	}

	/*
	* Returns a new Ballot object that contains its id in the database.
	*/
	public static function makeNewBallot(){
		include_once('db.php');

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
	private function retrieveCandidates(){
		include("db.php");
		include_once("Candidate.php");
		$candidates = array();
		$query = "SELECT * FROM candidates WHERE ballot_id = '".$this->id."'";
		$result = $conn->query($query);
		while($row = mysqli_fetch_array($result)){
			$candidate = Candidate::makeExistingCandidate($row['id']);
			array_push($candidates, $candidate);
		}
		return $candidates;
	}

	public function commit(){
		include_once('db.php');
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

	public function toJSON(){
		$array = array('id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'organisation' => $this->organisation, 'state' => $this->state);

		return json_encode($array);
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

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getOrganisation(){
		return $this->organisation;
	}

	public function setOrganisation($organisation){
		$this->organisation = $organisation;
	}

	public function getCandidates(){
		return $this->candidates;
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
