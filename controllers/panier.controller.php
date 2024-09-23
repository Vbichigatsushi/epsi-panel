<?php
	
	class PanierController{

		private $panier;
		
		public function __construct(){
			require_once("models/panier.model.php");
		 	$this->panier = new Panier();
		}

		public function ajouterArticle($nomArticle, $imageArticle, $quantite, $prix){
			if ($quantite != 0) {
				$this->panier->addArticle($nomArticle, $imageArticle, $quantite, $prix);
				echo '<script>alert("l\'article '.$nomArticle.' a bien été ajouté en '.$quantite.' exemplaires au panier")</script>';
			}
		}

		public function afficherVue(){
			require("views/panier.view.php");
		}

		public function viderPanier(){
			$this->panier->viderPanier();
		}

		public function retirerArticle($nomArticle){
			require_once("models/panier.model.php");
			$this->panier->deleteArticle($nomArticle);
		}
	}