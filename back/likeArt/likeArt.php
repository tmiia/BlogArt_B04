<?php
////////////////////////////////////////////////////////////
//
//  CRUD likeart (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : likeart.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe likeart
require_once __DIR__ . '/../../class_crud/likeart.class.php';

// Instanciation de la classe likeart
$monlikeart = new likeart();

// Insertion classe article
require_once __DIR__ . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();
// Instanciation de la classe Membre
require_once __DIR__ . '/../../class_crud/membre.class.php';
$monMembre = new membre();


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like sur article</title>
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
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like sur article</h1>

    <hr />
    <h2>Nouveau like sur article :&nbsp;<a href="./createlikeart.php"><i>Créer un like</i></a></h2>
    <hr />
    <h2>Tous les likes par membre et par article</h2>

    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Membre&nbsp;</th>
            <th>&nbsp;article&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get tous les users en bdd

    // Boucle pour afficher
    $allLikesArt = $monlikeart->get_AllLikesArt();
    $pseudoMemb = $monMembre->get_AllMembres();
    // $pseudoMemb = $monMembre -> get_1Membre($numMemb);
    // $pseudoMemb = $monlikeart->get_AllLikesArtByNumMemb();
    // $libTitrArt = $monlikeart->get_AllLikesArtByNumArt();
    //var_dump($libTitrArt);
    //exit;

    for($i = 0; $i < count($allLikesArt); $i++){
        //var_dump($allLikesArt);
        //exit;
        
    //foreach($all as $row) {
    //
?>
        <tr>
         <td><h4>&nbsp; <?= $monMembre->get_1Membre($allLikesArt[$i]['numMemb'])['pseudoMemb'] ?> &nbsp;</h4></td>

         <td>&nbsp; <?= $monarticle->get_1article($allLikesArt[$i]['numArt'])['libTitrArt'] ?> &nbsp;</td>

        <td>&nbsp;<span class="OK">&nbsp; <?= $allLikesArt[$i]['likeA']; ?> &nbsp;</span></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updatelikeart.php?id1=<?=$allLikesArt[$i]['numMemb']?>&id2=<?=$allLikesArt[$i]["numArt"]?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier like article" title="Modifier like article" /></i></a><br>&nbsp;&nbsp;<span class="error">(Un)like</span>&nbsp;
        <br /></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deletelikeart.php?id1=<?=$allLikesArt[$i]['numMemb']?>&id2=<?=$allLikesArt[$i]["numArt"]?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer like article" title="Supprimer like article" /></i></a><br>&nbsp;&nbsp;<span class="error">(S/Admin)</span>&nbsp;
        <br /></td>
        </tr>
<?php
    }   // End of foreach
?>
    </tbody>
    </table>

    <p>&nbsp;</p>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
