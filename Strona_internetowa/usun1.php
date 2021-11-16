<?php
	if(!isset($_POST['id_k'])&& !isset($_POST['id_u']))
		{
			header("Location:wysylka.php");
		}
	require_once "dane.php";
		
	$id_k=$_POST['id_k'];
	$id_k=intval($id_k);
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql="DELETE FROM ksiazka
	WHERE id='$id_k'";
	$conn->query($sql);
	echo $conn->error;
	$sql="DELETE FROM wymiany
	WHERE id_ksiażki='$id_k'";
	$conn->query($sql);
	$conn->error;
	echo "Usunięto ksiazkę";

?>