<?php
////////////////////////////////////////////////////////////
//
//  CRUD commentplus (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : commentplus.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once ROOT . '/../../util/dateChangeFormat.php';

// Insertion classe comment

// Instanciation de la classe comment



// Insertion classe commentplus

// Instanciation de la classe commentplus



// Insertion classe article

// Instanciation de la classe article



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Gestion des commentaires & Réponses</title>
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
  <h1>BLOGART22 Admin - Gestion du CRUD commentaires & Réponses</h1>

  <hr /><br />
  <h2>Nouveau commentaire sur un commentaire :&nbsp;<a href="#"><i>Créer une réponse à commentaire</i></a></h2>
  <br />
    <hr />
  <h2>Toutes les commentaires & commentaires</h2>

  <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro <br>article&nbsp;</th>
            <th>&nbsp;Date <br>article&nbsp;</th>
            <th>&nbsp;Numéro <br>comment&nbsp;</th>
            <th>&nbsp;commentaire&nbsp;</th>
            <th>&nbsp;Date <br>comment&nbsp;</th>

            <th>&nbsp;Pseudo&nbsp;</th>
            <th>&nbsp;Visa modération&nbsp;</th>
            <th>&nbsp;Visible après modération&nbsp;</th>
            <th>&nbsp;commentaire <br>si non visible&nbsp;</th>
            <th>&nbsp;commentaire <br>affiché&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    // Appel méthode : Get tous les articles en bdd

    // Boucle pour afficher
    //foreach($all as $row) {

?>
        <tr>
        <td><h4>&nbsp; <?= "ici numSeqCom"; ?> &nbsp;</h4></td>

        <td><h4>&nbsp; <?= "ici numArt"; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= "ici pseudoMemb"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici dtCreCom"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici libCom"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici attModOK"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici affComOK"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici notifComKOAff"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici delLogiq"; ?> &nbsp;</td>
<!-- F1 aff comments (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;<a href="#"><i>Modifier</i></a>&nbsp;
        <br /></td>
<!-- Del logique (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;<a href="#" title="Suppression logique..."><i>Supprimer</i></a><br>&nbsp;&nbsp;<span class="error">(Logique)</span>&nbsp;
        <br /></td>
        </tr>
<?php
    // } // End of foreach
?>
    </tbody>
    </table>
    <p>&nbsp;</p>
    </div>
    </div>
<?php
require_once ROOT . '/footer.php';
?>
</body>
</html>
