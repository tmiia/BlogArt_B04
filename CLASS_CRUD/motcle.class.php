<?php
// CRUD motcle
// ETUD
require_once ROOT . '../../connect/database.php';

class motcle{
	function get_1MotCle($numMotCle){
		global $db;
		$query = "SELECT * FROM motcle WHERE numMotCle = ?";
		$result = $db->prepare($query);
		$result->execute([$numMotCle]);
		return($result->fetch());
	}

	function get_1MotCleByLang($numMotCle){
		global $db;

		// $query = "SELECT * FROM langue WHERE numPays = ?;";
		$query = "SELECT lib1Lang FROM langue INNER JOIN motcle ON langue.numLang = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMotCle]);
		return($result->fetch());
	}

	function get_AllMotCles(){
		global $db;

		// select
		$query = 'SELECT * FROM motcle;';
		// prepare
		$result = $db->query($query);
		// execute
		$allMotCles = $result->fetchAll();
		
		return($allMotCles);
	}

	function get_AllMotsClesByLang(){
		global $db;

		// select
		// prepare
		// execute
		return($allMotsClesByLang);
	}

	function get_NbAllMotsClesBynumLang($numLang){
		global $db;

        // select
        $sql = "SELECT * FROM motcle WHERE numLang = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numLang]);

        $NbAllMotsClesBynumLang = $req->rowCount();
 
		return($NbAllMotsClesBynumLang);
	}

	// Sortir mots clés déjà sélectionnés dans motcle (TJ) dans article
	// ppour le drag and drop
	function get_MotsClesNotSelect($listNumMotcles) {
		global $db;

		/*
		Pour numArt = 1 :
		SELECT numMotCle, libMotCle FROM motcle WHERE numMotCle NOT IN (1, 6, 8, 9, 10, 11, 12, 13);
		*/
		// Recherche mot clé (INNER JOIN) dans tables motclearticle
		$textQuery = 'SELECT numMotCle, libMotCle FROM motcle WHERE numMotCle NOT IN (' . $listNumMotcles . ');';
		$result = $db->prepare($textQuery);
		$result->execute([$listNumMotcles]);
		$allMotsClesNotSelect = $result->fetchAll();
		return($allMotsClesNotSelect);
	}

	// Récupérer next PK de la table motcle
	function getNextNumMoCle($numLang) {
		global $db;
	
		// Découpage FK langue
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM motcle WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans motcle
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numMoCle) AS numMoCle FROM motcle;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numMoCle = $tuple["numMoCle"];
	
				$numMoCleSelect = (int)substr($numMoCle, 4, 2);
				// No séquence suivant langue
				$numSeq1MoCle = $numMoCleSelect + 1;
				// Init no séquence motcle pour nouvelle lang
				$numSeq2MoCle = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numMoCle) AS numMoCle FROM motcle WHERE numLang LIKE '$parmNumLang';";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numMoCle = $tuple["numMoCle"];
	
				// No séquence actuel langue
				$numSeq1MoCle = (int)substr($numMoCle, 4, 2);
				// No séquence actuel motcle
				$numSeq2MoCle = (int)substr($numMoCle, 6, 2);
				// No séquence suivant motcle
				$numSeq2MoCle++;
			}
	
			$libMoCleSelect = "MTCL";
			// PK reconstituée : MTCL + no seq langue
			if ($numSeq1MoCle < 10) {
				$numMoCle = $libMoCleSelect . "0" . $numSeq1MoCle;
			} else {
				$numMoCle = $libMoCleSelect . $numSeq1MoCle;
			}
			// PK reconstituée : MOCL + no seq langue + no seq mot clé
			if ($numSeq2MoCle < 10) {
				$numMoCle = $numMoCle . "0" . $numSeq2MoCle;
			} else {
				$numMoCle = $numMoCle . $numSeq2MoCle;
			}
		}   // End of if ($result) / no seq langue
		return $numMoCle;
	} // End of function

	function create($libMotCle, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO motcle (libMotCle, numLang) VALUES (?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à libStat
			// prepare
			$request = $db->prepare($query);
			$request->execute([$libMotCle, $numLang]);
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

	function update($numMotCle, $libMotCle, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE motcle SET libMotCle = ?, numLang = ? WHERE numMotCle = ? ;";
			// prepare
            $request = $db->prepare($query);
            // execute
            $request->execute([$libMotCle, $numLang, $numMotCle]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update statut : ' . $e->getMessage());
		}
	}

	function delete($numMotCle){
		global $db;
		
		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM motcle WHERE numMotCle=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numMotCle]);

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
}	// End of class
