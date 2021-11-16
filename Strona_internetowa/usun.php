<?php
	if(!isset($_POST['id_k'])&& !isset($_POST['id_u']))
		{
			header("Location:wysylka.php");
		}
	require_once "dane.php";
		
	$id_k=$_POST['id_k'];
	$id_k=intval($id_k);
	$id_u=$_POST['id_u'];
	$id_u=intval($id_u);
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql="DELETE FROM wymiany 
	WHERE id_pozyczajacego='$id_u' 
	AND id_ksiazki='$id_k'";
	$conn->query($sql);
	echo "Usunięto ksiazkę";

?>