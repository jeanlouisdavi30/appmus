<?php
ob_start(); // turns on output buffering

$timezone = date_default_timezone_set("America/Chicago");
session_start();
  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_muso");

  if(mysqli_connect_errno()){
    echo "failed to connect" . mysqli_connect_errno();
  }
?>
