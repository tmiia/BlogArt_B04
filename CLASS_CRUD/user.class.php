<?php
// CRUD USER
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class USER{
	function get_1User($pseudoUser){
		global $db;

		$query = "SELECT * FROM USER WHERE pseudoUser=?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$pseudoUser]);
		return($result->fetch());
	}

	function get_AllUsers(){
		global $db;

		$requete = "SELECT * FROM USER";
		$result = $db->query($requete);

		$allUsers = $result->fetchAll(); // ON MET TOUS LES RESULTATS DANS UNE VARIABLE
		return($allUsers);
	}

	// Inutile car la PK (pseudo, pass) est forcément unique
	function get_ExistPseudo($pseudoUser) {
		global $db;

		$query = 'SELECT * FROM USER WHERE pseudoUser = ?;';
		$result = $db->prepare($query);
		$result->execute(array($pseudoUser));
		return($result->rowCount());
	}

	function get_PassByUser($pseudoUser) {
		global $db;

		$query = 'SELECT passUser FROM USER WHERE pseudoUser = ?;';
		$request = $db->prepare($query);
		$request->execute([$pseudoUser]);
		$passUser = $request->fetch();
		return($passUser);
	}

	function get_AllUsersByStat(){
		global $db;

		// select
		// prepare
		// execute
		return($allUsersByStat);
	}

	function get_NbAllUsersByidStat($idStat){
		global $db;

		$query = "SELECT COUNT(*) FROM USER WHERE idStat = ?;";
		$request = $db->prepare($query);

		$request->execute([$idStat]);
		$allNbUsersByStat = $request->fetch();
		return($allNbUsersByStat);
	}

	function create($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO USER (pseudoUser, passUser, nomUser, prenomUser, emailUser, idStat) VALUES (?, ?, ?, ?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
			// prepare
			$request = $db->prepare($query);
			$request->execute([$pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert USER : ' . $e->getMessage());
		}
	}

	function update($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat){
		global $db;

		try {
            $db->beginTransaction();
            
            if ($passUser == -1) { //request 1: le mdp n'a pas été modifié
            // updateUser
			$query = 'UPDATE USER SET pseudoUser= ?, passUser = ?, nomUser = ?, prenomUser = ?, emailUser = ?, idStat = ?';
			// prepare
			$request1 = $db->prepare($query);
			// execute
			$request1->execute([$pseudoUser, $passUser,  $nomUser, $prenomUser, $emailUser, $idStat,]);
                $db->commit();
                $request1->closeCursor();
            }
            else { //request 2: le mdp a été modifié
            // update
			$query = 'UPDATE USER SET pseudoUser= ?, passUser = ?, nomUser = ?, prenomUser = ?, emailUser = ?, idStat = ?';
			// prepare
			$request2 = $db->prepare($query);
			// execute
			$request2->execute([$pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat,]);
                $db->commit();
                $request2->closeCursor();
            }
		}
		catch (PDOException $e) {
            $db->rollBack();
            if ($passUser == -1) {
                $request1->closeCursor();
            } else {
                $request2->closeCursor();
            }
            die('Erreur update USER : ' . $e->getMessage());
        }
	}

	function delete($pseudoUser){
		global $db;
		
		
        try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM USER WHERE pseudoUser=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$pseudoUser]);

			$count = $request->rowCount(); 
			$db->commit();
			$request->closeCursor();
			return($count); 
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete USER : ' . $e->getMessage());
		}
	}
}	// End of class
