<!DOCTYPE HTML>
<?php session_start() ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>BAD MEMORY BOI</title>
</head>

<body>
	
	<a href="index.php"><button><font size="2"><--- go back</font></button></a>
	<center>
	<form align="center" style="width: 300px; border: 10px black" action="sendemail.php" method="post">
	<h2>To recover your password enter:</h2>
	<label title = "login">your login:
	<input type="text" name="login" placeholder="login">
	or</label><br/><br/>
	<label title = "email">your e-mail:
	<input type="email" name="email" placeholder="email"><br/>
	</label>
	<?php
		if(isset($_SESSION['error']))
		{
			echo($_SESSION['error']);
		}
	?>
	<br/>
	<button type="submit"><font size="3">Help</button></form>
	<?php if(isset($_SESSION['sukces']))
	{
		echo($_SESSION['sukces']);
	}?>
</body>
</html>