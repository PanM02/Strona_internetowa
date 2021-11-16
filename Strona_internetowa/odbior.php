<?php
$idw=$_POST['id_w'];
require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="UPDATE wymiany SET status='odebrano'
WHERE id_wymiany='$idw'";
$conn->query($sql);
$sql="SELECT id_oddajacej, id_pozyczajacego
FROM wymiany WHERE id_wymiany='$idw'";
$odp=$conn->query($sql);
$odp=$odp->fetch_assoc();

$ido=$odp['id_oddajacej'];
$idp=$odp['id_pozyczajacego'];


$sql="SELECT lbpremium FROM uzytkownicy
WHERE id='$ido'";
$odp=$conn->query($sql);
$odp=$odp->fetch_assoc();
$lbp=$odp['lbpremium'];
$lbp=$lbp+1;
$sql="UPDATE uzytkownicy SET lbpremium='$lbp'
WHERE id='$ido'";
$conn->query($sql);


$sql="SELECT lbpremium FROM uzytkownicy
WHERE id='$idp'";
$odp=$conn->query($sql);
$odp=$odp->fetch_assoc();
$lbp=$odp['lbpremium'];
$lbp=$lbp-1;
$sql="UPDATE uzytkownicy SET lbpremium='$lbp'
WHERE id='$idp'";
$conn->query($sql);

$sql="UPDATE wymiany SET status='odebrano'
WHERE id_wymiany='$idw'";
$conn->query($sql);
$conn->close();
echo "Udało sie odebrać";


?>