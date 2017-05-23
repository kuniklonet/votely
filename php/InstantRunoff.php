<?php

/**
 * User: Mark
 * Date: 22/05/2017
 * Time: 10:20 PM
 */
class InstantRunoff
{
	private $ballot;
	private $count = array();
	private $disqualified = array();
	private $candidates = array();

	function __construct($ballot)
	{
		$this->ballot == $ballot;
		$this->retrieveCurrentPreferences();
		$this->candidates = $this->ballot->getCandidates()->getId();
	}

	/**
	 * @return The winning Candidate
	 */
	public function getWinningCandidate(){
		include("Candidate.php");
		$id = $this->determineWinner();
		return Candidate::makeExistingCandidate($id);
	}

	/**
	 * Return the winning candidate's id
	 */
	private function determineWinner(){
		$size = sizeof($this->ballot->getCandidates());
		$max = array_keys($this->count, max($this->count)); //find the candidate with the most votes
		if ($this->count[$max]>$size/2 ){ //check if they have a majority
			return $max;
		}
		if(sizeof($this->disqualified) + 1 == sizeof($this->candidates)){ //check if there is only one candidate left
			return array_diff($this->candidates, $this->disqualified)[0];
		}

		$min = array_keys($this->count, min($this->count)); //find the candidate with the least votes
		array_push($this->disqualified, $min); //remove them from the running
		$this->incrementCurrentPreference($min); //move their votes to voter's next preference if available
		return $this->determineWinner(); //recount using the new preferences
	}

	private function retrieveCurrentPreferences()
	{
		$this->count = array();
		$candidates = $this->ballot->getCandidates()->getId();
		foreach ($candidates as $candidate) {
			$this->count[$candidate] = 0;
		}

		$votes = $this->ballot->getVotes();
		foreach($votes as $vote){
			$this->count[$vote->getCurrentPreference()] ++;
		}
	}


	private function incrementCurrentPreference($candidate){
		$votes = $this->ballot->getVotes();
		foreach ($votes as $vote){
			if($vote->getCurrentPreference() == $candidate){
				$candidate->incrementCurrentPreference($this->disqualified);
			}
		}
	}

	/**
	 * Returns a If a candidate holds the majority of votes, an associative array with the
	 * keys "majority" and "candidate". If a candidate holds the majority of votes, "majority"
	 * will be true, and "candidate" will be the id of the candidate with the majority of votes.
	 * If no candidate holds the majority of votes, "majority will be set to false and "candidate"
	 * will be the id of the candidate with the least votes.
	 * @return array
	 */
	public function majorityExists(){
		$size = sizeof($this->ballot->getCandidates());
		$max = array_keys($this->count, max($this->count));
		if ($this->count[$max]>$size/2){
			return array("majority" => true, "candidate" => $max);
		}
		$min = array_keys($this->count, min($this->count));
		array_push($this->disqualified, $min);
		return array("majority" => false, "candidate" => $min);
	}


}