<?php
include 'conf.php';
include 'checkLogin.php';
include 'Reduce.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
  $nume = $_REQUEST['concurs'];
  $nume1 = str_replace('-', ' ', $nume);

}
$_SESSION['concurs'] = $nume;
$usr = $_SESSION['username'];
$sql = "SELECT owner, id from concursuri where nume = '$nume'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result))
  {
    $idC = $row['id'];
    if($row['owner'] != strtolower($usr))
    {
      echo "<script>alert('Nu detii acest concurs pentru a-l putea modifica !');</script>";
      header("location: index.php");
    }
  }
}
else {
  echo "<script>alert('Concursul nu exista !');</script>";
  header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Administreaza <?php echo $nume1; ?></title>
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

    $copertaConcurs = 'ViewImage.php?id=';
    $pozaconcurs = 'ViewImage.php?id=';
    $sql = "SELECT poza, coperta from concursuri where id = '$idC'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $backup = $row['poza'];
        $backupCoperta = $row['coperta'];
      }
    }
    else die(mysqli_error($conn));
    $pozaconcurs .= $backup;
    $copertaConcurs .= $backupCoperta;
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

    <form action="coperta.php" method="POST" enctype="multipart/form-data" id = "content">
      <input id="files" name = "image" style="display: none;" type="file">
      <div style = 'width: 100%; background-color: rgb(10, 18, 28); height: 250px; border-radius: 5px; top: 50px; text-align: center;'>
        <div id = 'link' style = "width: 600px; height: 100%; background-color: rgb(10, 18, 28); position: relative; padding-bottom: 0;  border-radius: 5px; left: 0; right: 0; margin: auto;">
          <label for="files"><img src="<?php echo $copertaConcurs; ?>" style="width: 100%; height: 100%; border-radius: 5px;"></label>
        </div>
        <input type="submit" name="submit" value="Salveaza coperta" id = "classic" style="border-radius: 0; position: absolute; right: 5px; top: 285px;">
    </form>
    <form method="POST" action="pic.php" enctype="multipart/form-data" id = "content">
        <input id="files1" name = "image" style="display: none;" type="file">
        <div class="roundMini circle" style = 'width: 200px; height: 200px; position: relative; top: -90px; left: 0; right: 0; margin: auto; margin-top: 0; padding-top: 0;' id = 'link'>
          <label for="files1"><img src=<?php echo $pozaconcurs; ?> class = "roundMini circle"></label>
        </div>
        <p style = "position: relative; top: -65px; left: 0; right: 0; margin: auto; font-size: 18px;"><?php echo $nume1; ?></p>
        <input type="submit" name="submit" value="Salveaza poza" id = "classic" style=" border-radius: 0;">
      </div>
    </form>


    <div style = "position: absolute; top: 580px; right: 0; left: 0; margin: auto; margin-bottom: 10px; text-align: center; background-color: rgb(14, 23, 35); box-shadow: 0px 0px 10px black; border-radius: 0; width: 420px; height: 560px;">
      <p style = "font-size: 20px; margin-bottom: 0; padding-top: 10px;">Modifica datele concursului</p>
      <p style = "font-size: 15px; margin-bottom: 20px;">Toate campurile sunt obligatorii</p>
      <div style = "width: 100%; text-align: center;">
        <form action="date.php" method="post">
          <input type="text" name="nume" placeholder="Numele concursului" class = "input" style = "width: 45%;">
          <input type="text" name="locatia" placeholder="Locatia concursului" class = "input" style = "width: 45%;">
          <input type="text" name="telefon" placeholder="Numar telefon organizator" class = "input" style = "width: 45%; margin-top: 5px;">
          <input type="text" name="email" placeholder="Email organizator" class = "input" style = "width: 45%; margin-top: 5px;">
          <input type="date" name="data" class = "input" style = "width: 45%; margin-top: 5px;" placeholder="Data concursului">
          <?php
          echo "<select name = 'domeniu' class = 'input' style = 'width: 45%; margin-top: 5px;'>";
          $sql = "SELECT nume FROM domenii";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              $dom = $row['nume'];
              echo "<option value='" . $dom ."'>" . $dom ."</option>";
            }
          }
          echo "</select>";
          ?>
          <textarea name="descriere" rows="8" cols="70" class = "input" style = "width: 70%; margin-top: 5px;" placeholder="Ofera o descriere a concursului, sau specifica alte detalii"></textarea>
          <input type="submit" name="verifica" value="Modifica concurs" id = "classic" style = "margin-top: 5px;">
        </form>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
</html>
