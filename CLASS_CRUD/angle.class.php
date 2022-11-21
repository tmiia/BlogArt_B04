<?php
// CRUD angle
// ETUD
require_once __DIR__ . '../../connect/database.php';

class angle{
	function get_1angle(string $numAngl) {
		global $db;

		// select
		$query = "SELECT * FROM angle WHERE numAngl = ?";
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
		return($result->fetch());
	}

	function get_1angleByLang(string $numAngl) {
		global $db;

		// select
		$query = 'SELECT libAngl FROM angle INNER JOIN langue ON langue.numLang = angle.numLang WHERE langue.numLang = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
		return($result->fetch());
	}
	
	function get_1LangByangle($numAngl){
		global $db;
		$query = 'SELECT * FROM langue INNER JOIN angle ON langue.numLang = angle.numLang WHERE numAngl = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
		return($result->fetch());

	}
	function get_Allangles() {
		global $db;

		// select
		$query = 'SELECT * FROM angle;';
		// prepare
		$result = $db->query($query);
		// execute
		$allangles = $result->fetchAll();
		return($allangles);
	}

	function get_AllanglesByLang($numLang) {
		global $db;

		// select
		$sql = 'SELECT * FROM angle INNER JOIN langue ON langue.numLang = angle.numLang WHERE langue.numLang = ?;'; //peut etre pas ça
		
		$req = $db->prepare($sql);
		// execute
		$req->execute([$numLang]);
		$allanglesByLang = $req->fetchAll();
		return($allanglesByLang);

		// prepare
		// $req = $db->query($sql);
		// // execute
		// $allanglesByLang = $req->fetchAll();
		// return($allanglesByLang);
	}

	function get_NbAllanglesBynumLang(string $numLang) {
		global $db;

		// select
		$sql = "SELECT * FROM angle WHERE numLang = ?";
		// prepare
		$req = $db->prepare($sql);
		// execute
		$req->execute([$numLang]);

		$allNbanglesBynumLang = $req->rowCount();
		return($allNbanglesBynumLang);
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


	//  Récupérer la prochaine PK de la table angle
	function getNextNumAngl($numLang) {
		global $db;
	
		// Découpage FK langue
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM angle WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans angle
				// Récup dernière PK (Primary key) utilisée
				$requete = "SELECT MAX(numAngl) AS numAngl FROM angle;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numAngl = $tuple["numAngl"];
	
				$numAnglSelect = (int)substr($numAngl, 4, 2);
				// No séquence suivant langue
				$numSeq1Angl = $numAnglSelect + 1;
				// Init no séquence angle pour nouvelle lang
				$numSeq2Angl = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numAngl) AS numAngl FROM angle WHERE numLang LIKE '$parmNumLang' ;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numAngl = $tuple["numAngl"];
	
				// No séquence actuel langue
				$numSeq1Angl = (int)substr($numAngl, 4, 2);
				// No séquence actuel langue
				$numSeq2Angl = (int)substr($numAngl, 6, 2);
				// No séquence suivant angle
				$numSeq2Angl++;
			}
	
			$libAnglSelect = "ANGL";
			// PK reconstituée : ANGL + no seq langue
			if ($numSeq1Angl < 10) {
				$numAngl = $libAnglSelect . "0" . $numSeq1Angl;
			} else {
				$numAngl = $libAnglSelect . $numSeq1Angl;
			}
			// PK reconstituée : ANGL + no seq langue + no seq angle
			if ($numSeq2Angl < 10) {
				$numAngl = $numAngl . "0" . $numSeq2Angl;
			} else {
				$numAngl = $numAngl . $numSeq2Angl;
			}
		}   // End of if ($result) / no seq angle
		return $numAngl;
	} // End of function

	function create(string $numAngl, string $libAngl, string $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO angle (numAngl , libAngl, numLang) VALUES (?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à l
			// prepare
			$request = $db->prepare($query);
			$request->execute([$numAngl, $libAngl, $numLang]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert angle : ' . $e->getMessage());
		}
	}

	function update($libAngl, $numLang, string $numAngl){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = 'UPDATE angle SET libAngl = ?, numLang = ? WHERE numAngl = ?;';
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$libAngl, $numLang, $numAngl]);

			$db->commit();
			$request->closeCursor();
			}

		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update angle : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur thematique, angle, motcle avec del
	function delete(string $numAngl){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM angle WHERE numAngl=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numAngl]);

			$count = $request->rowCount(); 
			$db->commit();
			$request->closeCursor();
			return($count); 
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete angle : ' . $e->getMessage());
		}
	}
}		// End of class
