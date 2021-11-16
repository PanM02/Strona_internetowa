<!DOCTYPE html>
<html>
<head>
	<title>Witaj</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


 


 <a href="index.php" ><input type="submit" value="Powrót."></a>
 <form >
            	<label for="imie"> Podaj imie</label><br>
            	<input type="text" name="imie" id="imie" value="np.jacek" onfocusout="f_wyjdzi()"required/><br>
            	<label for="nazwisko">Podaj nazwisko</label><br>
                <input type="text" name="nazwisko" id="nazwisko" value="np.Kowalski" onfocusout="f_wyjdzn()"required/><br>
                <label for="mail"> podaj mail</label><br>
                <input type="email" name="mail" id="mail" value="np.nazwa@poczta.pl" onfocusout="f_wyjdzm()"required/><br>
                <label for="haslo"> Podaj hasło</label><br>
                <input type="password" name="haslo" id="haslo" onfocusout="f_wyjdzh()" value="haslo" required/><br>
                <input type="text" id="odp"  readonly style="background-color: #fff7e6;border: none; width:420px;color: red;"><br>
              
                <input id="rej" type="submit" name="Zaloguj" value="Zarejestruj" >
        </form><br>

        <script type="text/javascript">
          const odp = document.querySelector("#odp");
          imie.addEventListener("click",function(){
          if(this.value=="np.jacek")
               this.value="";
            });
          function f_wyjdzi(){
               if(imie.value==""){
            imie.value="np.jacek";
                 };
    
              };
          const nazwisko=document.querySelector("#nazwisko");
          nazwisko.addEventListener("click",function(){
              if(this.value=="np.Kowalski")
              this.value="";
          });
          function f_wyjdzn(){
              if(nazwisko.value==""){
                  nazwisko.value="np.Kowalski";
              };
              }
          const mail=document.querySelector("#mail");
          mail.addEventListener("click",function(){
              if(this.value=="np.nazwa@poczta.pl")
              this.value="";
          });
          function f_wyjdzm(){
              if(mail.value==""){
                  mail.value="np.nazwa@poczta.pl";
              };
          };
          const haslo=document.querySelector("#haslo");
          haslo.addEventListener("click",function(){
             if(this.value=="haslo")
              this.value="";
          });
          function f_wyjdzh(){
              if(haslo.value==""){
                 haslo.value="haslo";
             };
             var n=haslo.value.length;
             
              if(n<6){
                  odp.value="za krótkie haslo(musi miec conajmniej 6 znaków)!!!";
              } else odp.value="";
              };
              const rej=document.getElementById("rej");
              rej.addEventListener("click",function(){
              var bład;
                $.ajax({
                  type:"POST",
                  url:"rejestracja.php",
                  data:{haslo:haslo.value,imie:imie.value,nazwisko:nazwisko.value,mail:mail.value},
                  success:function(blad){
                    alert(blad);
                  },
                  error:function(){
                    alert("nie udało sie ");
                  }}
                  )
               }
                 );

          

          
        </script> 
</body>
</html>