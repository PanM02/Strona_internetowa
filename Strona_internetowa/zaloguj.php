 <?php
 session_start();
 require_once "dane.php";

$mail=$_POST['mail'];
$haslo=$_POST['haslo'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql=sprintf("select * from `uzytkownicy` where `mail`='%s' and `haslo`='%s' LIMIT 1;", mysqli_real_escape_string($conn,$mail), mysqli_real_escape_string($conn,$haslo));

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	$result=$result->fetch_assoc();
	$_SESSION['zalogowany']=$result['id'];
 	 header('Location:glowna.php');
  
} else {
// header('Location:logowanie.html');
  $_SESSION['blad']="Nie ma takiego użytkownika";
 header('Location:index.php');
 

}
$conn->close();
?> 