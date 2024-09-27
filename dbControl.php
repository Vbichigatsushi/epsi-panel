<?php
	
	class Db{

		private $connexion;
		
		public function __construct(){
			try {
				$this->connexion = new PDO('mysql:host=10.5.0.4:1003;dbname=EpsiPanel','pma-admin','MotdePasseComplexe2');
			}
			catch(PDOException $exception){
				print "Erreur ! : ".$exception->getMessage()."<br/>";
				die();
			}
		}

		public function getCafeteriaCount(){
			$requete = "SELECT (SELECT count(*) FROM cafeteria WHERE localisation='entry')-(SELECT count(*) FROM cafeteria WHERE localisation='exit') as 'countCafeteria';";
			$stmt = $this->connexion->prepare($requete);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC)['countCafeteria'];
		}

		public function getTickets(){
			$requete = "SELECT u.pseudo, e.description, e.date_created, l.name FROM event e INNER JOIN localisation l ON l.localisation_id=e.localisation_id INNER JOIN Users u ON u.user_id=e.user_id;";
			$stmt = $this->connexion->prepare($requete);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function controlLogin($login){
			$requete = "SELECT pseudo, password FROM Users WHERE pseudo=?";
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

		public function insertTicket($title, $description, $coordx, $coordy, $localisation){
			date_default_timezone_set('Europe/Paris');
			$creationDate = date('Y-m-d H:i:s');
			$idUser = 1;
		    $requete = "INSERT INTO event (date_created, titre, description, localisation_id, user_id, coordx, coordy) VALUES (?, ?, ?, ?, ?, ?, ?)";
		    $stmt = $this->connexion->prepare($requete);
		    $stmt->bindParam(1, $creationDate);
		    $stmt->bindParam(2, $title);
		    $stmt->bindParam(3, $description);
		    $stmt->bindParam(4, $localisation);
		    $stmt->bindParam(5, $idUser);
		    $stmt->bindParam(6, $coordx);
		    $stmt->bindParam(7, $coordy);
		    $stmt->execute();
		    return true;
		}

		public function getMarkers(){
			$requete = "SELECT date_created,description,titre,coordx,coordy FROM event";
			$stmt = $this->connexion->prepare($requete);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function signIn($login, $prenom, $nom, $mail, $mdp, $isInactive=0) {
			if ($this->controlLogin($login) == false) {
				date_default_timezone_set('Europe/Paris');
				$creationDate = date('Y-m-d H:i:s');
				$mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
			    $requete = "INSERT INTO Users (pseudo, firstname, lastname, email, password, date_created, inactive_profil) VALUES (?, ?, ?, ?, ?, ?, ?)";
			    $stmt = $this->connexion->prepare($requete);
			    $stmt->bindParam(1, $login);
			    $stmt->bindParam(2, $prenom);
			    $stmt->bindParam(3, $nom);
			    $stmt->bindParam(4, $mail);
			    $stmt->bindParam(5, $mdpHash);
			    $stmt->bindParam(6, $creationDate);
			    $stmt->bindParam(7, $isInactive);
			    $stmt->execute();
			    return true;
			}else{
				return false;
			}
		}
	}