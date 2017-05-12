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
 ?>
