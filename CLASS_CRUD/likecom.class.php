<?php
// CRUD likecom
// ETUD
require_once ROOT . '../../connect/database.php';

class likecom{
	function get_1likecom($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1likecomPlusMemb($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1likecomPlusCom($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1likecomPlusArt($numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_AllLikesCom(){
		global $db;

		// select
		$query = 'SELECT * FROM likecom;';
		// prepare
		$result = $db->query($query);
		// execute
		$allLikesCom = $result->fetchAll();
		
		return($allLikesCom);
	}

	function get_AllLikesComBycomment($numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function get_AllLikesComByMembre($numMemb){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function create($numMemb, $numSeqCom, $numArt, $likeC){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert likecom : ' . $e->getMessage());
		}
	}

	function update($numMemb, $numSeqCom, $numArt, $likeC){
		global $db;

		try {
			$db->beginTransaction();

			// update
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update likecom : ' . $e->getMessage());
		}
	}

	// Create et Update en même temps
	function createOrUpdate($numMemb, $numSeqCom, $numArt){
		global $db;

		try {
			$db->beginTransaction();

			// insert / update
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert Or Update likecom : ' . $e->getMessage());
		}
	}

	// AUTORISE UNIQUEMENT POUR le super-admin / admin
	function delete($numMemb, $numSeqCom, $numArt){
		global $db;
		
		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			//$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			//return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete likecom : ' . $e->getMessage());
		}
	}
}	// End of class
