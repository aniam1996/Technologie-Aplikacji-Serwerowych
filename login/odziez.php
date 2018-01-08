<!DOCTYPE HTML>



<?php

	session_start();

	

	if((isset($_SESSION['loggedin']))){

		header('Location: sukces.php');

		exit();

	}

?>





<html lang="pl">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

              <title>ODZIEŻ</title>

		<link rel="stylesheet" type="text/css" href="style.css">

    </head>

    

    <body><center>
	<h1>Sklep kowbojski</h1>
	</center>
	
        <button onclick="document.getElementById('loginpopout').style.display='block'">Login</button>

		<button onclick="document.getElementById('registerpopout').style.display='block'">Register</button>
	
	<br><br>
	<a href="kowbojki.php"><buttonmenu>Kowbojki</buttonmenu></a>
	<a href="paski.php"><buttonmenu>Paski do ostróg</buttonmenu></a>
	<a href="kapelusze.php"><buttonmenu>Kapelusze</buttonmenu></a>
	<a href="odziez.php"><buttonmenu>Odzież</buttonmenu></a>
	<a href="dodatki.php"><buttonmenu>Dodatki</buttonmenu></a>	
	<a href="zapalniczki.php"><buttonmenu>Zapalniczki ZIPPO</buttonmenu></a>	
	<a href="rewolwery.php"><buttonmenu>Rewolwery</buttonmenu></a><br>	

	
	<center>
		<?php

		if(isset($_SESSION['wronginput'])) {

			echo('<div id="loginpopout" class="modal2">');

		} else {

			echo('<div id="loginpopout" class="modal">');

		}

		?>	

		<!-- ----LOGIN MODAL -------->

        <div class="modal-content animate">

			<form action="trylogin.php" method="post">

			<span id="close" class="close">&times;</span>

			<center>

			<label><h2>YEEHAW</h2><hr></label>

			<table>

			<th>

			<label title = "lil bro"><img width="100%" src="https://github.com/drakar1903/Technologie-Aplikacji-Serwerowych/blob/master/Logo.png?raw=true"><br/>

			</label>

			</th>

			<th>

			<label title = "Yer login">Yer login:

			<input type="text" name="login" placeholder="Enter yer login" required><br/><br/>

			</label>

			<label title = "Yer pass">Yer pass:

			<input type="password" name="password" placeholder="Enter yer password" required><br/><br/></br>

			</labe>

			<label title="Log in">

			<button type="submit">Log in, pardner</button> <br/><br/>

			<?php

				if (isset($_SESSION['wronginput'])){

				echo $_SESSION['wronginput'];}

			?>

			</label>

			</form>

			</th>

			<th style="padding:0">

			<br/><br/><br/><br/>

			<input type="checkbox" checked="unchecked"><small>Remember me</small></font><br/><br/><br/>

			

			<a href="forgotpass.php"><small>Dang it I forgot.</small></a>

			

			</th>

			</table>

			</center>

		</div>

		</div>

		

		<!-- ----REGISTRATION MODAL-->

		<?php

		if(isset($_SESSION['takenlogin']) || isset($_SESSION['takenemail'])) {

			echo('<div id="registerpopout" class="modal2">');

		} else {

			echo('<div id="registerpopout" class="modal">');

		}

		?>

		<div class="modal-content animate">

		<form action="register.php" method="post">	

			<span id="close2" class="close">&times;</span>

			<label><center>Complete the form:</center></label>

			<hr>

			<label title = "First name">First name:

			<input type="text" name="firstname" placeholder="Enter the name yer mommy gave ya" required><br/><br/>

			</label>

			<label title = "Last name">Last name:

			<input type="text" name="lastname" placeholder="Enter the name yer daddy gave ya" required><br/><br/>

			</label>

			<label title="Login">Login:

			<input type="text" name="login" placeholder="Enter the login ya want" required><br/><br/>

			</label>

			<label title = "E-mail">E-mail:

			<input type="email" name="email" placeholder="Enter yer e-mail" required><br/><br/>

			</label>

			<label title = "Password">Password:

			<input type="password" name="password" placeholder="Enter the password ya want" required><br/><br/>

			</label>

			<?php

				if (isset($_SESSION['takenlogin'])){

				echo $_SESSION['takenlogin'];}

				if (isset($_SESSION['takenemail'])){

				echo $_SESSION['takenemail'];}

			?>

			<br/><br/><center><button type="submit">Join th' pack</button></center>

		</form>

		</div>

		</div>

		 

	<script>

	//login modal

	var modal = document.getElementById('loginpopout');

	var btn = document.getElementById('close');

	//registration modal

	var modal2 = document.getElementById('registerpopout');

	var btn2 = document.getElementById('close2');

	

	

	btn.onclick = function() {

		modal.style.display = "none";

		<?php session_unset() ?>

	}

	btn2.onclick = function() {

		modal2.style.display = "none";

		<?php session_unset() ?>

	}

	



	window.onclick = function(event) {

		if (event.target == modal2) {

			modal2.style.display = "none";

			<?php session_unset() ?>

		}

		if (event.target == modal) {

			modal.style.display = "none";

			<?php session_unset() ?>

		}

	}

	

	

	</script>
	<br><br><br><br><br>
	<a href="index.php"><buttonsort>Strona główna</buttonsort></a>

	
<?php
 require_once "connect.php";
 $connection = new mysqli($host, $db_user, $db_password, $db_name);
 $connection->query('SET NAMES utf8');
 $connection->query('SET CARACTER_SET utf8_unicode_ci');
 
 $wynik = $connection -> query('select opis,zdjecie,cena from produkty WHERE kategoria LIKE "odziez" ');
 while (($tabela=$wynik -> fetch_assoc()) !== null)
 {
	 echo '<br>'.'<br>'.$tabela['zdjecie'].'<br>';
	 echo $tabela['opis'].'<br>';
	 echo $tabela['cena'].' zł'.'<br>';
 }
 $wynik -> close();
 $connection -> close();
 ?>
 
    </center></body>

</html>
