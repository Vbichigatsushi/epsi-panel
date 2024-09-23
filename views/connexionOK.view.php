<?php ob_start(); ?>

<h1>Connexion reussi !</h1>

<?php
	$content = ob_get_clean();
	$title = "BA : Connexion Réussi";
	require("template.php");

?>