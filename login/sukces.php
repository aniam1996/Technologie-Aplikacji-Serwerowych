<?php
session_start();

?>

<html lang="pl">
    <head>
        <meta charset=""utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>WOW</title>
	</head>
	
	<body>
	<?php
	echo("Login:".$_SESSION['login']."<br/>");
	echo("Pass:".$_SESSION['password']."<br/>");
	echo("First name:".$_SESSION['firstname']."<br/>");
	echo("Last name:".$_SESSION['lastname']."<br/>");
	echo("email:".$_SESSION['email']."<br/><br/>");
	?>
	<a href="logout.php"><button onclick="logout.php" type="submit">Log out, pardner</button></a>

	</body>
</html>