<?php
include("Ballot.php");
$data = $_REQUEST['data'];
$vote = $data['vote'];
$ballot = Ballot::makeExistingBallot($data["ballot_id"]);
$userDetails = array('username' => $_SESSION['username'], 'organisation' => $_SESSION['organisation']);
$vote = array();
if(Vote::validateVote($vote, $ballot, $userDetails)){
  Vote::makeNewVote($vote);
  echo(1); //success
}else{
  echo(2); //invalid votes
  //return????
}
?>
