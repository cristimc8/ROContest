<?php
  include 'conf.php';
  include 'checkLogin.php';

  $usr = $_SESSION['username'];
  $sql = "DELETE FROM online WHERE username = '$usr'";
  if(mysqli_query($conn, $sql)){
    echo "";
  }
  session_start();
  session_destroy();
  header('Location: login.php');
  exit;
?>
