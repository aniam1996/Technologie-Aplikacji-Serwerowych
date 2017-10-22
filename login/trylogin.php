<?php
 session_start();
 
 require_once "connect.php";

 $connection = new mysqli($host, $db_user, $db_password, $db_name);
 
 if($connection->connect_errno!=0)
 {
	echo("Error: ".$connection->connect_errno .".");
 }
 else
 {
	 echo("Udało się połączyć z bazą $db_name. <br/>");
	 
	 $login = $_POST['login'];
	 $password = $_POST['password'];
	 
	 $login = stripslashes($login);
	 $password = stripslashes($password);
	
	 echo("Login: $login <br/>");
	 echo("Password: $password <br/>");
 
	 if ($result = @$connection->query(
	 sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'",
	 mysqli_real_escape_string($connection, $login),
	 mysqli_real_escape_string($connection, $password))))
	 {
		$howmany = $result->num_rows;
		if($howmany > 0)
		{
			$_SESSION['loggedin'] = true;
			
			$user = $result->fetch_assoc();
			$_SESSION['login'] = $user['login'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['firstname'] = $user['firstname'];
			$_SESSION['lastname'] = $user['lastname'];
			$_SESSION['email'] = $user['email'];
			
			unset($_SESSION['wronginput']);
			$result->free();
			header('Location: sukces.php');
			
		} else {
			
			$_SESSION['wronginput'] = '<span style="color:red">Wrong username or password.</span>';
			header('Location: index.php');
		}
		
	 }
	 

 
	 $connection->close();
 }
 
 


?>