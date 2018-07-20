<?php
  include 'conf.php';
  include 'checkLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ROContest - adauga concurs</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/altstyle.css">
    <link rel="stylesheet" href="css/slideshow.css">
    <link rel="icon" href="resurse/flag.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
  <body style = "background: none; background-color: rgb(11, 17, 25);">
    <div class="navbar-fixed">
      <!--<nav class = "light-blue accent-4">-->
      <nav style = "background-color: rgb(17, 32, 56);">
      <div class="nav-wrapper">
        <a href="index.php" id = "logo" class="brand-logo center"><img src="resurse/Logo.png" style = "max-width: 55px; max-height: 55px; vertical-align: middle;" alt=""></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
          <li><a href="index.php"><i class="material-icons left">home</i>Acasa</a></li>
          <li><a href="adauga.php"><i class="material-icons left">av_timer</i>Concursuri</a></li>
          <li><a href="people.php"><i class = "material-icons left">people</i>Utilizatori</a></li>
          <li><a href="administrare.php"><i class = "material-icons left">notifications_active</i>Administrare</a></li>
        </ul>
        <ul id = "nav-mobile" class = "right">
          <a href="profile.php"><img class = "roundMini circle" src=<?php echo $picString; ?> alt=""></a>
        </ul>
      </div>
    </nav>
  </div>
    <!-- INCEPE SLIDESHOW BACKGROUND -->

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

    <ul class="cb-slideshow">
    	<li>
    		<span>Image 01</span>
    	</li>
    	<li><span>Image 02</span></li>
    	<li><span>Image 03</span></li>
      <li><span>Image 04</span></li>
    </ul>
    <?php if(isset($_SESSION['done'])){
      unset($_SESSION['done']);
      ?>
    <p style = "color: rgb(51, 232, 23); font-size: 24px; position: relative; top: 120px; left: 40%;">Concursul a fost adaugat!</p>
  <?php } ?>

  <div class="row">

    <div class = "col s12 m12 l5">

      <div style = "width: 90%; background-color: rgb(10, 18, 28); border-radius: 5px; text-align: center; position: relative; left: 0; right: 0; margin: auto;">
        <div class="nav-wrapper">
          <form action = "Concurs.php" method = "get">
            <div class="input-field" style = "background-color: ">
              <input id="search" name = "concurs" type="search" required placeholder="Cauta un concurs" style = "color: #8c8888">
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
              <button class="btn waves-effect waves-light" type="submit" name="submit">Cauta</button>
            </div>
          </form>
        </div>
        <div style = "border-bottom: 1px solid rgb(83,180,247);">
          <p class = "flow-text">Concursuri inregistrate</p>
        </div>
      <?php
      $sql = "select nume from concursuri";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $nm = $row['nume'];
          echo "<form action = 'Concurs.php' method = 'get'><input type = 'submit' value = $nm name = 'concurs' style = 'border: none; background-color: transparent; color: white; font-size: 13px; margin-bottom: -8px;'></form><br>";
        }
      }
      ?>
      </div>
    </div>

    <div class = "col s12 m12 l6">
      <div>
        <div style = "text-align: center; background-color: rgb(14, 23, 35); width: 80%; position: relative; left: 0; right: 0; margin: auto;">
          <p style = "font-size: 20px; margin-bottom: 0;">Este usor sa iti adaugi concursul</p>
          <p style = "font-size: 15px; margin-bottom: 20px;">Si celorlalti mai usor sa il gaseasca</p>
          <p>Avem nevoie doar de cateva informatii pentru a incepe</p>
          <form action="" method="post">
            <input type="text" name="nume" placeholder="Numele concursului" class = "input" style = "width: 45%;">
            <input type="text" name="locatia" placeholder="Locatia concursului" class = "input" style = "width: 45%;">
            <input type="text" name="telefon" placeholder="Numar telefon organizator" class = "input" style = "width: 45%; margin-top: 5px;">
            <input type="text" name="email" placeholder="Email organizator" class = "input" style = "width: 45%; margin-top: 5px;">
            <input type="date" name = "data" placeholder="Data concursului" style = 'color: rgb(209, 209, 209);'>
            <?php
            echo "<select name = 'domeniu' style = 'width: 45%; margin-top: 5px;'>";
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
            <div class="input-field col s12">
              <textarea id="textarea1" name = "descriere" class="materialize-textarea" style = "color: white;"></textarea>
              <label for="textarea1">Descriere</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit" style = "margin-bottom: 10px;">Adauga concurs<i class="material-icons left">add_box</i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/materialize.js"></script>
  <script src="js/collision.js" charset="utf-8"></script>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $nume = $_REQUEST['nume'];
  $nume = str_replace(' ', '-', $nume);
  $locatia = $_REQUEST['locatia'];
  $telefon = $_REQUEST['telefon'];
  $email = $_REQUEST['email'];
  $data = $_REQUEST['data'];
  $domeniu = $_REQUEST['domeniu'];
  $descriere = $_REQUEST['descriere'];
  $exista = false;
  $sql = "SELECT nume from concursuri where nume = '$nume'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
      $exista = true;
    }

  if(str_replace(' ', '', $nume) == '' || str_replace(' ', '', $locatia) == '' || str_replace(' ', '', $telefon) == '' || str_replace(' ', '', $email) == '' || str_replace(' ', '', $descriere) == '')
  {
    $exista = true;
    echo "<script>alert('Toate campurile sunt obligatorii !');</script>";
    echo "<script>location.replace('Adauga.php'); </script>";
  }

  if(!$exista){
  $sql = "INSERT into concursuri values(NULL, '$nume', '$data', '$locatia', '', '$telefon', '$email', '$domeniu', 1, 0, '', '$descriere', '$usr', 1)";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['done'] = true;
    echo "<script>location.replace('Adauga.php'); </script>";
  }
  else die(mysqli_error($conn));
  }
  else echo "<script>alert('Un concurs cu acest nume exista deja!');   </script>";
}
?>
