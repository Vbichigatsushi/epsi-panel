<?php ob_start(); ?>

<h1>vous etes deconnecté !</h1>

<?php
	$content = ob_get_clean();
	$title = "BA : Deconnexion";
	require("template.php");

?>