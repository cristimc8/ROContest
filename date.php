<?php
include 'conf.php';
include 'checkLogin.php';

$conc = $_SESSION['concurs'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $nume = $_REQUEST['nume'];
  $nume = str_replace(' ', '', $nume);
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
    echo "<script>location.replace('administrare.php'); </script>";
  }

  if(!$exista || $exista){
    $sql = "UPDATE concursuri set nume = '$nume', data = '$data', locatie = '$locatia', tel = '$telefon', email = '$email', domeniu = '$domeniu', descriere = '$descriere' where nume = '$conc'";
  if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('administrare.php'); </script>";
  }
  else die(mysqli_error($conn));
  }
  else echo "<script>alert('Un concurs cu acest nume exista deja!');   </script>";
}

?>
