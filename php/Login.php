<?php
/**
 * Handles sessions
 */
class Login
{

  /**
  * Start a php session
  */
  public static function start_session(){
    if (!isset($_SESSION)){
      session_start();
    }
  }

  /**
  * Redirects the user to the login page if they are not currently logged in.
  */
  public static function check_session(){
    self::start_session();
    if (!isset($_SESSION["username"])){
      header("Location: ../login.php");
    }
  }

  /**
  * Logs the user in if. Returns -1 if the login details are incorrect.
  */
  public static function validate($username, $password, $organisation){
    self::start_session();
    if($username == "mark" && $password == "pass"){
      $_SESSION["username"] = $username;
      $_SESSION["organisation"] = $organisation;
      return 1;
    }else{
      return 0;
    }
  }

  public static function logout(){
    self::start_session();
    unset($_SESSION['organisation']);
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
  }

}
$Login = new Login();
 ?>
