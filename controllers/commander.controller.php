<?php

 	class CommanderController{

 		private $tableauBurgersRecup;
 	
	 	public function __construct(){
	 		require("models/gestionBDD.model.php");
	 		$gestionBDD = new GestionBDD();
	 		$this->tableauBurgersRecup = $gestionBDD->getBurgers();
	 	}



	 	public function afficherVue(){
	 		require("views/commander.view.php");
	 	}
	}