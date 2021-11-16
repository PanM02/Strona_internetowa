<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	if(isset($_SESSION['zalogowany'])!=TRUE)
		header('Location:index.php');

	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>Strona główna</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
<div id="menu">
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"> 
			
		</div>
		<div class="col-md-2">
			<button id="button" onclick="window.location.href='glowna.php'">Strona główna</button>
		</div>
		<div class="col-md-2">
			
			<button id="button" onclick="window.location.href='d_ksiazke.php'">Dodaj ksiażkę</button>
		</div>
		<div class="col-md-2">
			<button id="button" onclick="window.location.href='profil_u.php'">Mój profil</button>
		</div>
		<div class="col-md-2">
			<form action="glowna.php" method="get">
			<input style="width: 65%;text-align: left;" type="text" name="szukaj">
			<input style="width: 30%; text-align: left;" type="submit" value="Szukaj">
			<div style="clear: both;"></div>
			</form>
		</div>
		<div class="col-md-2">
			<button id="button" onclick="window.location.href='wyloguj.php'">Wyloguj</button>
		
		</div>
		<div class="col-md-1">
			<button id="button" onclick="window.location.href='wysylka.php'"><img src="ikona.png"></button>
		</div>
	</div>
</div>
</div>
<?php

require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['szukaj']) && $_GET['szukaj']!="")
{
	$fraza=$_GET['szukaj'];
	$sql="SELECT * FROM ksiazka
	WHERE tytul LIKE '%$fraza%'";

}
else { 
	$sql="SELECT * FROM ksiazka 
	LIMIT 10
	";
}
$wynik=$conn->query($sql);
$liczba=$wynik->num_rows;
?>
<div id="glowna" class="row">
	
	
		<div class="col-md-2"> 
		</div>
		<div class="col-md-8">

<?php

while($wiersz=$wynik->fetch_assoc()) { 
			

			echo "<div id='produkt' class=\"row\"><a href=\"produkt.php?id=".$wiersz['id']."\" style=\"clear: all\">
			
				<div class=\"col-md-2\" id='zdj'> 	
		<img src=\"img/".$wiersz['zdjecie']."\" style=\"width: 130px; height: 130px;\"></div>

		<div class=\"col-md-8\" id='dane'><h3>".$wiersz['tytul']."</h3>
		 <h4>Autor:".$wiersz['autor']."&nbsp;&nbsp;&nbsp;&nbsp;    Wydawnictwo:".$wiersz['wydawnictwo']."</h4>  
		  <h4>data dodania:".$wiersz['data_dodania']."</h4>
		   <p id='opis'>".$wiersz['opis']."<p>
		</div></a>";
		if($wiersz['id_uzytkownika']==$_SESSION['zalogowany'])
			echo "<div class=\"col-md-2\"> </div>";
		else 
			echo "<div id=\"p_wypozycz\" class=\"col-md-2\"><button id=\"wypozycz\" onclick=\" wypozycz(".$wiersz['id'].",".$_SESSION['zalogowany'].")\">Wypożyczam!</button></div>";

		echo "<div style='clear: both;'></div>
		</div> ";

}

?>
<a href="" style="clear: all"></a>
	</div>
	<div class="col-md-1"> 
			
		</div>

	</div>

<script type="text/javascript">
		
		function wypozycz(id_k,id_u) {
			
			
			var id_k=parseInt(id_k);
			var id_u=parseInt(id_u);
			$.ajax({
				type:"POST",
				url:"wypozycz.php",
				data:{id_k:id_k,id_u:id_u},
				success:function(bład){
					alert(bład);
				},
				error: function(){
					alert("nie udało sie");
				}
			});


		};

	</script>
</body>
</html>
