<?php
	
	class GestionBDD{

		private $connexion;
		
		public function __construct(){
			try {
				$this->connexion = new PDO('mysql:host=localhost;dbname=bdd_burger','root','root');
			}
			catch(PDOException $exception){
				print "Erreur ! : ".$exception->getMessage()."<br/>";
				die();
			}
		}

		public function getBurgers(){
			$requete = "select * from t_burger";
			$stmt = $this->connexion->prepare($requete);
			$stmt->execute();
			$tableauBurgers = array();
			foreach ($stmt as $enregistrement) {
				$tableauBurgers[] = [$enregistrement['id_burger'],$enregistrement['nom_burger'],$enregistrement['description'],$enregistrement['chemin_image'],$enregistrement['prix']];
			}
			return $tableauBurgers;
		}

		public function verifIdentifiant($login, $mdp){
			$requete = "SELECT login, mdp FROM T_client WHERE login=?";
			$stmt = $this->connexion->prepare($requete);
			$stmt->bindParam(1, $login);
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			if (count($resultat) > 0) {
				if (password_verify($mdp, $resultat[0]['mdp'])) {
					if (password_verify("adminadmin", $resultat[0]['mdp']) and ($login == "admin89")) {
						$_SESSION['isAdmin'] = true;
					}
					return true;
				}
			}
			else{
				return false;
			}
		}

		public function verifLogin($login){
			$requete = "SELECT login, mdp FROM T_client WHERE login=?";
			$stmt = $this->connexion->prepare($requete);
			$stmt->bindParam(1, $login);
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			if (count($resultat) > 0) {
				return true;
			}
			else{
				return false;
			}
		}

		public function inscrire($nom, $prenom, $mail, $login, $mdp) {
			if ($this->verifLogin($login) == false) {
				$mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
			    $requete = "INSERT INTO T_client (nom_client, prenom_client, email_client, login, mdp) VALUES (?, ?, ?, ?, ?)";
			    $stmt = $this->connexion->prepare($requete);
			    $stmt->bindParam(1, $nom);
			    $stmt->bindParam(2, $prenom);
			    $stmt->bindParam(3, $mail);
			    $stmt->bindParam(4, $login);
			    $stmt->bindParam(5, $mdpHash);
			    $stmt->execute();
			    return true;
			}else{
				return false;
			}
		}

	}