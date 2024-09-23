<?php ob_start(); ?>

<h1>Connexion échoué !</h1>
<h2>verifier votre saisie</h2>

<?php
	$content = ob_get_clean();
	$title = "BA : Connexion Réussi";
	require("template.php");

?>