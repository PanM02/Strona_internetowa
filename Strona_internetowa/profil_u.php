
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>Profil użytkownika</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	session_start();
	if(isset($_SESSION['zalogowany'])!=TRUE)
		header('Location:index.php');

	?>
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
<div id="glowna" class="row">
	
	
		<div class="col-md-2"> 
		</div>
		<div class="col-md-8">
<?php

require_once "dane.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id=$_SESSION['zalogowany'];
$sql = "SELECT imie,nazwisko,mail,haslo,lbpremium FROM uzytkownicy
WHERE id='$id'";

$result = $conn->query($sql);
$result=$result->fetch_assoc();
$sql = "SELECT * FROM ksiazka
WHERE id_uzytkownika='$id'";
$result1 = $conn->query($sql);

echo "<form action=\"zmien.php\" method=\"post\" style=\"text-align:center; margin-bottom: 100px;\">
		<label>Imie</label><br>
		<input type=\"text\" name=\"imie\" value=\"".$result['imie']."\"><br>".
		"<label>Nazwisko</label><br>
		<input type=\"text\" name=\"nazwisko\" value=\"".$result['nazwisko']."\"><br>".
		"<label>Mail</label><br>
		<input type=\"text\" name=\"mail\" value=\"".$result['mail']."\"><br>".
		 "<label>Hasło</label><br>
		<input type=\"password\" name=\"haslo\" value=\"".$result['haslo']."\"><br><br>".
		"<label>Liczba posiadanych punktów=".$result['lbpremium']."</label><br><br>
		<input type=\"submit\" value=\"Zmień\">
		</form>";

echo "<h3>Ksiązki które posiadasz:</h3>";
if(mysqli_num_rows($result1)>0)
while ($wiersz=$result1->fetch_assoc()) {
	# KSIAZKI KTÓRE POSIADASZ --------
	echo "<div id='produkt' class=\"row\"><a href=\"produkt.php?id=".$wiersz['id']."\" style=\"clear: all\">
			
				<div class=\"col-md-2\" id='zdj'> 	
		<img src=\"img/".$wiersz['zdjecie']."\" style=\"width: 130px; height: 130px;\"></div>

		<div class=\"col-md-8\" id='dane'><h3>".$wiersz['tytul']."</h3>
		 <h4>".$wiersz['autor']."   ".$wiersz['wydawnictwo']."</h4>  
		  <h4>data dodania:".$wiersz['data_dodania']."</h4>
		   <p id='opis'>".$wiersz['opis']."<p>
		</div></a>
		<div id=\"p_usun\" class=\"col-md-2\"><button id=\"usun\" onclick=\" usun(".$wiersz['id'].")\">Usuń!</button></div>
		<div style='clear: both;'></div>
		</div> ";
} else
{
	echo "<h4>Nie posiadasz żadnych ksiażek</h4>";
}
unset($result1);










