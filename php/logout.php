<?php
include("Login.php");
$Login->logout();
header("Location: ../login.php?msg=loggedout");
 ?>
