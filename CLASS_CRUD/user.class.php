<?php
// CRUD user
// ETUD
require_once $_SERVER['DOCUMENT_ROOT'] . '/connect/database.php';

class user{
	function get_1User($pseudoUser){
		global $db;

		$query = "SELECT * FROM user WHERE pseudoUser = ?;";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$pseudoUser]);
		return($result->fetch());
	}

	function get_AllUsers(){
		global $db;

		$requete = "SELECT * FROM user";
		$result = $db->query($requete);

		$allUsers = $result->fetchAll(); // ON MET TOUS LES RESULTATS DANS UNE VARIABLE
		return($allUsers);
	}

	// Inutile car la PK (pseudo, pass) est forcément unique
	function get_ExistPseudo($pseudoUser) {
		global $db;

		$query = 'SELECT * FROM user WHERE pseudoUser = ?;';
		$result = $db->prepare($query);
		$result->execute(array($pseudoUser));
		return($result->rowCount());
	}

	function get_PassByUser($pseudoUser) {
		global $db;

		$query = 'SELECT passUser FROM user WHERE pseudoUser = ?;';
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

		$query = "SELECT COUNT(*) FROM user WHERE idStat = ?;";
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
			$query = 'INSERT INTO user (pseudoUser, passUser, nomUser, prenomUser, emailUser, idStat) VALUES (?, ?, ?, ?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
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
			die('Erreur insert user : ' . $e->getMessage());
		}
	}

	function update($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat){
		global $db;

		try {
            $db->beginTransaction();
            
            if ($passUser == -1) { //request 1: le mdp n'a pas été modifié
            // updateUser
			$query = 'UPDATE user SET pseudoUser= ?, passUser = ?, nomUser = ?, prenomUser = ?, emailUser = ?, idStat = ?';
			// prepare
			$request1 = $db->prepare($query);
			// execute
			$request1->execute([$pseudoUser, $passUser,  $nomUser, $prenomUser, $emailUser, $idStat,]);
                $db->commit();
                $request1->closeCursor();
            }
            else { //request 2: le mdp a été modifié
            // update
			$query = 'UPDATE user SET pseudoUser= ?, passUser = ?, nomUser = ?, prenomUser = ?, emailUser = ?, idStat = ?';
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
            die('Erreur update user : ' . $e->getMessage());
        }
	}

	function delete($pseudoUser){
		global $db;
		
		
        try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM user WHERE pseudoUser=?'; 
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
			die('Erreur delete user : ' . $e->getMessage());
		}
	}
}	// End of class
