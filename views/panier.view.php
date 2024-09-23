<?php ob_start(); ?>

<?php
	if (!empty($_SESSION['panier'])) {
		$prixTotal = 0;
		echo "<h1>Panier :</h1>
		<section id='sectionPanier'>
			<table class='panier-table'>
			<tr><th>Burger</th><th></th><th>Quantité</th><th>Prix unitaire</th><th>Total</th><tr>";
			for ($i=0; $i < count($_SESSION['panier']); $i++) { 
				$prixUnitaire = $_SESSION['panier'][$i][3] * $_SESSION['panier'][$i][2];
				$prixTotal += $prixUnitaire;
				echo "<tr><td>{$_SESSION['panier'][$i][0]}</td><td><img width='100px' src='public/Img/burger/{$_SESSION['panier'][$i][1]}'></td><td><form method='POST' action='retirerArticle&val={$_SESSION['panier'][$i][0]}&op=minus'>
									<button type='submit'>-</button></form>{$_SESSION['panier'][$i][2]}<form method='POST' action='retirerArticle&val={$_SESSION['panier'][$i][0]}&op=plus'><button type='submit'>+</button></form><form method='POST' action='retirerArticle&val={$_SESSION['panier'][$i][0]}'><button type='submit'>X</button></form></td><td>{$_SESSION['panier'][$i][3]}</td><td>{$prixUnitaire}</td><tr>";
			}
			echo "<tr><td></td><td></td><td></td><td></td><td>{$prixTotal}</td><tr></table>
		</section>
		<div id='wrapperButton'><a href='viderPanier' id='viderPanierButton'>Vider le panier</a></div>";
	}else{
		echo "<h1>Panier Vide</h1>";
	}
?>



<?php
	$content = ob_get_clean();
	$title = "BA : Panier";
	require("template.php");

?>