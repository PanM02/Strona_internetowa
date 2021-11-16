<?php
$idw=$_POST['id_w'];
require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="UPDATE wymiany SET status='czeka na odbiór'
WHERE id_wymiany='$idw'";
$conn->query($sql);
echo "Czekamy na odbiór";
$conn->close();


?>