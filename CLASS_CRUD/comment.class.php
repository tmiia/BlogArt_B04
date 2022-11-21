<?php
// CRUD comment
// ETUD
require_once ROOT . '../../connect/database.php';

class comment{
	function get_1comment($numSeqCom, $numArt){
		global $db;
		$query = "SELECT * FROM comment WHERE numSeqCom = ? AND numArt = ?";
		$result = $db->prepare($query);
		$result->execute([$numSeqCom, $numArt]);
		return($result->fetch());
		
	}

	// function get_AllcommentByarticle($numArt){
	// 	global $db;

	// }
	function get_Allcomments(){
		global $db;

		$query = 'SELECT * FROM comment;';
		// prepare
		$result = $db->query($query);
		// execute
		$allcomments = $result->fetchAll();
		return($allcomments);
	}


	function get_AllcommentsByNumArt($numArt){
		global $db;

        // select
        $sql = "SELECT * FROM comment WHERE numArt = ?";
        // prepare
		$result = $db->prepare($sql);
		// execute
		$result->execute([$numArt]);

        $allcommentsByArt =  $result->fetchAll();

		return($allcommentsByArt);
	}

	function get_allmembresbyarticle($numArt){
        global $db;

        // select
        $sql = "SELECT * FROM comment WHERE numArt = ?";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numArt]);

        $allmembresbyarticle = $req->fetchAll();

        return($allmembresbyarticle);
    }

	// function get_1CommentsByNumSeqComNumArt($numSeqCom, $numArt){
	// 	global $db;

	// 	// select
	// 	// prepare
	// 	// execute
	// 	return($result->fetch());
	// }

	// function get_AllcommentsByNumSeqComNumArt($numSeqCom, $numArt){
	// 	global $db;

	// 	// select
	// 	// prepare
	// 	// execute
	// 	return($allcommentsByNumSeqComNumArt);
	// }

	// function get_AllcommentsByarticleByMemb(){
	// 	global $db;

	// 	// select
	// 	// prepare
	// 	// execute
	// 	return($allcommentsByarticleByMemb);
	// }

	function get_NbAllcommentsBynumMemb($numMemb){
		global $db;

        // select
        $sql = "SELECT * FROM comment WHERE numMemb = ?;";
        // prepare
        $req = $db->prepare($sql);
        // execute
        $req->execute([$numMemb]);

        $allNbAllcommentsBynumMemb = $req->rowCount();
		return($allNbAllcommentsBynumMemb);
	}

	// Fonction : recupérer next numéro séquence de article recherché (PK comment)
	// commentaire suivant sur un article
	// => Pour table comment & table commentplus
	function getNextNumCom($numArt) {
		global $db;

		//récup id de l'article et num séquence comment
		$queryText = "SELECT CO.numArt, MAX(numSeqCom) AS numSeqCom FROM article AR INNER JOIN comment CO ON AR.numArt = CO.numArt WHERE AR.numArt = ?;";
		$result = $db->prepare($queryText);
		$result->execute(array($numArt));

		if ($result) {
			$tuple = $result->fetch();
			$numArtCom = $tuple["numArt"];
			$numSeqCom = $tuple["numSeqCom"];
			// New comment dans comment ou REPONSE pour article
			if (is_null($numArtCom)) { // si l'id de l'article est null
				// Init no séquence
				$numSeqCom = 1; //première fois qu'on rentre un commentaire pour cet article
			} else {
			if ((!is_null($numArtCom)) AND (!is_null($numSeqCom))) { //si num de sequence existe alors numéro de séquence++
				// No séquence suivant
				$numSeqCom++;
			} else {
				// Pbl cohérence select NumArt & NumCom
				return -1;
			}
			}
			return $numSeqCom;
		}   // End of if ($result)
		else {
		return -1;  // Pbl select / bdd
		}
	} // End of function

	// comment en attente : Moderation affComOK à FALSE
	function create($numSeqCom, $numArt, $libCom, $numMemb){
		global $db;

		try {
			$db->beginTransaction();

			$query = 'INSERT INTO comment (numSeqCom, numArt, dtCreCom, libCom, numMemb) VALUES (?, ?, NOW(), ?, ?);';
			// prepare
			$request = $db->prepare($query);
			$request->execute([$numSeqCom, $numArt, $libCom, $numMemb]);
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert comment : ' . $e->getMessage());
		}
	}

	// Moderation : TRUE si comment affiché, FALSE sinon
	// et remarques possibles admin si non affiché
	function update($numSeqCom, $numArt, $attModOK, $notifComKOAff, $delLogiq){
		global $db;

		try {
			$db->beginTransaction();

			$query = 'UPDATE comment SET attModOK = ?, notifComKOAff = ?, delLogiq = ? WHERE numSeqCom = ? AND numArt = ?';
			// prepare
			$request = $db->prepare($query);
			$request->execute([$attModOK, $notifComKOAff, $delLogiq, $numSeqCom, $numArt]);
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update comment : ' . $e->getMessage());
		}
	}

	// Create et Update en même temps => Del logique du comment
	// function createOrUpdate($numSeqCom, $numArt){
	// 	global $db;

	// 	try {
	// 		$db->beginTransaction();

	// 		// insert / update
	// 		// prepare
	// 		// execute
	// 		$db->commit();
	// 		$request->closeCursor();
	// 	}
	// 	catch (PDOException $e) {
	// 		$db->rollBack();
	// 		$request->closeCursor();
	// 		die('Erreur insert Or Update comment : ' . $e->getMessage());
	// 	}
	// }

	// A priori : del comment impossible (sauf si choix admin après modération) => Cf. createOrUpdate() ci-dessus
	function delete($numSeqCom, $numArt){	// OU à utiliser pour del logique : del => update
		global $db;

		
		try {
			$db->beginTransaction();

			// insert
			$query = 'DELETE FROM comment WHERE numSeqCom=? AND numArt=?'; 
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numSeqCom, $numArt]);

			$count = $request->rowCount(); 
			$db->commit();
			$request->closeCursor();
			return($count); 
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete comment : ' . $e->getMessage());
		}
	}
}	// End of class
