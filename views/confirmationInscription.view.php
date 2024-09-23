<?php ob_start(); ?>

<h1>Félicitations, vous etes inscrit</h1>
<p>Vous pouvez maintenant vous connecter</p>

<?php
	$content = ob_get_clean();
	$title = "BA : Connexion";
	require("template.php");
?>