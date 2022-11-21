<?php
// CRUD thematique
// ETUD

require_once $_SERVER['DOCUMENT_ROOT'] .  '/connect/database.php';

class thematique{
	function get_1thematique($numThem){
		global $db;
		$query = "SELECT * FROM thematique WHERE numThem = ?";
		$result = $db->prepare($query);
		$result->execute([$numThem]);
		return($result->fetch());
	}

	function get_1thematiqueByLang($numThem){
		global $db;

		// $query = "SELECT * FROM langue WHERE numPays = ?;";
		$query = "SELECT lib1Lang FROM langue INNER JOIN thematique ON langue.numLang = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numThem]);
		return($result->fetch());
	}

	function get_Allthematiques(){
		global $db;

		// select
		$query = 'SELECT * FROM thematique;';
		// prepare
		$result = $db->query($query);
		// execute
		$allthematiques = $result->fetchAll();
		
		return($allthematiques);
	}

	function get_AllthematiquesByLang($numLang){
		global $db;

		$query = 'SELECT * FROM `thematique` INNER JOIN langue ON langue.numLang = thematique.numLang WHERE thematique.numLang = ?;';
		$result = $db->prepare($query);
		$result->execute([$numLang]);

		return($result->fetchAll());
	}

	function get_NbAllthematiquesBynumLang($numLang){
		global $db;

		// select
		// prepare
		// execute
		// return($allNbthematiquesBynumLang);
	}

	// Récup dernière PK NumThem
	function getNextNumThem($numLang) {
		global $db;
	
		// Découpage FK langue
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM thematique WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans thematique
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numThem) AS numThem FROM thematique;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				$numThemSelect = (int)substr($numThem, 4, 2);
				// No séquence suivant langue
				$numSeq1Them = $numThemSelect + 1;
				// Init no séquence thematique pour nouvelle lang
				$numSeq2Them = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numThem) AS numThem FROM thematique WHERE numLang LIKE '$parmNumLang' ;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				// No séquence actuel langue
				$numSeq1Them = (int)substr($numThem, 4, 2);
				// No séquence actuel langue
				$numSeq2Them = (int)substr($numThem, 6, 2);
				// No séquence suivant thematique
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
		}   // End of if ($result) / no seq langue
		return $numThem;
	} // End of function

	function create($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO thematique (numThem, libThem, numLang) VALUES (?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
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
			die('Erreur insert statut : ' . $e->getMessage());
		}
	}

	function update($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE thematique SET libThem = ?, numLang = ? WHERE numThem = ? ;";
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
			die('Erreur update statut : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur thematique, angle, motcle avec del
	function delete($numThem){
		global $db;
		
		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM thematique WHERE numThem=?'; 
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
			die('Erreur delete statut : ' . $e->getMessage());
		}
	}
}		// End of class
