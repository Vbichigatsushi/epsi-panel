<?php
	
	$data = json_decode(file_get_contents('php://input'), true); 
	if(!require("dbControl.php")){
		echo "problème lors de l'import de la classe BDD";
	}
	$Db = new Db();
	if ($Db->insertTicket($data['title'], $data['description'], $data['coordx'], $data['coordy'], $data['localisation'])) {
		echo json_encode(['success' => true, 'message' => 'Ticket enregistré avec succès']);
	}
	