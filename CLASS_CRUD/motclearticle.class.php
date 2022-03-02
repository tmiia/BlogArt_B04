<?php
// CRUD MOTCLEARTICLE
// ETUD
require_once ROOT . '/CONNECT/database.php';

class MOTCLEARTICLE{
	function get_AllMotClesByNumArt($numArt){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function get_AllMotClesByLibTitrArt($libTitrArt){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function get_AllArtsByNumMotCle($numMotCle){
		global $db;

        // select
        $sql = "SELECT * FROM MOTCLEARTICLE WHERE numMotCle = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numMotCle]);

        $allCommentsByArt = $req->rowCount();

		return($allCommentsByArt);
	}

	function get_AllArtsByLibMotCle($libMotCle){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
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
			die('Erreur insert MOTCLEARTICLE : ' . $e->getMessage());
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
			die('Erreur delete MOTCLEARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
