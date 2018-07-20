<?php
  include 'conf.php';
  include 'checkLogin.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ROContest - Utilizatori</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/altstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

    <div class="" style = "text-align: center; max-height: 360px; overflow: auto;">
      <p style = "font-size: 25px;">Lista tuturor utilizatorilor inscrisi pe ROContest</p>
    </div>

    <form class="" action="GoToProfile.php" method="get" style="text-align: center;">
      <input type="text" name="profileName" placeholder="Cauta un profil" class = "input" style = "max-width: 200px; margin: 10px;">
      <button class="btn waves-effect waves-light" type="submit" name="submit">Cauta<i class="material-icons right">search</i></button>
    </form>

    <div class="row">

    <div class="col s12 m12 l6 offset-l3 card-panel" style="text-align: center; background-color: rgb(17, 32, 56);">
      <?php
        $sql = "SELECT id from Users";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result))
          {
             $id = $row['id'];
          }
        }

        for($i = 1; $i <= $id; $i++){
          $sql = "SELECT username FROM Users WHERE id = '$i'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              $usr = $row['username'];
            }
            echo "<form style = 'padding-bottom: 20px;' action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $usr name = 'profileName' style = 'border: none; background-color: transparent; color: rgb(83,180,247); font-size: 20px;'></input></form>";
          }
        }
      ?>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
</html>
