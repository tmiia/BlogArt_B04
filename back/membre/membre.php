<?php
////////////////////////////////////////////////////////////
//
//  CRUD membre (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : membre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once ROOT . '/../../util/dateChangeFormat.php';

// Insertion classe Membre
require_once ROOT . '/../../class_crud/membre.class.php';

// Instanciation de la classe Membre
$monMembre = new membre();

// Insertion classe Statut
require_once ROOT . '/../../class_crud/statut.class.php';

// Instanciation de la classe Statut
$monStatut = new statut();

//  trl CIR
$errCIR = 0;
$errDel = 0;


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Membre</title>
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
    <h1>BLOGART22 Admin - CRUD Membre</h1>

	<hr />
	<h2>Nouveau Membre :&nbsp;<a href="./createMembre.php"><i>Créer un Membre</i></a></h2>
<?php
    if ($errDel == 99) {
?>
	    <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete membre : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>    
    <hr />
	<h2>Tous les Membres</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Identité&nbsp;</th>
            <th>&nbsp;Pseudo&nbsp;</th>
            <th>&nbsp;eMail&nbsp;</th>
            <th>&nbsp;Date création&nbsp;</th>
            <th>&nbsp;Connexion&nbsp;<br />&nbsp;auto&nbsp;</th>
            <th>&nbsp;Accord&nbsp;<br />&nbsp;RGPD&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>

<?php
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    // Appel méthode : Get toutes les membres en bdd
    $allMembres = $monMembre->get_AllMembres();
    $allStatuts = $monStatut->get_AllStatuts();
    for($i = 1; $i < count($allMembres); $i++){
    //foreach($all as $row) {



            // date dtCreaMemb => FR
            // $dtCreaMemb = dateChangeFormat($dtCreaMemb, $from, $to);
?>
            <tr>
            <td><h4>&nbsp; <?= $allMembres[$i]['numMemb']; ?> &nbsp;</h4></td>

            <td>&nbsp; <?= $allMembres[$i]['prenomMemb'] . " " . $allMembres[$i]['nomMemb']; ?> &nbsp;</td>

            <td>&nbsp; <?= $allMembres[$i]['pseudoMemb']; ?> &nbsp;</td>

            <td>&nbsp; <?= $allMembres[$i]['eMailMemb']; ?> &nbsp;</td>

            <td>&nbsp; <?= $allMembres[$i]['dtCreaMemb'];?> &nbsp;</td>

            <td>&nbsp; <?= "connexion auto"; ?> &nbsp;</td>

            <td>&nbsp; <?= $allMembres[$i]['accordMemb']; ?> &nbsp;</td>

            <td>&nbsp; <?= $monMembre->get_1MembrebyStatut($allMembres[$i]['idStat'])[0]; ?> &nbsp;</td>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateMembre.php?id=<?=$allMembres[$i]['numMemb']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier membre" title="Modifier membre" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <br /></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteMembre.php?id=<?=$allMembres[$i]['numMemb']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer membre" title="Supprimer membre" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence de commentaire(s) associé(s) à ce membre. La suppression des commentaires n'étant pas permise, vous ne pourrez pas supprimer ce membre.</div></i>
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
