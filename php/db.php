<?php
// server = "infs3202-zz7ap.zones.eait.uq.edu.au";
$dbserver = "localhost";
$dbuser = "votelyapp";
$dbpassword = "Dx43MKgl4uGOsFX1";
$dbname = "votely";
//localhost
$conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
