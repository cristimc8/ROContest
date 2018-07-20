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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/altstyle.css">
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
    <div class="navbar-fixed">
      <!--<nav class = "light-blue accent-4">-->
      <nav style = "background-color: rgb(17, 32, 56);">
      <div class="nav-wrapper">
        <a href="index.php" id = "logo" class="brand-logo center"><img src="resurse/Logo.png" style = "max-width: 55px; max-height: 55px; vertical-align: middle;" alt=""></a>
        <ul id="nav-mobile" class="left">
          <li class="left hide-on-med-and-down"><a href="index.php"><i class="material-icons left">home</i>Acasa</a></li>
          <li class="left hide-on-med-and-down"><a href="adauga.php"><i class="material-icons left">av_timer</i>Concursuri</a></li>
          <li class="left hide-on-med-and-down"><a href="people.php"><i class = "material-icons left">people</i>Utilizatori</a></li>
          <li class="left hide-on-med-and-down"><a href="administrare.php"><i class = "material-icons left">notifications_active</i>Administrare</a></li>
        </ul>
        <ul id = "nav-mobile" class = "right">
          <a href="profile.php"><img class = "roundMini circle" src=<?php echo $picString; ?> alt=""></a>
        </ul>
      </div>
    </nav>
  </div>

  <div class="fixed-action-btn show-on-med-and-down hide-on-large-only">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">menu</i>
  </a>
  <ul>
    <li><a href = "index.php" class="btn-floating red"><i class="material-icons">home</i></a></li>
    <li><a href = "adauga.php" class="btn-floating yellow darken-1"><i class="material-icons">av_timer</i></a></li>
    <li><a href = "people.php" class="btn-floating green"><i class="material-icons">people</i></a></li>
    <li><a href = "administrare.php" class="btn-floating blue"><i class="material-icons">notifications_active</i></a></li>
  </ul>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
</html>
