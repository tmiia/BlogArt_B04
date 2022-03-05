<?php
////////////////////////////////////////////////////////////
//
//  CRUD likeart (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : likecom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe likecom
require_once __DIR__ . '/../../class_crud/likecom.class.php';
// Instanciation de la classe likecom
$monlikecom = new likecom ();

require_once __DIR__ . '/../../class_crud/membre.class.php';
$monMembre = new membre();

require_once __DIR__ . '/../../class_crud/article.class.php';
$monarticle = new article();

require_once __DIR__ . '/../../class_crud/comment.class.php';
$moncommentaire = new comment();

?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like sur commentaire</title>
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
    <h1>BLOGART22 Admin - CRUD Like sur commentaire</h1>

    <hr />
    <h2>Nouveau like sur commentaire :&nbsp;<a href="./createlikecom.php"><i>Créer un like</i></a></h2>
    <hr />
    <h2>Tous les likes par membre, par commentaire et par article</h2>

    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Membre&nbsp;</th>
            <th>&nbsp;article&nbsp;</th>
            <th>&nbsp;commentaire&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get tous les users en bdd
    $allLikesCom = $monlikecom->get_AllLikesCom();
    // Boucle pour afficher
    for($i = 0; $i < count($allLikesCom); $i++){
        


?>
        <tr>
        <td><h4>&nbsp; <?= $monMembre->get_1Membre($allLikesCom[$i]['numMemb'])['pseudoMemb']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $monarticle->get_1article($allLikesCom[$i]['numArt'])['libTitrArt']; ?> &nbsp;</td>

        <td>&nbsp; <?= $moncommentaire->get_1comment($allLikesCom[$i]['numSeqCom'], $allLikesCom[$i]['numArt'])['libCom']; ?> &nbsp;</td>

        <td>&nbsp;<span class="OK">&nbsp; <?= $allLikesCom[$i]['likeC']; ?> &nbsp;</span></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updatelikecom.php?id1=<?=$allLikesCom[$i]['numMemb']?>&id2=<?=$allLikesCom[$i]['numSeqCom']?> &id3=<?=$allLikesCom[$i]['numArt']?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier like commentaire" title="Modifier like commentaire" /></i></a><br>&nbsp;&nbsp;<span class="error">(Un)like</span>&nbsp;
        <br /></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deletelikecom.php?id1=<?=$allLikesCom[$i]['numMemb']?>&id2=<?=$allLikesCom[$i]['numSeqCom']?> &id3=<?=$allLikesCom[$i]['numArt']?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer like commentaire" title="Supprimer like commentaire" /></i></a><br>&nbsp;&nbsp;<span class="error">(S/Admin)</span>&nbsp;
        <br /></td>
        </tr>
<?php
}   // End of foreach
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
