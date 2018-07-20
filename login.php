<!DOCTYPE HTML>
<?php
include 'conf.php';
?>

<head>
  <title>ROContest - Login</title>
  <link rel = "stylesheet" type = "text/css" href = "css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
  <link rel="stylesheet" href="css/slideshow.css">
  <link rel="icon" href="resurse/flag.png">
</head>

<body style = "background-color: rgb(11, 17, 25);">
  <ul class="cb-slideshow" style = "margin-top: 0; padding-top: 0;">
    <li>
      <span>Image 01</span>
    </li>
    <li><span>Image 02</span></li>
    <li><span>Image 03</span></li>
    <li><span>Image 04</span></li>
  </ul>
  <div style = "position: absolute; left: 0; right: 0; margin: auto; height: 10%;width: 95%; border-radius: 10px; border-color: white; text-align: center;">
    <p style = "font-size: 24px; padding-top: 15px;">Inscrie-te pentru o noua lume a concursurilor</p>
  </div>
  <div class = "container">
    <div id = "right">
      <form action="verify.php" method="post">
        <input type="text" name="username" placeholder="Username" class = "input">
        <input type="password" name="password" placeholder="Parola" class = "input">
        <input type="submit" name="login" value="Autentificare" class = "but">
      </form>
      <form action="Register.php">
        <input type="submit" value="Inregistrare" class = "but">
      </form>
      <?php if(isset($_SESSION['wrongCredentials'])) echo "<p style = 'color: red; font-size: 22px;'>Date gresite</p>"; ?>
    </div>
  </div>
</body>
