<?php
// CRUD motclearticle
// ETUD
require_once ROOT . '../../connect/database.php';

class motclearticle{
	function get_AllMotClesByNumArt($numArt){
		global $db;

		// select
		// prepare
		// execute
		return($allcommentsByArt);
	}

	function get_AllMotClesByLibTitrArt($libTitrArt){
		global $db;

		// select
		// prepare
		// execute
		return($allcommentsByArt);
	}

	function get_AllArtsByNumMotCle($numMotCle){
		global $db;

        // select
        $sql = "SELECT * FROM motclearticle WHERE numMotCle = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numMotCle]);

        $allcommentsByArt = $req->rowCount();

		return($allcommentsByArt);
	}

	function get_AllArtsByLibMotCle($libMotCle){
		global $db;

		// select
		// prepare
		// execute
		return($allcommentsByArt);
	}

	function create($numArt, $numMotCle){
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
			die('Erreur insert motclearticle : ' . $e->getMessage());
		}
	}

	function delete($numArt, $numMotCle){
		global $db;

		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete motclearticle : ' . $e->getMessage());
		}
	}
}	// End of class
