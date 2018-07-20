<?php
  include 'conf.php';
  include 'checkLogin.php';

  if($_SERVER['REQUEST_METHOD'] == "GET"){
    $profileName = $_REQUEST['profileName'];
    $sql = "SELECT id FROM users WHERE username = '$profileName'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $idC = $row['id'];
      }
    }
    else header("location: index.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ROContest - <?php echo $profileName; ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/altstyle.css">
    <link rel="icon" href="resurse/flag.png">
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



    $copertaConcurs = 'ViewImage.php?id=';
    $pozaconcurs = 'ViewImage.php?id=';
    $sql = "SELECT picID, coperta from users where id = '$idC'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $backup = $row['picID'];
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

 <div style = "padding-top: 10px;"></div>
    <div style = 'width: 100%; background-color: rgb(10, 18, 28); height: 250px; border-radius: 5px; top: 50px; text-align: center;'>
      <div style = "width: 600px; height: 100%; background-color: rgb(10, 18, 28); position: relative; padding-bottom: 0;  border-radius: 5px; left: 0; right: 0; margin: auto;">
        <img src="<?php echo $copertaConcurs; ?> alt = ''" style="width: 100%; height: 100%; border-radius: 5px;">
      </div>
      <div class="roundMini circle" style = 'width: 200px; height: 200px; position: relative; top: -90px; left: 0; right: 0; margin: auto; border: 3px solid rgb(83, 180, 247); margin-top: 0; padding-top: 0;'>
        <?php echo "<img src = $pozaconcurs class = 'roundMini circle'>" ?>
      </div>
      <p style = "position: relative; top: -65px; left: 0; right: 0; margin: auto; font-size: 18px;"><?php echo $profileName; ?></p>
    </div>

    <div style = "position: absolute; left: 10px; width: 320px; margin-top: 10px; background-color: rgb(14, 23, 35); border-radius: 0; box-shadow: 0px 0px 10px black; text-align: left;">
      <div style = "text-align: center;">
        <p style = "font-size: 20px;">Date personale</p>
      </div>
      <?php
        $sql = "SELECT nume, prenume, email, tip from users where id = '$idC'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            $nume = $row['nume'];
            $prenume = $row['prenume'];
            $email = $row['email'];
            $tip = $row['tip'];
          }
        }
        if($tip == 0) $tip = "Elev";
        if($tip == 1) $tip = "Profesor";
        if($tip == 2) $tip = "Angajator";
      ?>
      <p style = "margin-left: 10px;">Nume complet: <?php echo "$nume $prenume"; ?></p>
      <p style = "margin-left: 10px;">Email: <?php echo "$email"; ?></p>
      <p style = "margin-left: 10px; margin-bottom: 30px;">Tip cont: <?php echo $tip; ?></p>
    </div>

    <div style = "position: absolute; right: 10px; width: 320px; max-height: 150px; margin-top: 10px; background-color: rgb(14, 23, 35); border-radius: 0; box-shadow: 0px 0px 10px black; text-align: left;">
      <div style = "text-align: center;">
        <p style = "font-size: 20px;">Participari</p>
      </div>
      <?php
      $sql = "SELECT contests FROM users WHERE id = '$idC'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $concursuri = explode(" ", $row['contests']);
        }
      }
      for($i = 0; $i < 2; $i++){
        if(isset($concursuri[$i]) && $concursuri[$i] != 'Array'){
          $nm = $concursuri[$i];
          echo "<p style = 'font-size: 14; margin-left: 10px;'>$nm</p>";
        }
      }
      ?>
    </div>

    <div class="freespace">
    </div><div style = "padding-bottom: 220px;"></div>

    <div class="row">

    <div class="card-panel col s12 m12 l6 offset-l3" style = "background-color: rgb(17, 32, 56); text-align: center;">
      <?php
      $usr = $profileName;
      $sql = "select id from pictures";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
           $lastID = $row['id'];
        }
      }

      $picString = "ViewImage.php?id=";
      for($i = $lastID; $i >= 1; $i--){
        $sql = "SELECT tip, op, concurs, descriere FROM `pictures` WHERE id = '$i' AND op = '$profileName'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            $op = $row['op'];
            $description = $row['descriere'];
            $tip = $row['tip'];
            $concurs = $row['concurs'];
          }
        }
        if(isset($op) && $tip == 0){
          $profilePic = "";

          $sql = "SELECT picID FROM Users WHERE username = '$op'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              $profilePic = "ViewImage.php?id=" . $row['picID'];
            }
          }
          $picString .= $i;
          if(isset($concurs) && $concurs != 'default')
            echo "<div class = 'post' style = 'text-align: center;'><form action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $op name = 'profileName' style = 'border: none; background-color: transparent; color: white; font-size: 20px;'><img src = '$profilePic' class = 'roundMini circle'></input></form><div class = 'card' style = 'max-width: 80%;'><div class = card-image><img src = '$picString' alt = ' ' class = 'z-depth-2'><span class = 'card-title'>in $concurs</span></div><div class = 'card-content' style = 'text-align: left;'><p style = 'color: black;'>$description</p></div></div></div>";
          else{
            echo "<div class = 'post'><form action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $op name = 'profileName' style = 'border: none; background-color: transparent; color: white; font-size: 20px;'><img src = '$profilePic' class = 'roundMini circle'></input></form><div class = 'card' style = 'max-width: 80%;'><div class = card-image><img src = '$picString' alt = ' ' class = 'z-depth-2'></div><div class = 'card-content' style = 'text-align: left;'><p style = 'color: black;'>$description</p></div></div></div>";
          }
          $picString = "ViewImage.php?id=";
          unset($op);
          unset($concurs);
        }
      }
      ?>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
</html>
