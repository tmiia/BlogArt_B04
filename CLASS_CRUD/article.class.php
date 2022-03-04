<?php
// CRUD article
// ETUD
require_once __DIR__ . '/../connect/database.php';

class article{
	function get_1article($numArt){
		global $db;
		
		// select
		$query = 'SELECT * FROM article WHERE numArt = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numArt]);
		return($result->fetch());
	}

	function get_1articleAnd3FK($numArt){
		global $db;

		// select
		// prepare
		// execute
		// return($result->fetch());
	}

	function get_Allarticles(){
		global $db;

		$query = 'SELECT * FROM article;';
		// prepare
		$result = $db->query($query);
		// execute
		$allarticles = $result->fetchAll();
		return($allarticles);
	}

	// POUR AFFICHER UN NOMBRE LIMITE SEULEMENT D articleS SUR LA FRONTPAGE

	function get_Lastarticles() {
		global $db;

		$query = 'SELECT * FROM article ORDER BY numArt DESC;';
		// prepare
		$result = $db->query($query);
		// execute
		$lastarticles = $result->fetchAll();
		return($lastarticles);

	}

	function get_AllarticlesByNumAnglNumThem(){
		global $db;

		// select
		// prepare
		// execute
		// return($allarticlesByNumAnglNumThem);
	}

	function get_NbAllarticlesByNumAngl($numAngl){
		global $db;

		// select
        $sql = "SELECT * FROM article WHERE numAngl = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numAngl]);

        $allNbarticlesBynumAngl = $req->rowCount();
		return($allNbarticlesBynumAngl);
	}

	function get_NbAllarticlesByNumThem($numThem){
		global $db;

        // select
        $sql = "SELECT * FROM article WHERE numThem = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numThem]);

        $allNbarticlesBynumThem = $req->rowCount();
 		return($allNbarticlesBynumThem);
	}

	// Barre de recherche CONCAT : mots clés dans article & thematique
	function get_articlesByMotsCles($motcle){
		global $db;

		// Recherche plusieurs mots clés (CONCAT)
		$textQuery = 'SELECT * FROM article AR INNER JOIN thematique TH ON AR.numThem = TH.numThem WHERE CONCAT(libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, libThem) LIKE "%'.$motcle.'%" ORDER BY numArt DESC';
		$result = $db->query($textQuery);
		$allarticlesByMotsCles = $result->fetchAll();
		return($allarticlesByMotsCles);
	}

	// Barre de recherche JOIN : mots clés par motcle (TJ) dans article
	function get_MotsClesByarticles($listMotcles){
		global $db;

		/*
		Requete avec IN :
		SELECT * FROM motcle WHERE libMotCle IN ('Bordeaux', 'bleu');
		*/
		// Recherche mot clé (INNER JOIN) dans tables motcle & (article)
		$textQuery = 'SELECT AR.numArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt FROM motcle MC INNER JOIN motclearticle MCA ON MC.numMotCle = MCA.numMotCle INNER JOIN article AR ON MCA.numArt = AR.numArt WHERE libMotCle IN (' . $listMotcles . ');';
		$result = $db->prepare($textQuery);
		$result->execute([$listMotcles]);
		$allarticlesByNumAnglNumThem = $result->fetchAll();
		return($allarticlesByNumAnglNumThem);
	}

	// Fonction pour recupérer la prochaine PK de la table article
	function getNextNumArt() {
		global $db;

		$requete = "SELECT MAX(numArt) AS numArt FROM article;";
		$result = $db->query($requete);

		if ($result) {
			$tuple = $result->fetch();
			$numArt = $tuple["numArt"];
			// No PK suivante article
			$numArt++;
		}   // End of if ($result)
		return $numArt;
	} // End of function

	// Fonction pour recupérer la dernière PK de article
	// avant insert des n occurr dans TJ motclearticle
	function get_LastNumArt(){
		global $db;

		$requete = "SELECT MAX(numArt) AS numArt FROM article;";
		$result = $db->query($requete);

		if ($result) {
			$tuple = $result->fetch();
			$lastNumArt = $tuple["numArt"];

		}   // End of if ($result)
		return $lastNumArt;
	} // End of function

	function create($libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt, $numAngl, $numThem){
		global $db;

		try {
			$db->beginTransaction();

			$query = 'INSERT INTO article (dtCreArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numAngl, numThem) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
			// prepare
			$request = $db->prepare($query);
			$request->execute([$libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt, $numAngl, $numThem]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert article : ' . $e->getMessage());
		}
	}

	function update($numArt, $libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt, $numAngl, $numThem){
		global $db;

		try {
			$db->beginTransaction();

				// update
				$query = 'UPDATE article SET libTitrArt = ?, libChapoArt = ?, libAccrochArt = ?, parag1Art = ?, libSsTitr1Art = ?, parag2Art = ?, libSsTitr2Art = ?, parag3Art = ?, libConclArt = ?, urlPhotArt = ?, numAngl = ?, numThem = ? WHERE numArt = ?;';
				// prepare
				$request = $db->prepare($query);
				// execute
				$request->execute([$libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt, $numAngl, $numThem, $numArt]);
					$db->commit();
					$request->closeCursor();
				}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update article : ' . $e->getMessage());
		}
	}

	function delete($numArt){
		global $db;

		try {
			$db->beginTransaction();

				// delete
				$query = 'DELETE FROM article WHERE numArt=?'; 
				// prepare
				$request = $db->prepare($query);
				// execute
				$request->execute([$numArt]);
	
				$count = $request->rowCount(); 
				$db->commit();
				$request->closeCursor();
				return($count); 
			}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete article : ' . $e->getMessage());
		}
	}
}	// End of class
