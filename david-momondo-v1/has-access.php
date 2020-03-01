<?php
  session_start();
  if(  !isset($_SESSION['sEmail']) ){
    header('Location: login.php');
    exit();
  }
?>