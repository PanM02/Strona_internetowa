<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
	<a href="glowna.php" ><input type="submit" value="Powrót."></a>
	<div id="d_ksiazke">

		<h2 style="text-align: center;"> Dodaj książkę </h2><br>
		
 <form action="d_ksiazke1.php" method="post" ENCTYPE="multipart/form-data" >
 	<label> Tytuł</label><br>
 	<input type="text" name="tytul"><br>
 	<label>Autor</label><br>
 	<input type="text" name="autor"><br>
 	<label>Wydawnictwo</label><br>
 	<input type="text" name="wydawnictwo"><br>
 	<label>Gatunek</label><br>
 	<select name="gatunek">
 		<?php
 			session_start();
 			if(isset($_SESSION['zalogowany'])!=TRUE)
			header('Location:index.php');
			require_once "dane.php";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT * FROM gatunek";
			$gatunek=$conn->query($sql);
			
			while($wiersz=$gatunek->fetch_assoc())
			{
				echo("<option value=".$wiersz['id'].">".$wiersz['nazwa']."</option><br>");

			};


 		?>
 		
 	</select><br>
	<label>Opis</label><br>
	<input type="text" name="opis"><br>
	<input type="file" name="plik" style="margin-left: auto; margin-right: auto;" > <br>
	<label>Max 2 MB</label><br>
	<?php
	if(isset($_SESSION['blad'])==TRUE){
		echo "<label style=\"color: red;\">".$_SESSION['blad']."</label><br>";
		unset($_SESSION['blad']);
	}

	?>
 	<input type="submit" value="Dodaj">

 </form>
</div>

</body>
</html>