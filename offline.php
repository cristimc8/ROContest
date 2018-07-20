<?php
  include 'conf.php';
  include 'checkLogin.php';

  $username = $_SESSION['username'];
  $sql = "DELETE FROM online WHERE username = '$username'";
  if (mysqli_query($conn, $sql)) {
    echo ".";
  }
?>
