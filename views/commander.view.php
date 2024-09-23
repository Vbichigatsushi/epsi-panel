<?php ob_start(); ?>

<h1>Choisissez vos burgers</h1>
<h2>Des Burgers pour les grands et les petits</h2>

<div id="container">
<?php

	for ($i=0; $i < count($this->tableauBurgersRecup); $i++) { 
		echo "<article id='articleBurger'><img class='burgerImg' src='public/Img/burger/".$this->tableauBurgersRecup[$i][3]."'>
		<h2 class='burgerName'>".$this->tableauBurgersRecup[$i][1]."</h2>
		<div class='prix'>".$this->tableauBurgersRecup[$i][4]." €</div>
		<p class='descBurger'>".$this->tableauBurgersRecup[$i][2]."</p>
		<form method='POST' action='ajouterPanier&nom={$this->tableauBurgersRecup[$i][1]}&prix={$this->tableauBurgersRecup[$i][4]}&chemin={$this->tableauBurgersRecup[$i][3]}'>
		<input type='number' min='0' max='25' name='nbreBurger'>
		<input type='submit' value='ajouter au panier' id='valider'>
		</form></article>";	
	}
?>
</div>

<?php
	$content = ob_get_clean();
	$title = "BA : Commander";
	require("template.php");

?>