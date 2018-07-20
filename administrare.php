<?php
include 'conf.php';
include 'checkLogin.php';
 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>Administrare concurs</title>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link rel="stylesheet" href="css/materialize.css">
     <link rel="stylesheet" href="css/altstyle.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

    <div style = "overflow: auto; position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; text-align: center; background-color: rgb(14, 23, 35); box-shadow: 0px 0px 10px black; border-radius: 0; width: 420px; height: 500px;">
      <p style = "font-size: 20px;  padding-top: 10px;">Ce concurs vrei sa administrezi ?</p>
      <div style = "width: 90%; background-color: rgb(10, 18, 28); border-radius: 5px; text-align: center; position: relative; left: 0; right: 0; margin: auto;">
        <?php
        $usr = $_SESSION['username'];
        $sql = "SELECT nume FROM concursuri WHERE owner = '$usr'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result))
          {
              $nm = $row['nume'];
              echo "<form action = 'modifica.php' method = 'get'><input type = 'submit' value = $nm name = 'concurs' style = 'border: none; background-color: transparent; color: white; font-size: 13px; margin-bottom: -8px;'></form><br>";
          }
        }
        ?>

      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
   </body>
 </html>
