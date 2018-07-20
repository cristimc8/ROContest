<?php
  include 'conf.php';
?>

<!DOCTYPE HTML>

<head>
  <title>ShareMe</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  <link rel="icon" href="resurse/flag.png">
</head>

<body>
  <div class = "container">
    <div id = "right">
      <form action="" method="post">
        <input type="text" name="username" placeholder="Username" class = "input">
        <input type="password" name="password" placeholder="Parola" class = "input">
        <input type="text" name="nume" placeholder="Nume" class = "input">
        <input type="text" name="prenume" placeholder="Prenume" class = "input">
        <input type="text" name="email" placeholder="Email" class = "input">
        <br>
        <input type="submit" name="login" value="Creaza cont" class = "but">
      </form>
    </div>
  </div>
</body>


<?php
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    $nume = $_REQUEST['nume'];
    $prenume = $_REQUEST['prenume'];
    $email = $_REQUEST['email'];
    $fa = true;
    if(empty($pass)) $fa = false;
    $pass = md5($pass);

    if(trim($user) != '' && trim($pass) != '' && trim($nume) != '' && trim($prenume) != '' && trim($email) != '' && $fa){
      $sql = "select picID from users where username = '$user'";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">alert("Un cont cu acel username exista deja!");</script>';
      }
      else{
        $_SESSION['temp-username'] = $user;
        $sql = "insert into users values(NULL, '$user', '$pass', '$nume', '$prenume', '$email', 0, 1, 0, '')";
        if (mysqli_query($conn, $sql)) {
          echo "Succes";
          header('location: Type.php');
        }
      }
    }
    else {
      header("location: register.php");
    }
    mysqli_close($conn);
  }
?>
