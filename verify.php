<?php
  include 'conf.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password = md5($password);
}


$sql = "select parola from users where username = '$username'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result))
  {
    if(trim($username) != '')
      $realPass = $row["parola"];
    else {$_SESSION['wrongCredentials'] = true; header('location: login.php');}
  }
}
else {
  $_SESSION['wrongCredentials'] = true;
  header('location: login.php');
}
$transmit = true;
if(isset($realPass)){
  if($realPass == $password){
    $_SESSION['username'] = $username;
    $sql = "select id from online where username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
      $transmit = false;
    }
    if($transmit){
      $sql = "insert into online values(NULL, '$username')";
      if (mysqli_query($conn, $sql)) {
        echo ".";
      }
  }
    header('location: index.php');
  }
  else {
    $_SESSION['wrongCredentials'] = true;
    header('location: login.php');
  }
}
?>
