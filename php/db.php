<?php
// remote
// $server = "infs3202-zz7ap.zones.eait.uq.edu.au";
// local
$server = "localhost";
$user = "root";
$password = "kesekivanafo";
$dbname = "votely";
//localhost
$conn = mysqli_connect($server, $user, $password, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 ?>
