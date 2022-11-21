<?php
////////////////////////////////////////////////////////////
//
//  CRUD statut (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : statut.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe Statut
require_once ROOT . '/../../class_crud/statut.class.php';

// Instanciation de la classe Statut
$monStatut = new statut();


// Gestion des CIR => affichage erreur sinon

if(isset($_GET['errCIR'])){
    $errCIR = $_GET['errCIR'];
}else{
    $errCIR = 0;
}



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Gestion du Statut</title>
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
        .superAdmin {
            text-decoration: none;  /* del sourligné */
            color: #797979;     /* Acier */
/*            color: #919191;      Etain */
        }
    </style>
    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
    <?php
		include ROOT . '../../../front/includes/commons/navigationback.php';
	?>
	<h1>BLOGART22 Admin - CRUD Statut</h1>

	<hr />
	<h2>Nouveau statut :&nbsp;<a href="./createStatut.php"><i>Créer un statut</i></a></h2>
	<hr />
	<h2>Tous les statuts</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Nom&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode grâce à instanciation : Get tous les statuts en bdd

    // Boucle pour afficher

        $allStatuts = $monStatut->get_AllStatuts();
        foreach($allStatuts as $row) {

?>
        <tr>
		<td><h4>&nbsp; <?= $row['idStat']; // "<?=" veut dire comme "<?php echo" etc ?> &nbsp;</h4></td> 

        <td>&nbsp; <?= $row['libStat']; ?> &nbsp;</td>

<?php
        $idStat = 1; // En dur
        if ($idStat != 1) {  // superAdmin
?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateStatut.php?id=<?= $row['idStat']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier statut" title="Modifier statut" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteStatut.php?id=<?= $row['idStat']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer statut" title="Supprimer statut" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
<?php
        } else {
?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateStatut.php?id=<?= $row['idStat']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier statut" title="Modifier statut" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteStatut.php?id=<?= $row['idStat']; ?>" class="superAdmin"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer statut" title="Supprimer statut" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
<?php
        }   // End of else if
?>
        </tr>
<?php

}	
    // End of foreach
?>
    </tbody>
    </table>
<?php
    // Si erreur sur retour del => aff msg "CIR KO"
    if ($errCIR == 1) {
?>
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence de user(s) associé(s) à ce statut. Vous devez d'abord supprimer le(s) user(s) concerné(s).</div></i>
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
