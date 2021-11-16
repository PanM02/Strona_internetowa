<?php
session_start();
$id=$_SESSION['zalogowany'];

require_once 'dane.php';
$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$miejscowosc=$_POST['miejscowosc'];
$ulica_adres=$_POST['ulica_adres'];
$k_pocztowy=$_POST['k_pocztowy'];
$telefon=$_POST['telefon'];

if ($imie==""||$nazwisko==""||$ulica_adres==""||$k_pocztowy==""||$telefon=="") {
		header("Location:wysylka.php?blad=Nie wypełniłeś wszystkich danych!!!");
	} else {
		
$s=" ".$imie."(.)".$nazwisko."(.)".$miejscowosc."(.)".$ulica_adres."(.)".$k_pocztowy."(.)".$telefon;
$sql="SELECT id_ksiazki FROM wymiany
WHERE id_pozyczajacego='$id'
AND status='czeka na potwierdzenie'";
$result=$conn->query($sql);
while ($wiersz=$result->fetch_assoc()) {
	$idk=$wiersz['id_ksiazki'];
	$sql="SELECT * FROM ksiazka
	WHERE id='$idk'";
	$odp = $conn->query($sql);

	$odp=$odp->fetch_assoc();
	
	$id_ksiazki=$odp['id'];
	$id_o=$odp['id_uzytkownika'];
	$tytul=$odp['tytul'];
	$autor=$odp['autor'];
	$gatunek=$odp['gatunek'];
	$wydawnictwo=$odp['wydawnictwo'];
	$zdjecie=$odp['zdjecie'];
	$data_dodania=$odp['data_dodania'];
	$opis=$odp['opis'];
	$sql="INSERT INTO bufor_k(id, id_ksiazki, id_uzytkownika, tytul, autor, gatunek, wydawnictwo, zdjecie, data_dodania, opis) VALUES(NULL,'$id_ksiazki','$id_o', '$tytul', '$autor', '$gatunek', '$wydawnictwo', '$zdjecie', '$data_dodania', '$opis')";
	$conn->query($sql);
		$sql="UPDATE wymiany
SET dane = '$s' , status= 'czeka na wyslanie'
WHERE id_pozyczajacego= '$id'
AND status='czeka na potwierdzenie'";
$conn->query($sql);
	$polecenie="DELETE FROM ksiazka 
	WHERE id='$idk'";
	$conn->query($polecenie);
	;
}



header("Location:profil_u.php");
$conn->close();
	};

?>