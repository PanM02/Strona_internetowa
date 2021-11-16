<?php
	if(!isset($_POST['id_k'])&& !isset($_POST['id_u']))
	{
		header("Location:glowna.php");
	}

	# id_k- id ksiazki
	# id_u- id uzytkownika co wypozycza ksiazke
	# id_o- id uzytkownika do oddaje ksiazke 
	require_once "dane.php";
	$data_dodania=date("Y-m-d");
	$id_k=$_POST['id_k'];
	$id_k=intval($id_k);
	$id_u=$_POST['id_u'];
	$id_u=intval($id_u); # zmieniam wartość na int ponieważ baza nie przyjmuje wartosci string.
	$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$sql="SELECT id_uzytkownika FROM ksiazka 
	WHERE id='$id_k'";
	$wynik=$conn->query($sql);
	$liczba=$wynik->num_rows;
	$result=$wynik->fetch_assoc();
	$id_o=$result['id_uzytkownika'];
	
	if($liczba>0){
		$sql="SELECT lbpremium FROM uzytkownicy 
	WHERE id='$id_u'";
	$result = $conn->query($sql);
	$result=$result->fetch_assoc();

	if($result['lbpremium']>0)
	{
	
	$data_dodania=date("Y-m-d");
	
	$sql="INSERT INTO wymiany (id_wymiany, id_pozyczajacego, id_oddajacej, id_ksiazki, data, status) VALUES (NULL, '$id_u', '$id_o', '$id_k','$data_dodania','czeka na potwierdzenie')";
	 	$conn->query($sql);
	 	
	
  	
  		
  	
  echo "Udało sie.";}
else
	echo "Nie masz juz punktów premium.";
}
  else {
  	echo "Ksiażka już została wypożyczona.";
  }
  $conn->close();

  ?>
  