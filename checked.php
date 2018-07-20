<?php
include 'conf.php';
include 'checkLogin.php';

error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $nume = $_REQUEST['concurs'];
  $_SESSION['check'] = $nume;
  $user = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Confirmare participare</title>
    <link rel="stylesheet" href="css/style.css?version=2">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link rel="icon" href="resurse/flag.png">
  </head>
  <?php
    $id;
    $usr = $_SESSION['username'];
    $picString = 'ViewImage.php?id=';
    $sql = "SELECT picID FROM users WHERE username = '$usr'";
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
          <li><a href="index.php"><img src="resurse/Home.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;Acasa</a></li>
          <li><a href="Adauga.php"><img src="resurse/Timer.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;Concursuri</a></li>
          <li><a href="people.php"><img src="resurse/People.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;Utilizatori</a></li>
          <li><a href="administrare.php"><img src="resurse/Alarm1.png" style = "width: 25px; height: 25px; vertical-align: middle;">&nbsp;&nbsp;Administrare</a></li>
          <a href = "index.php" style = "text-align: center;" id = "logo"><img src = "resurse/Logo.png" alt = "Home" style = "max-width: 50px; max-height: 50px; vertical-align: middle;"></a>
          <div class="roundMini">
            <?php echo "<a href = profile.php><img src = $picString></a>"; ?>
          </div>
           <div style = "padding-bottom: 10px;">
           </div>
         </ul>
    	</div>
  	</div>


    <div style = "width: 60%; background-color: rgb(10, 18, 28); position: relative; box-shadow: 0px 0px 10px black; border-radius: 5px; left: 0; right: 0; margin: auto; top: 100px; text-align: center;">
      <p style = "font-size: 20px; padding-top: 10px; margin: 5px;">Felicitari pentru participarea la <?php echo $nume; ?> !</p>
      <p style = "font-size: 15px; margin: 5px;">Incurajeaza si pe altii sa participe pe viitor</p>
      <p>posteaza o fotografie cu diploma, premiul sau oamenii de acolo :)</p>
      <form action="confirmat.php" method="post" enctype="multipart/form-data" id = "content" style = "padding-bottom: 10px;">
        <input id="files" name = "image" style="display: none;" type="file">
        <label for="files" class="classic"><img src="resurse/gallery.png" alt="Image" style = "height: 35px; width: 35px; vertical-align: middle;"></label>
        <input type="text" name="detail" placeholder="Scrie o postare/descriere" class = "input" style = "height: 50px; width: 200px; border-radius: 5px; margin: 0; padding: 0; border-bottom: none;">
        <input type="submit" name="btn" value="Confirma" id = "classic" style = "border-radius: 0;">
      </form>
    </div>

  </body>
</html>
