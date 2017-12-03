<?php
 session_start();
 require_once "connect.php";
 
 $connection = new mysqli($host, $db_user, $db_password, $db_name);
 $connection->query('SET NAMES utf8');
 $connection->query('SET CHARACTER_SET utf8_unicode_ci');
 if($connection->connect_errno!=0)
 {
	echo("Error: ".$connection->connect_errno .".");
 }
 else
 {	 
	 $login = $_POST['login'];
	 $login = stripslashes($login);
	
	 if ($result = @$connection->query(
	 sprintf("SELECT * FROM users WHERE login='%s'",
	 mysqli_real_escape_string($connection, $login))))
	 {
		$howmany = $result->num_rows;
		if($howmany > 0)
		{
			/*JEŻELI ISTNIEJE W BAZIE TAKI LOGIN - NIE MOŻNA STWORZYĆ KONTA*/
			
			$_SESSION['takenlogin'] = "<center><span style='color:red'>There already is such fella; Try another login, darlin'.</span></center>";
			header('Location: index.php');
			
		} else {
			/*JEŻELI NIE ISTNIEJE TAKI LOGIN W BAZIE - SPRAWDZAM MAILA*/
			$email = $_POST['email'];
			
			if ($result = @$connection->query(sprintf("Select 1 from users where email = '%s'",
			mysqli_real_escape_string($connection, $email))))
			{
				$howmany = $result->num_rows;
				if ($howmany > 0)
				{
					$_SESSION['takenemail'] = "<center><span style='color:red'>There already is such e-mail; Try another one, darlin'.</span></center>";
					header('Location: index.php');
				}
				else
			{
				/*JEŻELI NIE ISTNIEJE TAKI LOGIN ANI EMAIL W BAZIE - TWORZĘ KONTO*/
				$password = $_POST['password'];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				
				$connection->query(sprintf("INSERT into users VALUES (NULL,'%s','%s','%s','%s','%s')",
				mysqli_real_escape_string($connection, $login),
				mysqli_real_escape_string($connection, $password),
				mysqli_real_escape_string($connection, $firstname),
				mysqli_real_escape_string($connection, $lastname),
				mysqli_real_escape_string($connection, $email)));
				
				?><html lang="pl">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<link rel="stylesheet" type="text/css" href="style.css">
					<title>REGISTER'D</title>
				</head>
				<body>
				<?php
				echo("Stworzył użytkownika o loginie: ".$_POST['login'].", haśle: ".$_POST['password'].", pierwsze imię: ".$_POST['firstname'].", nazwisko: ".$_POST['lastname']." e-mail: ".$_POST['email'].".");
				$_SESSION['login'] = $login;
				$_SESSION['password'] = $password;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
				$_SESSION['email'] = $email;
				echo('<br><a href="sukces.php"><button type="submit">See yer profile</button></a>');	
			}
			?>
			
				</body>
				</html>
			<?php
			
			}
		}
	 }
	
	 $connection->close();
 }
 
?>