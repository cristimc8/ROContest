<?php
include 'conf.php';
include 'checkLogin.php';

if(isset($_GET['id'])){
  $id = mysql_real_escape_string($_GET['id']);
  $sql = "SELECT image from pictures where id = '$id'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $imageData2 = $row['image'];
    }
    header("content-type: image/jpeg");
    echo $imageData2;
  }
  mysqli_close($conn);
}

?>
