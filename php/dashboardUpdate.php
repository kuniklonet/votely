<?php
  include("DashboardLoad.php");
  $ballots = DashboardLoad::retrieveBallots();
  echo(DashboardLoad::toDashboardMarkup($ballots));
?>
