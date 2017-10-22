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
        <meta charset=""utf-8">
              <title>LOG IN</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
    <body>
		
        <button onclick="document.getElementById('loginpopout').style.display='block'">Login</button>
		
		<?php
		if(isset($_SESSION['wronginput'])) {
			echo('<div id="loginpopout" class="modal2">');
		} else {echo('<div id="loginpopout" class="modal">');}
		?>	
		
        <form class="modal-content animate" action="trylogin.php" method="post">
			<span id="close" class="close">&times;</span>
			
			<center>
			<h2>YEEHAW</h2><hr>
			<table>
			<th>
			<img width="100%" src="https://github.com/drakar1903/Technologie-Aplikacji-Serwerowych/blob/master/Logo.png?raw=true"><br/>
			</th>
			<th>
			Yer login: <br/>
			<input type="text" name="login" placeholder="Enter your login" required><br/><br/>
			Yer pass: <br/>
			<input type="password" name="password" placeholder="Enter your password" required><br/><br/></br>
			<button type="submit">Log in, pardner</button> <br/><br/>
			<?php
				if (isset($_SESSION['wronginput'])){
				echo $_SESSION['wronginput'];}
			?>
			
			</th>
			<th style="padding:0">
			<br/><br/><br/><br/>
			<input type="checkbox" checked="unchecked"><small>Remember me</small></font><br/><br/><br/>
			
			<a href="#"><small>Forgot password?</small></a>
			
			</th>
			</table>
			</center>
		 </form>
		</div>
		 
	<script>
	var modal = document.getElementById('loginpopout');
	var btn = document.getElementById('close');
	
	btn.onclick = function() {
		modal.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	</script>
	
    </body>
</html>
