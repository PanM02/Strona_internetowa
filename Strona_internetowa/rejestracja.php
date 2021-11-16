<?php
require_once "dane.php";
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$mail=$_POST['mail'];
$haslo=$_POST['haslo'];
 if($haslo!="haslo"&&strlen($haslo)>6&&$imie!="np.jacek"&&$nazwisko!="np.Kowalski"&&$mail!="np.nazwa@poczta.pl"){
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM uzytkownicy
WHERE  mail='$mail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 echo "Uzytkownik o podanym mailu juz istnieje.";
  
} else {


  $sql="INSERT INTO uzytkownicy (id, imie, nazwisko, mail, haslo, lbpremium) VALUES (NULL, '$imie', '$nazwisko', '$mail', '$haslo', '5')";
  $conn->query($sql);
  echo "Zostałes zarejestrowany.";
 
 

}
$conn->close();
} else echo "Nie poprawne dane!!!";



?>