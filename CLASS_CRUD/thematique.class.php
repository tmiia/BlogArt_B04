<?php
// CRUD THEMATIQUE
// ETUD
require_once ROOT . '/CONNECT/database.php';

class THEMATIQUE{
	function get_1Thematique($numThem){
		global $db;
		$query = "SELECT * FROM THEMATIQUE WHERE numThem = ?";
		$result = $db->prepare($query);
		$result->execute([$numThem]);
		return($result->fetch());
	}

	function get_1ThematiqueByLang($numThem){
		global $db;

		// $query = "SELECT * FROM LANGUE WHERE numPays = ?;";
		$query = "SELECT lib1Lang FROM LANGUE INNER JOIN THEMATIQUE ON LANGUE.numLang = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numThem]);
		return($result->fetch());
	}

	function get_AllThematiques(){
		global $db;

		// select
		$query = 'SELECT * FROM THEMATIQUE;';
		// prepare
		$result = $db->query($query);
		// execute
		$allThematiques = $result->fetchAll();
		
		return($allThematiques);
	}

	function get_AllThematiquesByLang($numLang){
		global $db;

		$query = 'SELECT * FROM `THEMATIQUE` INNER JOIN LANGUE ON LANGUE.numLang = THEMATIQUE.numLang WHERE THEMATIQUE.numLang = ?;';
		$result = $db->prepare($query);
		$result->execute([$numLang]);

		return($result->fetchAll());
	}

	function get_NbAllThematiquesBynumLang($numLang){
		global $db;

		// select
		// prepare
		// execute
		// return($allNbThematiquesBynumLang);
	}

	// Récup dernière PK NumThem
	function getNextNumThem($numLang) {
		global $db;
	
		// Découpage FK LANGUE
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM THEMATIQUE WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans THEMATIQUE
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numThem) AS numThem FROM THEMATIQUE;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				$numThemSelect = (int)substr($numThem, 4, 2);
				// No séquence suivant LANGUE
				$numSeq1Them = $numThemSelect + 1;
				// Init no séquence THEMATIQUE pour nouvelle lang
				$numSeq2Them = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numThem) AS numThem FROM THEMATIQUE WHERE numLang LIKE '$parmNumLang' ;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				// No séquence actuel LANGUE
				$numSeq1Them = (int)substr($numThem, 4, 2);
				// No séquence actuel LANGUE
				$numSeq2Them = (int)substr($numThem, 6, 2);
				// No séquence suivant THEMATIQUE
				$numSeq2Them++;
			}
	
			$libThemSelect = "THEM";
			// PK reconstituée : THE + no seq langue
			if ($numSeq1Them < 10) {
				$numThem = $libThemSelect . "0" . $numSeq1Them;
			} else {
				$numThem = $libThemSelect . $numSeq1Them;
			}
			// PK reconstituée : THE + no seq langue + no seq thématique
			if ($numSeq2Them < 10) {
				$numThem = $numThem . "0" . $numSeq2Them;
			} else {
				$numThem = $numThem . $numSeq2Them;
			}
		}   // End of if ($result) / no seq LANGUE
		return $numThem;
	} // End of function

	function create($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO THEMATIQUE (numThem, libThem, numLang) VALUES (?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
			// prepare
			$request = $db->prepare($query);
			$request->execute([$numThem, $libThem, $numLang]);
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

	function update($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE THEMATIQUE SET libThem = ?, numLang = ? WHERE numThem = ? ;";
			// prepare
            $request = $db->prepare($query);
            // execute
            $request->execute([$libThem, $numLang, $numThem]);

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
	function delete($numThem){
		global $db;
		
		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM THEMATIQUE WHERE numThem=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numThem]);

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
}		// End of class
