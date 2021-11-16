<?php
session_start();
require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$mail=$_POST['mail'];
$haslo=$_POST['haslo'];
$id=$_SESSION['zalogowany'];
$sql="UPDATE uzytkownicy
SET imie='$imie',
nazwisko='$nazwisko',
mail='$mail',
haslo='$haslo'
WHERE id='$id'
";
$conn->query($sql);
$conn->close();
header("Location:profil_u.php");
?>
