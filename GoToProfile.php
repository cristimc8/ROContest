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
    <link rel="stylesheet" href="css/style.css?version=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
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

    <div class="freespace"></div> <div style = "padding-top: 10px;"></div>
    <div style = 'width: 100%; background-color: rgb(10, 18, 28); height: 250px; border-radius: 5px; top: 50px; text-align: center;'>
      <div style = "width: 600px; height: 100%; background-color: rgb(10, 18, 28); position: relative; padding-bottom: 0;  border-radius: 5px; left: 0; right: 0; margin: auto;">
        <img src="<?php echo $copertaConcurs; ?> alt = ''" style="width: 100%; height: 100%; border-radius: 5px;">
      </div>
      <div class="roundMini" style = 'width: 200px; height: 200px; position: relative; top: -90px; left: 0; right: 0; margin: auto; border: 3px solid rgb(83, 180, 247); margin-top: 0; padding-top: 0;'>
        <?php echo "<img src = $pozaconcurs>" ?>
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
    </div><div style = "padding-bottom: 150px;"></div>


    <div class="newsfeed">
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
            echo "<div class = 'post'><form action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $op name = 'profileName' style = 'border: none; background-color: transparent; color: rgb(83,180,247); font-size: 20px;'><img src = '$profilePic' class = 'roundMini2'><p> in $concurs</p></input></form><p>$description</p><img src =$picString alt = '' class = 'picturePost'></div><div style = 'padding-top: 15px;'></div>";
          else
            echo "<div class = 'post'><form action = 'GoToProfile.php' method = 'get'><input type = 'submit' value = $op name = 'profileName' style = 'border: none; background-color: transparent; color: rgb(83,180,247); font-size: 20px;'><img src = '$profilePic' class = 'roundMini2'></input></form><p>$description</p><img src =$picString alt = '' class = 'picturePost'></div><div style = 'padding-top: 15px;'></div>";
          $picString = "ViewImage.php?id=";
          unset($op);
          unset($concurs);
        }
      }
      ?>
    </div>
  </body>
</html>
