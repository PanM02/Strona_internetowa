<!DOCTYPE html>
<html>
<head>
	<title>Dane do wysyłki</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id=menu>
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
<div class="row">
	<div class="col-md-2">
		
	</div>
	<div class="col-md-8">
		<?php 
		
		$blad="";
		if(isset($_GET['blad']))
			$blad=$_GET['blad'];
		session_start();
		if(isset($_SESSION['zalogowany'])!=TRUE)
		header('Location:index.php');
		$id=$_SESSION['zalogowany'];
		require_once "dane.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$sql="SELECT * FROM wymiany
		WHERE id_pozyczajacego='$id'
		AND status=\"czeka na potwierdzenie\"";
		$wynik=$conn->query($sql);

		$lb=$wynik->num_rows;
		
		if($lb==0){
			echo "<h3>Koszyk jest pusty</h3>";
		} else
		{
			while ($p=$wynik->fetch_assoc()) {
				$idk=$p["id_ksiazki"];
				$sql="SELECT * FROM ksiazka
				WHERE id='$idk'";
				$wiersz=$conn->query($sql);
				$wiersz=$wiersz->fetch_assoc();
				
				
				echo "<div id='produkt' class=\"row\"><a href=\"produkt.php?id=".$wiersz['id']."\" style=\"clear: all\">
			
				<div class=\"col-md-2\" id='zdj'> 	
		<img src=\"img/".$wiersz['zdjecie']."\" style=\"width: 130px; height: 130px;\"></div>

		<div class=\"col-md-8\" id='dane'><h3>".$wiersz['tytul']."</h3>
		 <h4>Autor:".$wiersz['autor']."&nbsp;&nbsp;&nbsp;&nbsp;    Wydawnictwo:".$wiersz['wydawnictwo']."</h4>  
		  <h4>data dodania:".$wiersz['data_dodania']."</h4>
		   <p id='opis'>".$wiersz['opis']."<p>
		</div></a>
		<div id=\"p_wypozycz\" class=\"col-md-2\"><button id=\"wypozycz\" onclick=\" wypozycz(".$wiersz['id'].",".$_SESSION['zalogowany'].")\">USUŃ!</button></div>
		<div style='clear: both;'></div>
		</div> ";
		
				
			}
			echo "<form method=\"POST\" action=\"wyslano.php\">
			<h3>Dane do wysyłki</h3>
			<label>Imie</label><br>
			<input id=\"imie\" type=\"text\" name=\"imie\" placeholder=\"np.:Jacek\" ><br>
			<label>Nazwisko</label><br>
			<input id=\"nazwisko\" type=\"text\" name=\"nazwisko\" placeholder=\"np.:Kowaski\"><br>
			<label>Miejscowosc</label><br>
			<input type=\"text\" name=\"miejscowosc\" placeholder=\"np.:Jarosław\"><br>
			<label>Ulica i nr. lokalu</label><br>
			<input id=\"ulica_adres\" type=\"text\" name=\"ulica_adres\" placeholder=\"np.:Ul. Henryka Sienkiewicza 1\"><br>
			<label>Kod pocztowy</label><br>
			<input id=\"k_pocztowy\" type=\"text\" name=\"k_pocztowy\" placeholder=\"np.:35-500 Jarosław\"><br>
			<label>Telefon</label><br>
			<input id=\"telefon\" type=\"text\" name=\"telefon\" placeholder=\"np.:951753684\"><br>
			<label id=\"uwaga\" style=\"color: red;\">".$blad."</label><br>
			<input id=\"przycisk\" type=\"submit\" value=\"Wyślij\">
		</form>";
		}



		 ?>
		<!-- <form>
			<h3>Dane do wysyłki</h3>
			<label>Imie</label><br>
			<input type="text" name="imie" placeholder="np.:Jacek"><br>
			<label>Nazwisko</label><br>
			<input type="text" name="nazwisko" placeholder="np.:Kowaski"><br>
			<label>Miejscowosc</label><br>
			<input type="text" name="miejscowosc" placeholder="np.:Jarosław"><br>
			<label>Ulica i nr. lokalu</label><br>
			<input type="text" name="ulica_adres" placeholder="np.:Ul. Henryka Sienkiewicza 1"><br>
			<label>Kod pocztowy</label><br>
			<input type="text" name="k_pocztowy" placeholder="np.:35-500 Jarosław"><br>
			<input type="submit" name="" value="Wyślij">
		</form>/> -->
	</div>
	<dir class="col-md-2">
		
	</dir>
	
</div>
<script type="text/javascript">
	const imie=document.querySelector("#imie");
	const nazwisko=document.querySelector("#nazwisko");
	const ulica_adres=document.querySelector("#ulica_adres");
	const k_pocztowy=document.querySelector("#k_pocztowy");
	const telefon=document.querySelector("#telefon");
	const uwaga=document.querySelector("#uwaga");
	const przycisk=document.querySelector("#przycisk");
	imie.addEventListener("click",function(){
		if (imie.value==""&&nazwisko.value==""&&ulica_adres.value==""&&k_pocztowy.value==""&&telefon.value=="") {
		uwaga.value="Nie wypełniłeś wszystkich potrzebnych danych!!!";
	} else {
		uwaga.value="";
	};

	})

	
</script>
<script type="text/javascript">
		
		function wypozycz(id_k,id_u) {
			
			
			var id_k=parseInt(id_k);
			var id_u=parseInt(id_u);
			$.ajax({
				type:"POST",
				url:"usun.php",
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