<?php
  include 'conf.php';
  include 'checkLogin.php';
  include 'Reduce.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ROContest</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/altstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="resurse/flag.png">
    <meta charset="utf-8">
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

  <!--<div class="row">
    <div class="card-panel col s12 m4 l3 light-blue darken-4">
      <div style = "text-align: center;">
        <p class = "flow-text">Lista concursurilor viitoare</p>
      </div>
    </div>
  </div>
-->

  <div class="row">

      <div class="col ">

      </div>
      <div class="card-panel col s12 m12 l3" style = "background-color: rgb(17, 32, 56);">
        <div style = "text-align: center; border-bottom: 1px solid rgb(83,180,247);">
          <p class = "flow-text">Concursuri viitoare</p>
        </div>
        <?php
        $picString = "ViewImage.php?id=";
        $sql = "SELECT nume, data, domeniu, poza, rate from concursuri WHERE data >= NOW() ORDER BY data ASC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $nume = $row['nume'];
          $data = $row['data'];
          $domeniu = $row['domeniu'];
          $poza = $row['poza'];
          $rate = $row['rate'];
          $picString .= $poza;
          //echo "<p style = 'margin-left: 5px;'>$nume, in $data pentru $domeniu</p><br>";
          //echo "<form action = 'Concurs.php' method = 'GET'><input type = 'submit' value = $nume name = 'concurs' style = 'border: none; background-color: transparent; color: rgb(83,180,247); font-size: 20px;'><p style = 'margin-left: 5px;'>in $data pentru $domeniu</p></form>";
          ?>
          <ul class="collection">
            <li class="collection-item avatar">
              <img src="<?php echo $picString; ?>" alt="" class="circle">
              <span class="title"><?php echo "<form action = 'Concurs.php' method = 'GET'><input type = 'submit' value = $nume name = 'concurs' style = 'border: none; background-color: transparent; color: rgb(83,180,247); font-size: 20px;'></form>"; ?></span>
              <p style = "color: black;"><?php echo $data; ?> <br>
                 <?php echo $domeniu; ?>
              </p>
              <div style = "position: absolute; right: 5px; top: 10px;">
                <?php
                for($i = 0; $i < $rate; $i++)
                  echo "<a href='#!'><i class='material-icons'>grade</i></a>";
                ?>
              </div>

            </li>
          </ul>
          <?php
          $picString = "ViewImage.php?id=";
        }
      }
      else die(mysqli_error($conn));
      ?>
      </div>
      <div class="col">

      </div>
      <div class="card-panel col s12 m12 l5 center-align" style = "background-color: rgb(17, 32, 56);"><!-- light blue lighten-1 -->
        <?php
        $sql = "select id from pictures";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result))
          {
             $lastID = $row['id'];
          }
        }

        ?>
        <ul class="collapsible" data-collapsible = "accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">add_to_photos</i>Realizeaza o postare</div>
          <div class="collapsible-body">
            <form method="POST" action="index.php" enctype="multipart/form-data" id = "content" style = "padding-top: 15px;">

             <input id="files" name = "image" style="display: none;" type="file">
             <label for="files" class="classic" style = "width: 20%;"><i class = "material-icons medium left">add_a_photo</i></label>
             <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name = "detail" class="materialize-textarea" style = "color: white;"></textarea>
          <label for="textarea1">Descriere</label>
        </div>
      </div>
             <?php
             echo "<select name = 'concursuri' class = 'input' style = 'max-width: 20%; outline: none; border: none; border-radius: 0; padding: 0; margin: 0; background-color: rgb(10, 18, 28); text-color: white;'>";
             echo "<option value='default'>Niciun concurs selectat</option>";
             $sql = "select nume from concursuri";
             $result = mysqli_query($conn, $sql);
             if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result))
               {
                  $concurs = $row['nume'];
                  echo "<option value='" . $concurs ."'>" . $concurs ."</option>";
               }
             }
             echo "</select>";
              ?>
             <br>
             <button class="btn waves-effect waves-light" type="submit" name="submit">Posteaza<i class="material-icons right">send</i></button>

            </form>
          </div>
        </li>

      </ul>
        <?php
        $picString = "ViewImage.php?id=";
        for($i = $lastID; $i > 1; $i--){
          $sql = "SELECT tip, op, concurs, descriere FROM `pictures` WHERE id = '$i'";
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
              //echo "<div class = 'post'><form action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $op name = 'profileName' style = 'border: none; background-color: transparent; color: white; font-size: 20px;'><img src = '$profilePic' class = 'roundMini circle'></input></form><p>$description</p><img src =$picString alt = '' class = 'picturePost responsive-img z-depth-4'></div><div style = 'padding-top: 15px;'></div>";
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
  <script src="js/collision.js" charset="utf-8"></script>
  </body>
</html>

<?php
if(isset($_POST['submit'])){
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
    $concurs = '';
    $concurs = $_REQUEST['concursuri'];
    $sql = "INSERT INTO pictures values(NULL, 0, '$user', '$concurs', '$descriere', '$imageData')";
    if (mysqli_query($conn, $sql)) {
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
    $concurs = '';
    $concurs = $_REQUEST['concursuri'];
    $sql = "INSERT INTO pictures values(NULL, 0, '$user', '$concurs', '$descriere', '$up')";
    if (mysqli_query($conn, $sql)) {
      echo "Picture uploaded.";
    }
    mysqli_close($conn);
    Header('Location: '.$_SERVER['PHP_SELF']);
  }
}

?>
