<?php
session_start();
require_once "mailconfig.php";
require_once "connect.php";
ini_set('display_errors', '1');
if (empty($_POST['login']) && empty($_POST['email'])) {
	$_SESSION['error'] = "<center><span style='color:red'>Come on man, you've gotta enter at least one.</span></center>";
	unset($_SESSION['sukces']);
	header('Location: forgotpass.php');
}
$login = $_POST['login'];
$email = $_POST['email'];
$query = "SELECT * FROM users WHERE ";
if (!empty($_POST['login']))
{
	$query .= "login = '$login'";
	if (!empty($_POST['email']))
	{
			$query .= " AND email = '$email'";
	}
}
else
{
	$query .="email = '$email'";
}

$connection = new mysqli($host, $db_user, $db_password, $db_name);
$connection->query('SET NAMES utf8');
$connection->query('SET CHARACTER_SET utf8_unicode_ci');
if($connection->connect_errno!=0)
 {
	echo("Error: ".$connection->connect_errno .".");
 }
 else
 {	 
	 if ($result = @$connection->query($query))
	 {
		$howmany = $result->num_rows;
		if($howmany > 0)
		{
			$tab = $result->fetch_assoc();
			$address = $tab['email'];
			$login = $tab['login'];
			$password = $tab['password'];
			$body = "Hello, <br>
			You've received this e-mail because you've completed the forgotten password form. If you did NOT do that, please ignore this mail.<br>
			
			If you did, however, here's your login info, fella:<br><br>
			
			login: $login <br>
			password: $password <br><br>
			
			Best regards,<br>
			BAMFS shop =]:)";
			$mail->Subject = "Account password recovery";
			$mail->Body = $body;
			$mail->AddAddress($address);
			$mail->Headers = "Content-type: text/html; charset=\"UTF-8\"; format=flowed \r\n";
			 if(!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
				$result->free();
			 } else {
				$result->free();
				unset($_SESSION['error']);
				$_SESSION['sukces'] = "<center><span style='color:green'>The password recovery mail has been sent =]:)</span></center>";
				header('Location: forgotpass.php');
			 }
			
			
		} else {
			
			$_SESSION['error'] = "<center><span style='color:red'>Ain't no user like that, fella.</span></center>";
			unset($_SESSION['sukces']);
			header('Location: forgotpass.php');
		}
	 }
	 $connection->close();
 }
?>