echo "<h3>Ksiązki do wysłania:</h3>";
$sql = "SELECT * FROM wymiany
WHERE id_oddajacej=$id
AND status='czeka na wyslanie'";
$result1 = $conn->query($sql);
if(mysqli_num_rows($result1)>0)
{	
	
	while ($odp=$result1->fetch_assoc()){
		$tab=[];
		$tl=0;
		$id_k=$odp['id_ksiazki'];
		$s=$odp['dane'];
		$z=$s[0];
		for($i=1; $i<(strlen($s));$i++){
			if($s[$i-1]=="("&&$s[$i]=="."&&$s[$i+1]==")"){
				$z[0]=" ";
				$z[strlen($z)-1]=" ";
				$tab[$tl]=$z;
				$tl++;
				$z="";
				
			}
			else {
				$z=$z.$s[$i];
			}
			}
			$z[0]=" ";
			$tab[$tl]=$z;
	$sql = "SELECT * FROM bufor_k
	WHERE id_ksiazki='$id_k'";
	$wiersz = $conn->query($sql);
	$wiersz=$wiersz->fetch_assoc();
	 
		#KSIĄŻKI DO WYSŁANIA-------------
		
		echo "<div id='produkt' class=\"row\"><a href=\"produkt.php?id=".$wiersz['id']."\" style=\"clear: all\">
				
					<div class=\"col-md-2\" id='zdj'> 	
			<img src=\"img/".$wiersz['zdjecie']."\" style=\"width: 130px; height: 130px;\"></div>

			<div class=\"col-md-5\" ><h3>".$wiersz['tytul']."</h3>
			 <h4>".$wiersz['autor']."   ".$wiersz['wydawnictwo']."</h4>  
			  <h4>data dodania:".$wiersz['data_dodania']."</h4>
			   <p id='opis'>".$wiersz['opis']."<p>
			</div >
			<div id=\"dane\" class=\"col-md-5\">
			".$tab[0]."  ".$tab[1]."<br>".$tab[2].$tab[3]."<br>".$tab[4]."<br>".$tab[5]."
			</div>
			</a>
			<div id=\"p_wyslij\" class=\"col-md-2\"><button id=\"wyslij\" onclick=\" wyslij(".$odp['id_wymiany'].")\">Została wysłana!</button></div>
			<div style='clear: both;'></div>
			</div> ";
} }else
{
	echo "<h4>Nie posiadasz żadnych ksiażek do wysłania</h4>";
}
unset($result1);











echo "<h3>Ksiązki do odebrania:</h3>";
$sql = "SELECT * FROM wymiany
WHERE id_pozyczajacego=$id
AND status='czeka na odbiór'";
$result1 = $conn->query($sql);
if(mysqli_num_rows($result1)>0)
{
while ($wiersz=$result1->fetch_assoc()) {
	# KSIAZKI KTÓRE SA DO ODEBRANIA--------------
	$idk=$wiersz["id_ksiazki"];
	$idw=$wiersz["id_wymiany"];
	$sql = "SELECT * FROM bufor_k
WHERE id_ksiazki='$idk'";
$result2 = $conn->query($sql);
$wiersz=$result2->fetch_assoc();
	echo "<div id='produkt' class=\"row\"><a href=\"produkt.php?id=".$wiersz['id']."\" style=\"clear: all\">
			
				<div class=\"col-md-2\" id='zdj'> 	
		<img src=\"img/".$wiersz['zdjecie']."\" style=\"width: 130px; height: 130px;\"></div>

		<div class=\"col-md-8\" id='dane'><h3>".$wiersz['tytul']."</h3>
		 <h4>".$wiersz['autor']."   ".$wiersz['wydawnictwo']."</h4>  
		  <h4>data dodania:".$wiersz['data_dodania']."</h4>
		   <p id='opis'>".$wiersz['opis']."<p>
		</div></a>
		<div id=\"p_odbior\" class=\"col-md-2\"><button id=\"odbior\" onclick=\" odbior(".$idw.")\">Odebrałem!</button></div>
		<div style='clear: both;'></div>
		</div> ";
} }
 else
{
	echo "<h4>Nie posiadasz żadnych ksiażek do odebrania</h4>";
}
?>	
<div class="col-md-2"></div>
</div>
</div>
<script type="text/javascript">
		function usun(id_k){

			var id_k=parseInt(id_k);
			$.ajax({
				type:"POST",
				url:"usun1.php",
				data:{id_k:id_k},
				success:function(bład){
					alert(bład);
				},
				error: function(){
					alert("nie udało sie");
				}
			});
		};
		
		function wyslij(id_w) {
			
			
			
			var id_w=parseInt(id_w);
			$.ajax({
				type:"POST",
				url:"wyslij.php",
				data:{id_w:id_w},
				success:function(bład){
					alert(bład);
				},
				error: function(){
					alert("nie udało sie");
				}
			});


		};
		function odbior(id_w){
			var id_w=parseInt(id_w);
			$.ajax({
				type:"POST",
				url:"odbior.php",
				data:{id_w:id_w},
				success:function(bład){
					alert(bład);
				},
				error: function(){
					alert("nie udało sie");
				}
			});
		}

	</script>
</body>
</html>

