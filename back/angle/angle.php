<?php
////////////////////////////////////////////////////////////
//
//  CRUD angle (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : angle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once ROOT . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();


// Ctrl CIR
$errCIR = 0;

$errDel = 0;



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD angle</title>
	<meta charset="utf-8" />
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
	<h1>BLOGART22 Admin - CRUD angle</h1>

	<hr />
	<h2>Nouvel angle :&nbsp;<a href="./createAngle.php"><i>Créer un angle</i></a></h2>
<?php
    if ($errDel == 99) {
?>
        <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete angle : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>
    <hr />
	<h2>Tous les angles</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Libellé&nbsp;</th>
            <th>&nbsp;Langue&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get tous les angles en bdd

    // Boucle pour afficher
    $allangle = $monangle->get_Allangles();
    $allLangue = $monangle->get_AllLangues();
    for($i = 0; $i < count($allangle); $i++){
    //foreach($all as $row) {

?>
        <tr>
		<td><h4>&nbsp; <?= $allangle[$i]['numAngl']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allangle[$i]['libAngl']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allangle[$i]['numLang']; ?> &nbsp;</td>

        <!--<td>&nbsp; <?= $monangle->get_1angleByLang($allangle[$i]['numLang'])[0] ?> &nbsp;</td>-->
		
        <td>&nbsp;&nbsp;&nbsp;&nbsp<a href="./updateAngle.php?id=<?= $allangle[$i]['numAngl']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier angle" title="Modifier angle" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp<a href="./deleteAngle.php?id=<?= $allangle[$i]['numAngl']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer angle" title="Supprimer angle" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence d'article(s) associé(s) à cet angle. Vous devez d'abord supprimer le(s) angle(s) concerné(s).</div></i>
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
