<?php
session_start();
include("../php/Login.php");
$status = Login::createUser($_POST["username"], $_POST["password"], $_SESSION['organisation']);
header("Location: ../admin.php?msg=".$status);