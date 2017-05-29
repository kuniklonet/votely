<?php
//var_dump($_POST);
session_start();
include("../php/Login.php");
include("../php/Ballot.php");
include("../php/Candidate.php");
$ballot = Ballot::makeNewBallot($_SESSION['organisation']);
$ballot->setName($_POST['name']);
$ballot->setDescription($_POST['description']);
$ballot->setOrganisation($_SESSION['organisation']);
$candidates = $_POST['candidate'];
foreach ($candidates as $textCandidate){
	$candidate = Candidate::makeNewCandidate($textCandidate, $ballot->getId());
	$ballot->addCandidate($candidate);
}
$ballot->commit();
header("location:/?msg=ballotsuccess");
