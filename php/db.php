<?php
// remote
// $server = "infs3202-zz7ap.zones.eait.uq.edu.au";
// local
$dbserver = "localhost";
$dbuser = "root";
$dbpassword = "kesekivanafo";
$dbname = "votely";
//localhost
$conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 ?>
