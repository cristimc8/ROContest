<?php
  include 'conf.php';
  include 'checkLogin.php';

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $usr = $_SESSION['username'];
    $upvote = $_REQUEST['secs'];
    $id = $_REQUEST['id'];
    $sql = "INSERT INTO latest VALUES(NULL, '$usr', '$id', '$upvote')";
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    }

    $sql = "SELECT upvotes FROM pictures WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $nr = $row['upvotes'];
      }
    }
    $upvote += $nr;
    $sql = "update pictures set upvotes = $upvote where id = $id";
    if (mysqli_query($conn, $sql)) {
      header('location: ShareTime.php');
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  </body>
</html>
