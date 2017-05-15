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
  * Logs the user in if login details are correct. Returns -1 if the login details are incorrect.
  */
  public static function validate($username, $password, $organisation){
    if(!strlen($username) || !strlen($organisation)){
      return 0;
    }
    self::start_session();
    include_once('db.php');
    // //using database
    $query = "SELECT * FROM users WHERE username = '".$username."' AND organisation = '".$organisation."'";
    $result = $conn->query($query);
    foreach($result as $row){
      $dbpass = $row['password'];
      $userId = $row['id'];
    }

    if(password_verify($password, $dbpass)){
      $_SESSION["username"] = $username;
      $_SESSION["organisation"] = $organisation;
      $_SESSION["userId"] = $userId;
      return 1;
    }else{
      return 0;
    }
  }

  /**
  * Logs the user out by destroying their session and all session variables.
  */
  public static function logout(){
    self::start_session();
    unset($_SESSION['organisation']);
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
  }

  public static function createUser($username, $password, $organisation){
    include('db.php');

    $query = "SELECT * FROM  organisations WHERE organisation_name = '".$organisation."'";
    $result = $conn->query($query);
    if(!$result){
      return 3; //organisation does not exist
    }

    $query = "SELECT * FROM  users WHERE username =  '".$useranme."' AND organisation = '".$organisation."'";
    $result = $conn->query($query);
    if(!$result){
      return 2; //username already exists within organisation
    }

    $hashedPassword = self::hashPassword($password);

    $query = "INSERT INTO users (username, password, organisation) VALUES ('".$username."', '".$hashedPassword."', '".$organisation."')";
    // $query = "INSERT INTO users (username, password, organisation) VALUES ('John', 'Doe', 'scu')";
    $result = $conn->query($query);
    if($result){
      return 1; //success
    }

    return 4; //unknown error
  }

  private static function hashPassword($password){
    $hash = password_hash($password, PASSWORD_DEFAULT);

    return $hash;
  }

}
$Login = new Login();
 ?>
