<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Zaloguj się</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 
	
</head>
<body>
	
	<script type="text/javascript">
		/* scrypt który uzupełnia puste pole mail*/
		document.getElementById("mail").onfocus = function(){wejdz_m()};
	function wejdz_m(){
	if(mail.value=="np.jacek")
        mail.value="";
    };

    
document.getElementById("mail").onfocusout = function(){wyjdz_m()};
	function wyjdz_m(){
	if(mail.value=="")
        mail.value="np.jacek";
    };
    

    
</script>
	<div id="logo">
		Czytanie książek to najpiękniejsza zabawa, jaką sobie ludzkość wymyśliła
	</div>
	<div id="login">
		<form action="zaloguj.php" method="post">
			<label>Login</label><br>
			<input id="mail" type="text" name="mail" onfocusout="wyjdz_m()" onfocus="wejdz_m()" ><br><br>
			<label>Hasło</label><br>
			<input id="haslo" type="password" name="haslo" required ><br><br>
				<?php
			session_start();
			if(isset($_SESSION["blad"]))
			{
				echo"<label style='color: red'>".$_SESSION['blad']."</label><br/>";
				unset($_SESSION['blad']);
			}

			?>
			<label>Nie masz konta?<a href="rejestracja1.php">Zarejestruj sie</a></label><br/>
			<input type="submit" name="Zaloguj" value="Zaloguj">
	
		</form>
	
</div>

</body>
</html>