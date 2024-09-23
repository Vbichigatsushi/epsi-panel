<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="public/CSS/style.css">
		<title><?php echo $title; ?></title>
	</head>

	<body>
		<header>
			<img src="public/Img/logo2.png" width="300" height="auto" alt="Logo Burger Academy" id="Logo">
			<a href="afficherPanier">Panier</a>
			<?php
				if ((isset($_SESSION['user'])) and ($_SESSION['user'] != "")) {
					echo "<a href='deconnexion'>".$_SESSION['user']." - se deconnecter</a>";
				} else {
					echo "<a href='connexion'>se connecter</a>";
				}
			?>
		</header>
		<aside>
			<?php include("menus.php"); ?>
		</aside>

		<section>
			<?php echo $content; ?>
		</section>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>