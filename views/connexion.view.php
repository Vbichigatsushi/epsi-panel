<?php ob_start(); ?>

<h1>Se connecter</h1>
<div id="container2">
	<article id="articleForm">
		<form class='formulaireStandard' method="POST" action="connexion">
			<label for="login">Nom d'utilisateur :</label>
			<input type="text" name="login" id="login" autocomplete="off">
			<label for="mdp">Mot de passe :</label>
			<input type="password" name="mdp" id="mdp">
			<input type="submit" value="Se connecter">
		</form>
		<a href="inscription">créér un compte</a>
	</article>
</div>
<?php
	$content = ob_get_clean();
	$title = "BA : Connexion";
	require("template.php");

?>