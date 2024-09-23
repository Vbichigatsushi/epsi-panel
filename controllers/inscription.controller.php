<?php

 	class InscriptionController{
 	
	 	public function __construct(){}

	 	public function afficherVue(){
	 		require("views/inscription.view.php");
	 		
	 	}

	 	public function afficherVueConfirmation(){
	 		require("views/confirmationInscription.view.php");
	 		
	 	}

	 	public function afficherVueEchec(){
	 		require("views/echecInscription.view.php");
	 		
	 	}

	 	public function enregistrerInscription($nom, $prenom, $mail, $login, $mdp){
	 		require("models/gestionBDD.model.php");
	 		$bdd = new GestionBDD();
	 		if ($bdd->inscrire($nom, $prenom, $mail, $login, $mdp)) {
	 			$this->afficherVueConfirmation();
	 		}else{
	 			$this->afficherVueEchec();
	 		}


	 	}
	}
