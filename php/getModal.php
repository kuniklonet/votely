<?php
  include("DashboardLoad.php");
  $id = $_REQUEST['id'];
  echo(DashboardLoad::toModalMarkup($id));
  // echo "jelly";
?>
