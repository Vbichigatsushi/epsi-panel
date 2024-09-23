<?php ob_start(); ?>

<h1>inscription echoué</h1>

<?php
	$content = ob_get_clean();
	$title = "BA : inscription";
	require("template.php");

?>