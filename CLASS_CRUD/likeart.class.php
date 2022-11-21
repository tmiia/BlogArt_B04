 <?php
// CRUD likeart
// ETUD
require_once __DIR__ . '../../connect/database.php';

class likeart{
	function get_1likeart($numMemb, $numArt){
		global $db;

		$query = "SELECT * FROM likeart WHERE numMemb = ? AND numArt = ?;";
		$result = $db->prepare($query);
		$result->execute([$numMemb, $numArt]);
		return($result->fetch());
	}

	function get_AllLikesArt(){
		global $db;

		// select
		$query = "SELECT * FROM likeart;";
		// prepare
		$result = $db->query($query);
		// execute
		$allLikesArt = $result->fetchAll();
		return($allLikesArt);
	}

	function get_AllLikesArtByNumArt($numArt){
		global $db;

		$query = 'SELECT * FROM `likeart` WHERE numArt = ?;';
		$result = $db->prepare($query);
		$result->execute([$numArt]);
		$allLikesArtByNumArt = $result->fetchAll();
		return($allLikesArtByNumArt);
	}

	function get_AllLikesArtByNumMemb($numMemb){
		global $db;

		$query = 'SELECT * FROM likeart WHERE numMemb = ?;';
		$result = $db->prepare($query);
		$result->execute([$numMemb]);
		$allLikesArtByNumMemb = $result->fetchAll();
		return($allLikesArtByNumMemb);
	}

	function get_nbLikesArtByarticle($numArt){
		global $db;

		$query = 'SELECT COUNT(likeA) FROM likeart WHERE numArt = ?;';
		$result = $db->prepare($query);
		$result->execute([$numArt]);
		$bLikesArtByarticle = $result->fetchAll();
		return($bLikesArtByarticle);
	}

	function get_nbLikesArtByMembre($numMemb){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function create($numMemb, $numArt, $likeA){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO likeart (numMemb, numArt, likeA) VALUES (?, ?, ?)'; // ON met la liste des attributs de la table, ici il n'y en a qu'un donc on s'arrête à l
			// prepare
			$request = $db->prepare($query);
			$request->execute([$numMemb, $numArt, $likeA]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert likeart : ' . $e->getMessage() . " L'utilisateur a déjà liké ce post");
		}
	}

	function update($numMemb, $numArt, $likeA){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = 'UPDATE likeart SET likeA = ? WHERE numMemb = ? AND numArt = ?;';
			
			$request = $db->prepare($query);
			$request->execute([$likeA, $numMemb, $numArt]);
			
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update likeart : ' . $e->getMessage());
		}
	}

	// Create et Update en même temps
	function createOrUpdate($numMemb, $numArt){
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
			die('Erreur insert Or Update likeart : ' . $e->getMessage());
		}
	}

	// AUTORISE UNIQUEMENT POUR le super-admin / admin => En mode DEV (avant la mise en prod)
	function delete($numMemb, $numArt){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM likeart WHERE numMemb=? AND numArt=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numMemb, $numArt]);

			$count = $request->rowCount(); 
			$db->commit();
			$request->closeCursor();
			return($count); 
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete likeart : ' . $e->getMessage());
		}
	}
}	// End of class
