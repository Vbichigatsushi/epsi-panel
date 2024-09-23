<?php ob_start(); ?>

<h1>Panneau d'administration</h1>

<?php
	$content = ob_get_clean();
	$title = "BA : Connexion";
	require("template.php");

?>