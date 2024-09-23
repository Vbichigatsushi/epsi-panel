<?php
	
	class Panier {
		
		public function __construct(){
			if (!isset($_SESSION['panier'])) {
				$_SESSION['panier'] = array();
			}
		}

		public function getPanier() {
			return $_SESSION['panier'];
		}

		public function addArticle($nomArticle, $imageArticle, $quantite, $prix){
			$indice = -1;
			for ($i = 0; $i < count($_SESSION['panier']); $i++) { 
		        if ($_SESSION['panier'][$i][0] == $nomArticle) {
		            $indice = $i;
		            break;
		        }
		    }
			if ($indice != -1) {
				$_SESSION['panier'][$indice][2]+=$quantite;
			}else{
				$_SESSION['panier'][] = [$nomArticle, $imageArticle, $quantite, $prix];
			}
		}

		public function deleteArticle($nomArticle) {
		    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
		        $indice = $_SESSION['panier'][$i];
		        
		        if (in_array($nomArticle, $indice)) {
		            unset($_SESSION['panier'][$i]);
		            break;
		        }
		    }
		    $_SESSION['panier'] = array_values($_SESSION['panier']);
		}



		public function viderPanier(){
			unset($_SESSION['panier']);
		}
	}