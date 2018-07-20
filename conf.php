<?php
/*$servername = "sql11.freemysqlhosting.net";
$username = "sql11214633";
$password = "LAzWBi1hnU";
$dbname = "sql11214633";*/

$servername = "localhost";
$username = "root";
$password = "7a96429be";
$dbname = "rocontest";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
