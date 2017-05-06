<?php
include('php/Login.php');
$Login->start_session();
$Login->check_session();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Votely</title>
  </head>
  <body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>


  <nav>
    <div class="nav-wrapper blue">
      <a href="#" class="brand-logo center">Votely</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Archive</a></li>
        <li><a href="php/logout.php">Logout</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Archive</a></li>
        <li><a href="php/logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">

    <ul class="collection">
      <li class="collection-item avatar">
        <i class="material-icons circle blue">grade</i>
        <span class="title">President</span>
        <p>This ballot is open for voting.</p>
        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle orange">lock</i>
        <span class="title">Vice President</span>
        <p>This ballot is not yet open.</p>
        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle green">done</i>
        <span class="title">Secretary</span>
        <p>You have successfully voted on this ballot.</p>
        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle green">done</i>
        <span class="title">Treasurer</span>
        <p>You have successfully voted on this ballot.</p>
        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
      </li>
    </ul>
  </div>



  </body>
  <script type="text/javascript">
    $( document ).ready(function(){
      $(".button-collapse").sideNav();
    })
  </script>
</html>
