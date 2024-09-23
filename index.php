<?php
	session_start();
	
	if (empty($_GET['page'])){
		echo "<script>window.location = 'accueil'</script>";
	}
	else{
		switch ($_GET['page']) {
			case 'commander':
				require_once("controllers/commander.controller.php");
				$commanderController = new CommanderController();
				$commanderController->afficherVue();
				break;

			case 'ajouterPanier':
				require_once("controllers/panier.controller.php");
				$ajouterPanierController = new PanierController();
				$ajouterPanierController->ajouterArticle($_GET['nom'], $_GET['chemin'], $_POST['nbreBurger'], $_GET['prix']);
				require_once("controllers/commander.controller.php");
				$commanderController = new CommanderController();
				$commanderController->afficherVue();
				break;

			case 'afficherPanier':
				require_once("controllers/panier.controller.php");
				$ajouterPanierController = new PanierController();
				//$ajouterPanierController->();
				$ajouterPanierController->afficherVue();
				break;

			case 'retirerArticle':
				require_once("controllers/panier.controller.php");
				$ajouterPanierController = new PanierController();
				$ajouterPanierController->retirerArticle($_GET['val']);
				$ajouterPanierController->afficherVue();
				break;

			case 'viderPanier':
				require_once("controllers/panier.controller.php");
				$viderPanierController = new PanierController();
				$viderPanierController->viderPanier();
				$viderPanierController->afficherVue();
				break;

			case 'connexion':
				require_once("controllers/connexion.controller.php");
				$connexionController = new ConnexionController();
				if (isset($_POST['login'])) {
					$connexionController->traitementConnexion();
				}else{
					$connexionController->afficherVue();
				}
				break;

			case 'inscription':
				require_once("controllers/inscription.controller.php");
				$inscriptionController = new InscriptionController();
				$inscriptionController->afficherVue();
				break;

			case 'traitementInscription':
				require_once("controllers/inscription.controller.php");
				$inscriptionController = new InscriptionController();
				$inscriptionController->enregistrerInscription(htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['prenom']),htmlspecialchars($_POST['mail']),htmlspecialchars($_POST['login']),htmlspecialchars($_POST['mdp']));
				break;

			case 'deconnexion':
				require_once("controllers/connexion.controller.php");
				$connexionController = new ConnexionController();
				$connexionController->traitementDeconnexion();
				break;

			case 'administrer':
				if (!isset($_SESSION['isAdmin'])) {
					require_once("controllers/accueil.controller.php");
					$accueilController = new AccueilController();
					$accueilController->afficherVue();
				}
				else{
					require_once("controllers/administrer.controller.php");
					$administrerController = new AdministrerController();
					$administrerController->afficherVue();
				}
				break;
			
			default:
				require_once("controllers/accueil.controller.php");
				$accueilController = new AccueilController();
				$accueilController->afficherVue();
				break;
		}
	}