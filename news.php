<?php
include 'conf.php';
include 'checkLogin.php';

$seen = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $other = $_REQUEST['sender'];
  $user = $_SESSION['username'];
  $frnds;
  $sql = "select friends from users where username = '$user'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $frnds = $row['friends'];
    }
  }

  $frnds .= ' ' . $_SESSION['sender'];
  $sql = "UPDATE users SET friends = '$frnds' WHERE username = '$user'";
  if (mysqli_query($conn, $sql)) {
    $seen = true;
  }

  $sql = "SELECT friends FROM users WHERE username = '$other'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $frndsother = $row['friends'];
    }
  }
  $frndsother .= ' ' . $user;

  if($seen)
  {
    $sql = "UPDATE users SET friends = '$frndsother' WHERE username = '$other'";
    if (mysqli_query($conn, $sql)) {
    //  echo '';
    }
    $sql = "DELETE FROM news WHERE sent = '$user' AND sender = '$other'";
    if(mysqli_query($conn, $sql)){
      unset($_SESSION['sender']);
      header('location: index.php');
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ShareMe - news</title>
    <link rel="stylesheet" href="css/style.css?version=3">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
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

    <div id="newsPlace">
      <?php
      $user = $_SESSION['username'];
      $sql = "select sender, text from news where sent = '$user'";
      $result = mysqli_query($conn, $sql);
      $text = "";
      $sender = "";
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $text = $row["text"];
          $sender = $row["sender"];
          $_SESSION['sender'] = $sender;
          echo "<p>$text</p>";
          echo "<form action = 'news.php' method = 'post'><input type = 'text' name = 'sender' value = '$sender' style = 'display: none;'></input><input type = 'submit' name = 'accept' class = 'butonLogin' value = 'Accept request'></input></form>";
        }
      }

      ?>
    </div>
  </body>
</html>
