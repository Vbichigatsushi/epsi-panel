<?php ob_start(); ?>

<h1>Bienvenue à la Burger Academy !</h1>
<h2>Des Burgers pour toutes les envies</h2>


<?php
	$content = ob_get_clean();
	$title = "BA : Accueil";
	require("template.php")

?>