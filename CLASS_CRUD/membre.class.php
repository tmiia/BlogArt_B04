<?php
// CRUD MEMBRE
// ETUD
// A tester sur Blog'Art
require_once ROOT . '/CONNECT/database.php';

class MEMBRE{
    function get_1Membre($numMemb){
        global $db;
		$query = "SELECT * FROM MEMBRE WHERE numMemb = ?";
		$result = $db->prepare($query);
		$result->execute([$numMemb]);
		return($result->fetch());
    }

    function get_1MembreByEmail($eMailMemb){
        global $db;

		$query = "SELECT * FROM MEMBRE WHERE eMailMemb = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$eMailMemb]);
		return($result->fetch());
    }

    function get_AllMembres(){
        global $db;

		// select
		$query = 'SELECT * FROM MEMBRE;';
		// prepare
		$result = $db->query($query);
		// execute
		$allMembres = $result->fetchAll();
		
        return($allMembres);
    }

    function get_ExistPseudo($pseudoMemb) {
        global $db;

        // select
        // prepare
        // execute
        // return($result->rowCount());
    }

    function get_AllMembersByStat(){
        global $db;

        // select
        $sql = "SELECT * FROM membre m INNER JOIN statut s ON m.idStat = s.idStat"; //peut etre pas ça
        // prepare
        $req = $db->query($sql);
        // execute
        $allMembersByStat = $req->fetchAll();
        return($allMembersByStat);
    }

    function get_NbAllMembersByidStat($idStat){
        global $db;

        // select
        $sql = "SELECT * FROM membre WHERE idStat = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$idStat]);

        $allNbMembersByStat = $req->rowCount();

        return($allNbMembersByStat);
    }

    function get_1MembrebyStatut($numMemb){
		global $db;

		// $query = "SELECT * FROM LANGUE WHERE numPays = ?;";
		$query = "SELECT libStat FROM STATUT INNER JOIN MEMBRE ON STATUT.idStat = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMemb]);
		return($result->fetch());
	}

    function get_AllMembresByEmail($eMailMemb){
        global $db;

        // select
        // prepare
        // execute
        // return($result->fetchAll());
    }

    // Inscription membre
    function create($prenomMemb, $nomMemb, $pseudoMemb, $passMemb, $eMailMemb, $accordMemb, $idStat){
        global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO MEMBRE (prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, idStat) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
			// prepare
			$request = $db->prepare($query);
			$request->execute([$prenomMemb, $nomMemb, $pseudoMemb, $passMemb, $eMailMemb, $accordMemb, $idStat]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();	// DANS LE CAS OU CA PLANTE ON ENVOIE UNE ERREUR
			$request->closeCursor();
			die('Erreur insert STATUT : ' . $e->getMessage());
		}
    }

    function update($prenomMemb, $nomMemb, $eMailMemb, $passMemb, $idStat, $numMemb){
        global $db;

        try {
            $db->beginTransaction();
            
            if ($passMemb == -1) { //request 1: le mdp n'a pas été modifié
            // update
			$query = 'UPDATE MEMBRE SET prenomMemb = ?, nomMemb = ?, eMailMemb = ?, passMemb = ?, idStat = ? WHERE numMemb = ?;';
			// prepare
			$request1 = $db->prepare($query);
			// execute
			$request1->execute([$prenomMemb, $nomMemb, $eMailMemb, $passMemb, $idStat, $numMemb]);
                $db->commit();
                $request1->closeCursor();
            }
            else { //request 2: le mdp a été modifié
            // update
			$query = 'UPDATE MEMBRE SET prenomMemb = ?, nomMemb = ?, passMemb = ?, eMailMemb = ?, idStat = ? WHERE numMemb = ?;';
			// prepare
			$request2 = $db->prepare($query);
			// execute
			$request2->execute([$prenomMemb, $nomMemb, $passMemb, $eMailMemb, $idStat, $numMemb]);
                $db->commit();
                $request2->closeCursor();
            }
        }

        catch (PDOException $e) {
            $db->rollBack();
            if ($passMemb == -1) {
                $request1->closeCursor();
            } else {
                $request2->closeCursor();
            }
            die('Erreur update MEMBRE : ' . $e->getMessage());
        }
    }

    // Ctrl FK sur COMMENT avec del
    function delete($numMemb){
        global $db;
        
        try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM MEMBRE WHERE numMemb=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numMemb]);

			$count = $request->rowCount(); 
			$db->commit();
			$request->closeCursor();
			return($count); 
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete STATUT : ' . $e->getMessage());
		}
    }
}    // End of class