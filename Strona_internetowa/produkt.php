<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title></title>
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
			
			<button id="button" onclick="window.location.href='d_ksiazke.html'">Dodaj ksiażkę</button>
		</div>
		<div class="col-md-2">
			<button id="button" onclick="window.location.href='profil_u.php'">Mój profil</button>
		</div>
		<div class="col-md-2"><form action="glowna.php" method="get">
			<input style="width: 65%;text-align: left;" type="text" name="szukaj">
			<input style="width: 30%; text-align: left;" type="submit" value="Szukaj">
			<div style="clear: both;"></div>
		</div>
		<div class="col-md-2">
			<button id="button" onclick="window.location.href='index.php'">Wyloguj</button>
		</form>
		</div>
		<div class="col-md-1">
			<button id="button" onclick="window.location.href='profil_u.php'"><img src="ikona.png"></button>
			
		</div>
	</div>
</div>
</div>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-2" > 
			
		</div>
		<div class="col-md-8">
			
		
		
	
<?php
session_start();
require_once "dane.php";
$id=$_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ksiazka
WHERE id='$id'";
$result = $conn->query($sql);
$result=$result->fetch_assoc();
$id=$result['id_uzytkownika'];
$sql = "SELECT imie FROM uzytkownicy
WHERE id='$id'";
$result1 = $conn->query($sql);
$result1=$result1->fetch_assoc();

echo "<div id=\"pokaz\">
	<div style=\"text-align: center;\" >
		<img style=\"width: 500px;\" src=\"img/".$result['zdjecie']."\">
	</div>
	<div style=\"text-align: center;background-color: white; \">
	<h2>".$result['tytul']."</h2> <br>
	<h3>Autor:".$result['autor']."</h3><br>
	<h3>Wydawnictwo: ".$result['wydawnictwo']."
	<h3>Opis</h3><h4>".$result['opis']."</h4><br>
	<h4> Dodano:".$result['data_dodania']."</h4><h4> Dodano przez ".$result1['imie']."</h4><br>
	</div>
</div>";







?>
<br>
<div class="wypozycz">
	<button id="wypozycz" value="<?php echo $result['id'];  ?>"  >Wypożycz</button>
	<span id="response"></span>
	<script type="text/javascript">
		const przycisk = document.querySelector("#wypozycz");
		przycisk.addEventListener("click",function() {
			var id_k=parseInt(przycisk.value,10);
			var id_u=parseInt('<?php echo $_SESSION['zalogowany']?>',10);
			$.ajax(
			{
				type:"POST",
				url:"wypozycz.php",
				data:{id_k:id_k,id_u:id_u},
				success:function(){
					alert("udało sie ");
				},
				error: function(){
					alert("nie udało sie");
				}
			});
		});

	</script>
</div>
</div>

		<div class="col-md-2">
			
		</div>
	</div>
</div>
</body >
</html>