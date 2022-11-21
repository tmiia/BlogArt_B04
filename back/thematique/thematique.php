<?php
////////////////////////////////////////////////////////////
//
//  CRUD thematique (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : thematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';
// Del accents sur string
require_once ROOT . '/../../util/delAccents.php';

// Insertion classe thematique
require_once ROOT . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();
// Instanciation de la classe thematique
require_once ROOT . '/../../class_crud/langue.class.php';
// Instanciation de la classe Langue
$maLangue = new langue();


// BBCode


// Ctrl CIR
$errCIR = 0;
$errDel = 0;


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD thematique</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
<?php
		include ROOT . '../../../front/includes/commons/navigationback.php';
	?>
	<h1>BLOGART22 Admin - CRUD thematique</h1>

	<hr />
	<h2>Nouvelle thematique :&nbsp;<a href="./createThematique.php"><i>Créer une thematique</i></a></h2>
<?php
    if ($errDel == 99) {
?>
	    <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete thematique : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>
    <hr />
	<h2>Toutes les thematiques</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Description&nbsp;</th>
            <th>&nbsp;Langue&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get toutes les thematiques en bdd
    $allthematiques = $mathematique->get_Allthematiques();
    $allLangues = $maLangue->get_AllLangues();
    for($i = 0; $i < count($allthematiques); $i++){
    // Boucle pour afficher
    //foreach($all as $row) {
?>
        <tr>

		<td><h4>&nbsp; <?= $allthematiques[$i]['numThem']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allthematiques[$i]['libThem']; ?> &nbsp;</td>

        <td>&nbsp; <?= $mathematique->get_1thematiqueByLang($allthematiques[$i]['numLang'])[0]  ?> &nbsp;</td>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updatethematique.php?id=<?=$allthematiques[$i]['numThem']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier thématique" title="Modifier thématique" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deletethematique.php?id=<?=$allthematiques[$i]['numThem']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer thématique" title="Supprimer thématique" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>

        </tr>
<?php
 }	// End of foreach
?>
    </tbody>
    </table>
<?php
    if ($errCIR == 1) {
?>
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence d'article(s) associé(s) à cette thématique. Vous devez d'abord supprimer le(s) thématique(s) concernée(s).</div></i>
<?php
    }   // End of if ($errCIR == 1)
?>
    <p>&nbsp;</p>
</div>
</div>
<?php
require_once ROOT . '/footer.php';
?>
</body>
</html>
