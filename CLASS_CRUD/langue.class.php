<?php
// CRUD LANGUE
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE{
	function get_1Langue($numLang){
		global $db;

		$query = "SELECT * FROM LANGUE WHERE numLang = ?;";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numLang]);
		return($result->fetch());
	}

	function get_1LangueByPays($numPays){
		global $db;

		// $query = "SELECT * FROM LANGUE WHERE numPays = ?;";
		$query = "SELECT frPays FROM PAYS INNER JOIN LANGUE ON PAYS.numPays = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numPays]);
		return($result->fetch());
	}

	function get_AllLangues(){
		global $db;

		// select
		$query = "SELECT * FROM LANGUE;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLangues = $result->fetchAll();
		return($allLangues);
	}

	function get_AllLanguesByPays(){
		global $db;

		// select
		$query = "SELECT frPays FROM PAYS INNER JOIN LANGUE ON PAYS.numPays = LANGUE.numPays;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByPays = $result->fetchAll();
		return($allLanguesByPays);
	}

	function get_AllLanguesByLib1Lang(){
		global $db;

		// select
		$query = "SELECT * FROM LANGUE WHERE lib1Lang = ?;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByLib1Lang = $result->fetchAll();
		return($allLanguesByLib1Lang);
	}

	function get_AllPays(){
        global $db;

        $query = 'SELECT * FROM PAYS;';
        $result = $db->query($query);
        $allPays = $result->fetchAll();
        return($allPays);
    }

	// Récup dernière PK NumLang
	function getNextNumLang($numPays) {
		global $db;
	
		// Les 4 premiers caractères de la PK concernent le pays
		// les 4 suivants représentent un numéro de séquence
		// Récup dernière PK utilisée pour le pays concerné
		$numPaysSelect = $numPays;  // exemple : 'CHIN'
		$parmNumLang = $numPaysSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM LANGUE WHERE numLang LIKE '$parmNumLang';";
	
		$result = $db->query($requete);
	
		$numSeqLang = 0;
		if ($result) {
			// Récup résultat requête
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {
				$numLang = 0;
				$strLang = $numPaysSelect;
			} else {
				// Récup dernière PK attribuée
				$numLang = $tuple["numLang"];
				$strLang = substr($numLang, 0, 4);
				$numSeqLang = (int)substr($numLang, 4);
			}
			$numSeqLang++;
	
			// PK reconstituée
			if ($numSeqLang < 10) {
				$numLang = $strLang . "0" . $numSeqLang;
			} else {
				$numLang = $strLang . $numSeqLang;
			}
		}   // End of if ($result)
	
		return $numLang;
	} // End of function

	function create($numLang, $lib1Lang, $lib2Lang, $numPays){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO LANGUE (lib1Lang) VALUES (?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
			// prepare
			$request = $db->prepare($query);
			$request->execute([$numLang, $lib1Lang, $lib2Lang, $numPays]);
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

	function update($numLang, $lib1Lang, $lib2Lang, $numPays){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE STATUT SET lib1Lang = ? WHERE numLang = $numLang;";
			// prepare
            $request = $db->prepare($query);
            // execute
            $request->execute([$numLang, $lib1Lang, $lib2Lang, $numPays]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM STATUT WHERE numLang=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numLang]);

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
}	// End of class
