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
$validation = Vote::validateVote($vote, $ballot, $userDetails);
if($validation == 1){
  Vote::makeNewVote($vote, $ballot, $userDetails);
}
echo($validation);
?>
