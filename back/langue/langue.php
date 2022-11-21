<?php
////////////////////////////////////////////////////////////
//
//  CRUD langue (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : langue.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once ROOT . '/../../class_crud/langue.class.php';

// Instanciation de la classe langue
$maLangue = new langue();


// Ctrl CIR
$errCIR = 0;
$errDel = 0;


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Langue</title>
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
	<h1>BLOGART22 Admin - CRUD Langue</h1>

	<hr />
	<h2>Nouvelle langue :&nbsp;<a href="./createLangue.php"><i>Créer une langue</i></a></h2>
<?php
    if ($errDel == 99) {
?>
	    <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete langue : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>
    <hr />
	<h2>Toutes les langues</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Nom court&nbsp;</th>
            <th>&nbsp;Nom long&nbsp;</th>
            <th>&nbsp;Pays&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get toutes les langues en bdd

    // Boucle pour afficher
    $allLangues = $maLangue->get_AllLangues();
    $allPays = $maLangue->get_AllPays();
    for($i = 0; $i < count($allLangues); $i++){
?>
<tr>
		<td><h4>&nbsp; <?= $allLangues[$i]['numLang'] ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allLangues[$i]['lib1Lang']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allLangues[$i]['lib2Lang']; ?> &nbsp;</td>

        <td>&nbsp; <?= $maLangue->get_1LangueByPays($allLangues[$i]['numLang'])[0] ?> &nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateLangue.php?id=<?= $allLangues[$i]['numLang'] ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier langue" title="Modifier langue" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
 		<br /></td>
 		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteLangue.php?id=<?= $allLangues[$i]['numLang'] ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer langue" title="Supprimer langue" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
<?php
    }
?>

    </tbody>
    </table>
<?php
    if ($errCIR == 1) {
?>
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence de thématique(s), angle(s) et/ou mot(s) clé(s) associé(s) à cette langue. Vous devez d'abord supprimer le(s) thématique(s), le(s) angle(s) ou le(s) mots clés concerné(s).</div></i>
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
