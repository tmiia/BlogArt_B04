<?php
// CRUD commentplus
// ETUD
require_once $_SERVER['DOCUMENT_ROOT'] . '/connect/database.php';

class commentplus{
	function get_AllcommentplusByarticle($numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function get_AllcommentplusR(){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function create($numSeqCom, $numArt, $numSeqComR, $numArtR){
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
			die('Erreur insert commentplus : ' . $e->getMessage());
		}
	}
}	// End of class
