<?php
include("Login.php");
$organisation = $_REQUEST['organisation'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if($Login->validate($username,$password,$organisation)){
  header("Location: ../index.php");
}else{
  header("Location: ../login.php?msg=err");
}

// $password = "p4s5w0rd";
// //$password = password_hash($password, PASSWORD_DEFAULT);
// //TODO SQL.....
// $password_hash = "";
// if(password_verify($password, $password_hash)){
//   //correct password
//   session_start();
//   $_SESSION["logged_in"] = TRUE;
// }else{
//   //incorrect password
// }
 ?>
