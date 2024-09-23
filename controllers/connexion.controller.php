<?php

 	class ConnexionController{
 	
	 	public function __construct(){}

	 	public function afficherVue(){
	 		require("views/connexion.view.php");
	 		
	 	}

	 	public function traitementConnexion(){
	 		/*
			- verifier le couple login mdp avec la bdd
			- si oui => afficher une vue de confirmation et creer une session
						changer le menu se connecter en se deconnecter
			  sinon => afficher message erreur d'identifiant
	 		*/

			//verif de l'existance du couple login/mdp
			require("models/gestionBDD.model.php");
	 		$gestionBDD = new GestionBDD();
	 		if ($gestionBDD->verifIdentifiant(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mdp']))) {
	 			$_SESSION['user'] = htmlspecialchars($_POST['login']);
	 			require("views/connexionOK.view.php");
	 		}else{
	 			require("views/connexionNotOK.view.php");
	 		}
	 	}

	 	public function traitementDeconnexion(){
	 		session_unset();
	 		session_destroy();
	 		require("views/confirmDeconnexion.view.php");
	 	}
	}