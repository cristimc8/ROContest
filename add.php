<?php
  include 'conf.php';
  include 'checkLogin.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sent = $_REQUEST['sentTo'];
  }
$user = $_SESSION['username'];
  $sql = "insert into news (sender, sent, text, seen) values('$user', '$sent', '$user has sent you a friend request !', 0)";
  if (mysqli_query($conn, $sql)) {
    echo ".";
    header('location: index.php');
  }
  else die(mysqli_error($conn));
?>
