<?php
  include("php/login.php");
  $Login->check_session();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Votely</title>
  </head>
  <body>
    <a href="php/logout.php">logout</a>
    </br>
    index
  </br>
  <?php
    echo $_SESSION['username'];
   ?>
  </body>
</html>
