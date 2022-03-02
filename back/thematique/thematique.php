<?php
////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : thematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';
// Del accents sur string
require_once ROOT . '/util/delAccents.php';

// Insertion classe Thematique
require_once ROOT . '/CLASS_CRUD/thematique.class.php';
// Instanciation de la classe MotCle
$maThematique = new THEMATIQUE();
// Instanciation de la classe Thematique
require_once ROOT . '/CLASS_CRUD/langue.class.php';
// Instanciation de la classe Langue
$maLangue = new LANGUE();


// BBCode


// Ctrl CIR
$errCIR = 0;
$errDel = 0;


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Thematique</title>
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
</head>
<body>
	<h1>BLOGART22 Admin - CRUD Thematique</h1>

	<hr />
	<h2>Nouvelle thematique :&nbsp;<a href="./createThematique.php"><i>Créer une thematique</i></a></h2>
<?php
    if ($errDel == 99) {
?>
	    <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete THEMATIQUE : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>
    <hr />
	<h2>Toutes les Thematiques</h2>

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
    // Appel méthode : Get toutes les Thematiques en BDD
    $allThematiques = $maThematique->get_AllThematiques();
    $allLangues = $maLangue->get_AllLangues();
    for($i = 1; $i < count($allThematiques); $i++){
    // Boucle pour afficher
    //foreach($all as $row) {
?>
        <tr>

		<td><h4>&nbsp; <?= $allThematiques[$i]['numThem']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allThematiques[$i]['libThem']; ?> &nbsp;</td>

        <td>&nbsp; <?= $maThematique->get_1ThematiqueByLang($allThematiques[$i]['numLang'])[0]  ?> &nbsp;</td>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateThematique.php?id=<?=$allThematiques[$i]['numThem']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier thématique" title="Modifier thématique" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteThematique.php?id=<?=$allThematiques[$i]['numThem']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer thématique" title="Supprimer thématique" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
<?php
require_once ROOT . '/back/thematique/footer.php';
?>
</body>
</html>
