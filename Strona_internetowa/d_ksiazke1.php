<?php

session_start();
$id_uzytkownika=$_SESSION['zalogowany'];
$tytul=$_POST['tytul'];
$autor=$_POST['autor'];
$gatunek=$_POST['gatunek'];
$wydawnictwo=$_POST['wydawnictwo'];
$data_dodania=date("Y-m-d");
$opis=$_POST['opis'];


if($tytul!=""&$autor!=""&$gatunek!=""&$wydawnictwo!=""&$opis!=""){
require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT id FROM ksiazka
ORDER BY id DESC LIMIT 1";
$ostatni=$conn->query($sql);
$sql="SELECT id_ksiazki FROM wymiany
ORDER BY id_ksiazki DESC LIMIT 1";
$ostatniw=$conn->query($sql);
echo $conn->error;
if($ostatni->num_rows>0 || $ostatniw->num_rows>0){
    $ostatni=$ostatni->fetch_assoc();
    $ostatniw=$ostatniw->fetch_assoc();
    if($ostatni['id']>$ostatniw['id_ksiazki'])
    $nr_zdj=$ostatni['id']+1;
    else $nr_zdj=$ostatniw['id_ksiazki']+1;
    }
 else 
    {$nr_zdj=0;};
$max_rozmiar = 1024*1024*10;
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if ($_FILES['plik']['size'] > $max_rozmiar) {
        echo 'Błąd! Plik jest za duży!';
    } else {

        echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
        $_FILES['plik']['name']=$nr_zdj;
        echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
        echo '<br/>';
        if (isset($_FILES['plik']['type'])) {
            echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
        }
        move_uploaded_file($_FILES['plik']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'].'/Strona_internetowa/img/'.$_FILES['plik']['name']);
       
       $sql="INSERT INTO ksiazka(id,id_uzytkownika,tytul,autor,gatunek,wydawnictwo,zdjecie,data_dodania,opis) VALUES(NULL,'$id_uzytkownika','$tytul','$autor','$gatunek','$wydawnictwo','$nr_zdj','$data_dodania','$opis')";
$conn->query($sql);
if($nr_zdj==0){
$sql="SELECT id FROM ksiazka
ORDER BY id DESC LIMIT 1";
$ostatni=$conn->query($sql);
$ostatni=$ostatni->fetch_assoc();
$id=$ostatni['id'];
$nr_zdj=$ostatni['id'];
$sql="UPDATE ksiazka SET
 zdjecie ='$nr_zdj'
 where id='$id'";
 rename($_SERVER['DOCUMENT_ROOT']."/Strona_internetowa/img/0", $_SERVER['DOCUMENT_ROOT']."/Strona_internetowa/img/".$nr_zdj);
$conn->query($sql);
}
header("Location:glowna.php");

$conn->close();
    }
} else {
   echo 'Błąd przy przesyłaniu danych!';
}
 }else {
    $_SESSION['blad']="Nie wypełniłeś wszystkich potrzebnych danych";
    header("Location:d_ksiazke.php");
 }

?>