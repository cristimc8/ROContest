<?php
  include 'conf.php';
  include 'checkLogin.php';
  include 'Reduce.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ShareMe</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <?php
    $id;
    $usr = $_SESSION['username'];
    $picString = 'ViewImage.php?id=';
    $sql = "SELECT picID FROM Users WHERE username = '$usr'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['picID'];
      }
    }
    $picString .= $id;
  ?>
  <body>
    <div id = "header">
    	<div style = "height: 60px;">
      	<ul style = "height: 60px;">
          <div style = "padding-top: 20px;"></div>
          <li><a href="index.php"><img src="resurse/Home.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;Home</a></li>
          <li><a href="ShareTime.php"><img src="resurse/Timer.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;ShareTime</a></li>
          <li><a href="people.php"><img src="resurse/People.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;People</a></li>
          <li><a href = "news.php"><img src="resurse/Alarm1.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;News</a></li>
          <a href = "index.php" style = "text-align: center;" id = "logo"><img src = "resurse/Logo.png" alt = "Home" style = "max-width: 50px; max-height: 50px; vertical-align: middle;"></a>
          <div class="roundMini">
            <?php echo "<a href = profile.php><img src = $picString></a>"; ?>
          </div>
           <div style = "padding-bottom: 10px;">
           </div>
         </ul>
    	</div>
  	</div>
    <div style = "padding-top: 60px;">
    </div>
  <div class="freespace">
  </div>
    <form method="POST" action="changePic.php" enctype="multipart/form-data">
     <input type="file" name="image">
     <input type="text" name="detail" placeholder="Descriere" class = "bu" style = "border-radius: 0;">
     <input type="submit" name="submit" value="Upload" class = "butonLogin">
    </form>
  </body>
</html>

<?php
if(isset($_POST['submit'])){
  $detail = $_REQUEST['detail'];
  $user = $_SESSION['username'];

  $imageName = mysql_real_escape_string($_FILES["image"]["name"]);
  $imageType = mysql_real_escape_string($_FILES["image"]["type"]);

  $type   = exif_imagetype($_FILES['image']['tmp_name']);
  if($type != IMAGETYPE_JPEG){
    $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
    if(empty($imageData)){
      $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["name"]));
    }
    $descriere = $_REQUEST['detail'];
    $user = $_SESSION['username'];
    $sql = "INSERT INTO pictures values(NULL, 1, '$user', '', '$descriere', '$imageData')";
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
    $sql = "UPDATE Users SET picID = $lastID WHERE username = '$usr'";
    if(mysqli_query($conn, $sql)){
      echo "Picture uploaded.";
    }
    mysqli_close($conn);
    Header('Location: '.$_SERVER['PHP_SELF']);
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
    $sql = "INSERT INTO pictures values(NULL, 1, '$user', '', '$descriere', '$up')";
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
    $sql = "UPDATE Users SET picID = $lastID WHERE username = '$usr'";
    if(mysqli_query($conn, $sql)){
      echo "Picture uploaded.";
    }
    mysqli_close($conn);
    Header("location: profile.php");
  }
}
?>
