<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			if(pathinfo($_SERVER["SCRIPT_NAME"], PATHINFO_FILENAME) === "login"){
				echo "<title>Paws & Claws | Login</title>";
			}else{
				echo "<title>Paws & Claws | Sign Up</title>";
			}
		?>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Roboto:wght@300;500&family=Source+Sans+Pro&display=swap" rel="stylesheet">
		<script src="js/signuplogin.js" defer></script>
	</head>

	<body class="bg">
	  <header>
			<nav class="container">
	      <a href="index.php"><img src="img/Logo.svg" alt="Logo"></a>
	      <a href="index.php"><h1>Paws<br>&Claws</h1></a>
				<form action="login.php" class="login-button">
	    		<button class="button">LOGIN</button>
				</form>
				<form action="signup.php">
					<button class="button">SIGN UP</button>
				</form>
			</nav>
	  </header>
