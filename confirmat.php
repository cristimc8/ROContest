<?php
include 'conf.php';
include 'checkLogin.php';
include 'Reduce.php';

$user = $_SESSION['username'];


$nume = $_SESSION['check'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $detal = $_REQUEST['detail'];
  $sql = "select contests from users where username = '$user'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $concursuri = explode(" ", $row['contests']);
    }
  }
  $baga = true;
  foreach ($concursuri as $v) {
    if($v == $nume) $baga = false;
  }
  if($baga)
  $concursuri .= ' ' . $nume;

  $sql = "SELECT participanti from concursuri where nume = '$nume'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $part = $row['participanti'];
    }
  }
  $part++;
  $sql = "UPDATE concursuri set participanti = '$part' where nume = '$nume'";
  if (mysqli_query($conn, $sql)) {
    echo "Picture uploaded.";
  }

  $sql = "UPDATE users set contests = '$concursuri' where username = '$user'";
  if (mysqli_query($conn, $sql)) {
    echo "Picture uploaded.";
  }

  $imageName = mysql_real_escape_string($_FILES["image"]["name"]);
  $imageType = mysql_real_escape_string($_FILES["image"]["type"]);

  $type   = exif_imagetype($_FILES['image']['tmp_name']);
  if($type != IMAGETYPE_JPEG){
    $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
    if(empty($imageData)){
      $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["name"]));
    }
    $user = $_SESSION['username'];
    $sql = "INSERT INTO pictures values(NULL, 0, '$user', '$nume', '$detal', '$imageData')";
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
    mysqli_close($conn);
    Header('Location: Adauga.php');
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
    $sql = "INSERT INTO pictures values(NULL, 0, '$user', '$nume', '$detal', '$up')";
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



    mysqli_close($conn);
    Header('Location: Adauga.php');
  }
}
?>
