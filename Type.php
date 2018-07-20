<?php
include 'conf.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link rel="icon" href="resurse/flag.png">
    <title>ROContest</title>
  </head>
  <body style = "background-color: rgb(11, 17, 25);">
    <div id = "center">
      <p style = " font-size: 35px; position: relative; top: 100px;">Si inca ceva</p>
      <p style = " font-size: 30px; position: relative; top: 100px;">Ce fel de cont doresti ?</p>
      <form action = "" method="POST" style = "position: relative; top: 100px;">
        <input type="submit" name="btn" id = "Elev" value="Elev" class = "but" style = "margin-bottom: 25px;"><br>
        <input type="submit" name="btn" id = "Profesor" value="Profesor" class = "but" style = "margin-bottom: 25px;"><br>
        <input type="submit" name="btn" id = "Angajator" value="Angajator" class = "but" style = "margin-bottom: 25px;">
      </form>
    </div>
  </body>
</html>

<?php
if(!isset($_SESSION['temp-username'])) header('location: register.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $usr = $_SESSION['temp-username'];
  $nr = -1;
  switch ($_POST['btn']) {
    case 'Elev':
      $nr = 0;
      break;
    case 'Profesor':
      $nr = 1;
      break;
    case 'Angajator':
      $nr = 2;
      break;
  }
  if($nr == -1) die("Ceva a mers prost. Ups!");
  $sql = "UPDATE users SET tip = $nr WHERE username = '$usr'";
  if (mysqli_query($conn, $sql)) {
    echo "Succes";
    if(isset($_SESSION['wrongCredentials'])) unset($_SESSION['wrongCredentials']);
    header('location: login.php');
  }
  else die(mysqli_error($conn));
}
?>
