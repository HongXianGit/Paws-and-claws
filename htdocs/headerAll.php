<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <?php
    	$fileName = pathinfo($_SERVER["SCRIPT_NAME"], PATHINFO_FILENAME);
			if($fileName === "about"){
				echo "<title>Paws & Claws | About</title>";
			}elseif($fileName === "cart"){
				echo "<title>Paws & Claws | Cart</title>";
			}elseif($fileName === "cat"){
				echo "<title>Paws & Claws | Cat</title>";
			}elseif($fileName === "dog"){
				echo "<title>Paws & Claws | Dog</title>";
			}elseif($fileName === "index"){
				echo "<title>Paws & Claws | Home</title>";
			}elseif($fileName === "news"){
				echo "<title>Paws & Claws | News</title>";
			}elseif($fileName === "news1"){
				echo "<title>Paws & Claws |  Animal shelters running out of space, food</title>";
			}elseif($fileName === "news2"){
				echo "<title>Paws & Claws | In the doghouse: Ipoh NGO struggling to build shelter for stray dog population</title>";
			}elseif($fileName === "news3"){
				echo "<title>Paws & Claws | Lam Thye: Be compassionate to animals</title>";
			}elseif($fileName === "products"){
				echo "<title>Paws & Claws | Products</title>";
			}
		?>
		<meta charset="utf-8">
		<?php
			if($fileName === "news1" || $fileName === "news2" || $fileName === "news3" || $fileName === "cat" || $fileName === "dog"){
				echo '<link rel="stylesheet" type="text/css" href="../css/style.css">';
			}else{
				echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
			}
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Roboto:wght@300;500&family=Source+Sans+Pro&display=swap" rel="stylesheet">
		<?php
		if($fileName === "cat" || $fileName === "dog"){
			echo '<script src="../js/addcart.js" defer></script>';
		}elseif($fileName === "index"){
			echo '<script src="js/addcart.js" defer></script>';
		}elseif($fileName === "cart"){
			echo '<script src="js/editcart.js" defer></script>';
		}

		if($fileName === "news1" || $fileName === "news2" || $fileName === "news3" || $fileName === "cat" || $fileName === "dog"){
			echo '</head>
			<body>
				<header>
					<nav class="container">
			      <a href="../index.php"><img src="../img/Logo.svg" alt="Logo"></a>
			      <a href="../index.php"><h1>Paws<br>&Claws</h1></a>
			      <ul class="unordered">
			        <li><a href="../index.php">Home</a></li>';
							if($fileName === "cat" || $fileName === "dog"){
							  echo  '<li id="nav-products"><a href="../Products.php" id="products">Products</a>';
							}else{
								echo  '<li id="nav-products"><a href="../Products.php">Products</a>';
							}
							echo	'<div class="submenu">
									<ul class="list">
			              <li id="cat"><a href="../products/cat.php">Cat&emsp;></a></li>
										<li><a href="../products/dog.php">Dog&emsp;></a></li>
									</ul>
								</div>
							</li>';
							if($fileName === "news1" || $fileName === "news2" || $fileName === "news3"){
							  echo  '<li><a href="../news.php" id="news">News</a></li>';
							}else{
								echo  '<li><a href="../news.php">News</a></li>';
							}
			      echo  '<li><a href="../about.php">About</a></li>
			      </ul>
						<a href="../cart.php"><img src="../img/fast_cart.png" class="fast-cart"></a>';
							if(isset($_SESSION["userId"])){
								echo '<form action="../includes/logout.inc.php" method="POST">
									<button class="button" name="logout-submit">LOGOUT</button>
								</form>';
							}else{
								echo '<form action="../login.php" method="POST">
									<button class="button">LOGIN</button>
								</form>';
							}
		echo	'</nav>
			</header>';
		}else{
		echo	'</head>
			<body>
				<header>
					<nav class="container">
						<a href="index.php"><img src="img/Logo.svg" alt="Logo"></a>
						<a href="index.php"><h1>Paws<br>&Claws</h1></a>
						<ul class="unordered">';
						if($fileName === "index"){
							echo '<li><a href="index.php" id="home">Home</a></li>';
						}else{
							echo '<li><a href="index.php">Home</a></li>';
						}

						if($fileName === "products" || $fileName === "Products"){
							echo '<li id="nav-products"><a href="Products.php" id="products">Products</a>';
						}else{
							echo '<li id="nav-products"><a href="Products.php">Products</a>';
						}
						echo '<div class="submenu">
									<ul class="list">
										<li id="cat"><a href="products/cat.php">Cat&emsp;></a></li>
										<li><a href="products/dog.php">Dog&emsp;></a></li>
									</ul>
								</div>
							</li>';
						if($fileName === "news"){
							echo '<li><a href="news.php" id="news">News</a></li>';
						}else{
							echo '<li><a href="news.php">News</a></li>';
						}
						if($fileName === "about"){
							echo '<li><a href="about.php" id="about">About</a></li>';
						}else{
							echo '<li><a href="about.php">About</a></li>';
						}
						echo '</ul>
						<a href="cart.php"><img src="img/fast_cart.png" class="fast-cart"></a>';
						if(isset($_SESSION["userId"])){
							echo '<form action="includes/logout.inc.php" method="POST">
								<button class="button" name="logout-submit">LOGOUT</button>
							</form>';
						}else{
							echo '<form action="login.php" method="POST">
								<button class="button">LOGIN</button>
							</form>';
						}
		echo	'</nav>
				</header>';
		}
		?>
