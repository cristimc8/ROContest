<?php

include 'conf.php';
include 'checkLogin.php';
include 'Reduce.php';

if(isset($_SESSION['concurs']))
  $nume = $_SESSION['username'];
else header('location: index.php');

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $imageName = mysql_real_escape_string($_FILES["image"]["name"]);
  $imageType = mysql_real_escape_string($_FILES["image"]["type"]);

  $type   = exif_imagetype($_FILES['image']['tmp_name']);
  if($type != IMAGETYPE_JPEG){
    $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
    if(empty($imageData)){
      $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["name"]));
    }
    $user = $_SESSION['username'];
    $sql = "INSERT INTO pictures values(NULL, 1, '$user', '$nume', '', '$imageData')";
    if (mysqli_query($conn, $sql)) {
      echo "Picture uploaded.";
    }
    $sql = "select id from pictures";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      {
         $lastID = $row['id'];
      }
    }
    $usr = $_SESSION['username'];
    $sql = "UPDATE users set picID = '$lastID' WHERE username = '$usr'";
    if(mysqli_query($conn, $sql)){
      echo "Picture uploaded.";
    }
    mysqli_close($conn);
    Header('Location: profile.php');
  }
  if(substr($imageType, 0, 5) == "image"){
    $img = str_replace( " ","_",$_FILES['image']['name'] );
    move_uploaded_file( $_FILES['image']['tmp_name'], "poze/".$img);
    $source = "poze/";
    $dest = "thumb/";
    thumbnail( $img, $source, $dest, 1024, 1200 );
    $path = $_SESSION['path'];
    $up = mysql_real_escape_string(file_get_contents($path));
    $user = $_SESSION['username'];
    $descriere = $_REQUEST['detail'];
    $sql = "INSERT INTO pictures values(NULL, 1, '$user', '$nume', '', '$up')";
    if (mysqli_query($conn, $sql)) {
      echo "Picture uploaded.";
    }


    $sql = "select id from pictures";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      {
         $lastID = $row['id'];
      }
    }
    $usr = $_SESSION['username'];

    $sql = "UPDATE users set picID = '$lastID' WHERE username = '$usr'";
    if(mysqli_query($conn, $sql)){
      echo "Picture uploaded.";
    }


    mysqli_close($conn);
    Header('Location: profile.php');
  }
}

?>
