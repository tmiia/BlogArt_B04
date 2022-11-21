<?php
////////////////////////////////////////////////////////////
//
//  CRUD motcle (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : motCle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe MotCle
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/motcle.class.php';
// Instanciation de la classe MotCle
$monMotCle = new motcle();
// Insertion classe Langue
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/langue.class.php';
// Instanciation de la classe Langue
$maLangue = new langue();



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Mot Clé</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/../front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD Mot Clé</h1>

	<hr />
	<h2>Nouveau Mot Clé :&nbsp;<a href="./createMotCle.php"><i>Créer un Mot Clé</i></a></h2>
	<hr />
	<h2>Tous les Mots Clés</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Nom Mot Clé&nbsp;</th>
            <th>&nbsp;Langue&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>

<?php
    // Appel méthode : Get toutes les mots cles en bdd
    $allMotCles = $monMotCle->get_AllMotCles();
    $allLangues = $maLangue->get_AllLangues();
    for($i = 0; $i < count($allMotCles); $i++){
    // Boucle pour afficher
    //foreach($all as $row) {
?>
        <tr>

		<td><h4>&nbsp; <?= $allMotCles[$i]['numMotCle']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allMotCles[$i]['libMotCle']; ?> &nbsp;</td>

        <td>&nbsp; <?= $monMotCle->get_1MotCleByLang($allMotCles[$i]['numLang'])[0] ?> &nbsp;</td>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateMotCle.php?id=<?=$allMotCles[$i]['numMotCle']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier mot clé" title="Modifier mot clé" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteMotCle.php?id=<?=$allMotCles[$i]['numMotCle']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer mot clé" title="Supprimer mot clé" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>

        </tr>
<?php
}	// End of foreach
?>
    </tbody>
    </table>
    <br /><br/>
</div>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>
