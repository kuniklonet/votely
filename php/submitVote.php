<?php
session_start();
include("Ballot.php");
include("Vote.php");

$data = $_REQUEST['data'];
$vote = $data['preferences'];
$ballot = Ballot::makeExistingBallot($data["ballotId"]);
$userDetails = array(
  'username' => $_SESSION['username'],
  'organisation' => $_SESSION['organisation'],
  'userId' => $_SESSION['userId']
);
if(Vote::validateVote($vote, $ballot, $userDetails)){
  Vote::makeNewVote($vote, $ballot, $userDetails);
  echo(1); //success
}else{
  echo(0); //invalid votes
}
?>
