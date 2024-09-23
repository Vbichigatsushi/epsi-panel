<?php ob_start(); ?>

<h1>S'inscrire</h1>
<div id="container2">
	<article id="articleForm">
		<form class='formulaireStandard' method="POST" action="index.php?page=traitementInscription">
			<label for="nom">Nom :</label>
			<input type="text" name="nom" id="nom" required>
			<label for="prenom">Prénom :</label>
			<input type="text" name="prenom" id="prenom" required>
			<label for="mail">Mail :</label>
			<input type="mail" name="mail" id="mail" required pattern="^[A-Za-z0-9]+@{1}[A-Za-z]+\.{1}.*[A-Za-z]">
			<label for="login">Nom d'utilisateur :</label>
			<input type="text" name="login" id="login" autocomplete="off" required>
			<label for="mdp">Mot de passe :</label>
			<input type="password" name="mdp" id="mdp" autocomplete="off" placeholder="entre 8 et 20 characteres" required pattern="^[A-Za-z0-9]{8,20}">
			<input type="submit" value="S'inscrire">
		</form>
		<a href="connexion">Se connecter</a>
	</article>
</div>
<?php
	$content = ob_get_clean();
	$title = "BA : Connexion";
	require("template.php");

?>