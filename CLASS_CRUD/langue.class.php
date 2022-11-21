<?php
// CRUD langue
// ETUD
require_once $_SERVER['DOCUMENT_ROOT'] .  '../../connect/database.php';

class langue{
	function get_1Langue($numLang){
		global $db;

		$query = "SELECT * FROM langue WHERE numLang = ?;";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numLang]);
		return($result->fetch());
	}

	function get_1LangueByPays($numPays){ //pour récupérer la langue d'un pays
		global $db;

		// $query = "SELECT * FROM langue WHERE numPays = ?;";
		// var_dump($numPays);
		// exit;
		$query = 'SELECT frPays FROM pays INNER JOIN langue ON pays.numPays = langue.numPays WHERE langue.numLang = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numPays]);
		return($result->fetch());
	}

	function get_AllLangues(){
		global $db;

		// select
		$query = "SELECT * FROM langue;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLangues = $result->fetchAll();
		return($allLangues);
	}

	function get_AllLanguesByPays(){
		global $db;

		// select
		$query = "SELECT frPays FROM pays INNER JOIN langue ON pays.numPays = langue.numPays;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByPays = $result->fetchAll();
		return($allLanguesByPays);
	}

	function get_AllLanguesByLib1Lang(){
		global $db;

		// select
		$query = "SELECT * FROM langue WHERE lib1Lang = ?;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByLib1Lang = $result->fetchAll();
		return($allLanguesByLib1Lang);
	}

	function get_1LangueByThemarticle($numArt){
		global $db;

		$query = "SELECT lib1Lang FROM langue INNER JOIN thematique ON Langue.numLang = thematique.numLang INNER JOIN article ON thematique.numThem = article.numThem WHERE numArt = ?;";
		$result = $db->prepare($query);
		// execute
		$result->execute([$numArt]);
		return($result->fetch());
	}

	function get_AllPays(){
        global $db;

        $query = 'SELECT * FROM pays;';
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
	
		$requete = "SELECT MAX(numLang) AS numLang FROM langue WHERE numLang LIKE '$parmNumLang';";
	
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
			$query = 'INSERT INTO langue (numLang , lib1Lang, lib2Lang, numPays) VALUES (?, ?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à l
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
			die('Erreur insert statut : ' . $e->getMessage());
		}
	}

	function update($lib1Lang, $lib2Lang, $numPays, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = 'UPDATE langue SET lib1Lang = ?, lib2Lang = ?, numPays = ? WHERE numLang = ?;';
			// prepare
            $request = $db->prepare($query);
            // execute
            $request->execute([$lib1Lang, $lib2Lang, $numPays, $numLang]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update langue : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur thematique, angle, motcle avec del
	function delete($numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM langue WHERE numLang=?'; 
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
			die('Erreur delete langue : ' . $e->getMessage());
		}
	}
}	// End of class
