<?php
////////////////////////////////////////////////////////////
//
//  CRUD comment (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : comment.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe comment
require_once __DIR__ . '/../../class_crud/comment.class.php';
// Instanciation de la classe comment
$moncommentaire = NEW comment();

require_once __DIR__ . '/../../class_crud/membre.class.php';

// Instanciation de la classe article
$monMembre = new membre();


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Admin - CRUD commentaire</title>
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
        .OK {
            padding: 2px;
            border: solid 0px black;
            color: deeppink;
            font-style: italic;
            border-radius: 5px;
        }
        .KO {
            padding: 2px;
            border: solid 0px black;
            color: darkgoldenrod;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
<?php
		include __DIR__ . '../../../front/includes/commons/navigationback.php';
	?>
  <h1>BLOGART22 Admin - CRUD commentaire</h1>

  <hr />
  <h2>Nouveau commentaire :&nbsp;<a href="./createcomment.php"><i>Créer un commentaire</i></a></h2>
  <hr />
  <h2>Tous les commentaires</h2>

  <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;<br>&nbsp;article&nbsp;</th>
            <th>&nbsp;Numéro&nbsp;<br>&nbsp;comment.&nbsp;</th>
            <th>&nbsp;Pseudo&nbsp;</th>
            <th>&nbsp;Date création&nbsp;<br>&nbsp;commentaire&nbsp;</th>
            <th>&nbsp;commentaire&nbsp;</th>
            <th>&nbsp;Date modération&nbsp;</th>
            <th>&nbsp;commentaire&nbsp;<br>&nbsp;visible&nbsp;</th>
            <th>&nbsp;Justification&nbsp;modération&nbsp;<br>&nbsp;si non visible&nbsp;</th>
            <th>&nbsp;Delete&nbsp;<br>&nbsp;logique&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    // Appel méthode : Get tous les comments en bdd
    $allcomments = $moncommentaire->get_Allcomments();
    for($i =0; $i < count($allcomments); $i++){
        // date dtCreCom => FR
        // $dtCreCom = dateChangeFormat($dtCreCom, $from, $to);

        // date dtModCom => FR
        // $dtModCom = dateChangeFormat($dtModCom, $from, $to);
?>
        <tr>
        <td><h4>&nbsp; <?= $allcomments[$i]['numArt']; ?> &nbsp;</h4></td>

        <td><h4>&nbsp; <?= $allcomments[$i]['numSeqCom']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $monMembre->get_1Membre($allcomments[$i]['numMemb'])['pseudoMemb']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allcomments[$i]['dtCreCom']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allcomments[$i]['libCom']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allcomments[$i]['dtModCom']; ?> &nbsp;</td>


        <td>&nbsp;<span class="OK">&nbsp; <?=  $allcomments[$i]['attModOK']; ?> &nbsp;</span></td>


        <td>&nbsp; <?= $allcomments[$i]['notifComKOAff']; ?> &nbsp;</td>


        <td>&nbsp;<span class="OK">&nbsp; <?=  $allcomments[$i]['delLogiq']; ?> &nbsp;</span></td>


<!-- F1 aff comments (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updatecomment.php?id1=<?=$allcomments[$i]['numSeqCom']?>&id2=<?=$allcomments[$i]['numArt']?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier commentaire" title="Modifier commentaire" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <br /></td>

<!-- Del logique (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deletecomment.php?id1=<?=$allcomments[$i]['numSeqCom']?>&id2=<?=$allcomments[$i]['numArt']?>" title="Suppression logique..."><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer commentaire" title="Supprimer/rétablir commentaire" /></i></a><br>&nbsp;&nbsp;<span class="error">(Logique)</span>&nbsp;&nbsp;
        <br /></td>
        </tr>
<?php
 } // End of foreach
?>
    </tbody>
    </table>
    <p>&nbsp;</p>
</div>
</div>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
